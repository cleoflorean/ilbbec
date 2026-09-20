<?php

namespace App\Http\Controllers;

use App\Models\JadwalSesi;
use App\Models\Pendaftaran;
use App\Models\StudyCase;
use App\Models\User;
use App\Models\Wawancara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $metrics = [
            'candidates' => User::where('Role', 'user')->count(),
            'applications' => Pendaftaran::count(),
            'study_cases' => StudyCase::count(),
        ];

        $pipeline = [
            'Menunggu review' => Pendaftaran::where('StatusBerkas', 'Menunggu')->count(),
            'Lolos berkas' => Pendaftaran::where('StatusBerkas', 'Lolos')->count(),
            'Selesai' => Pendaftaran::where('StatusAkhir', 'Lolos')->count(),
        ];

        $recentApplications = Pendaftaran::with('user')
            ->latest('created_at')
            ->limit(6)
            ->get();

        $nextSession = JadwalSesi::where('IsActive', true)
            ->orderBy('TanggalMulai', 'asc')
            ->first();

        return view('admin.home', compact('metrics', 'pipeline', 'recentApplications', 'nextSession'));
    }

    public function peserta(): View
    {
        $pendaftaran = Pendaftaran::with([
            'user.prodi',
            'study_case.jadwal_sesi',
            'wawancara.jadwal_sesi'
        ])->latest()->get();

        $sekarang = \Carbon\Carbon::now();

        foreach ($pendaftaran as $item) {

            $statusBerkas = strtolower($item->StatusBerkas ?? '');
            $statusCase = strtolower($item->study_case?->StatusCase ?? '');
            $statusWawancara = strtolower($item->wawancara?->StatusWawancara ?? '');

            if ($statusBerkas !== 'lolos') {
                $item->statusTerkini = 'Seleksi Berkas';
                $item->tahapAktif = 'berkas';
            } elseif ($statusCase !== 'lolos') {
                $item->statusTerkini = 'Study Case';
                $item->tahapAktif = 'study_case';
            } elseif ($statusWawancara !== 'lolos') {
                $item->statusTerkini = 'Wawancara';
                $item->tahapAktif = 'wawancara';
            } else {
                $item->statusTerkini = 'Menunggu Pengumuman';
                $item->tahapAktif = null;
            }
        
            $item->bolehKelolaStatus = false;

            // seleksi berkas
            if ($item->tahapAktif === 'berkas') {
                $jadwal = JadwalSesi::where('NamaSesi', 'Berkas')
                    ->orderBy('TanggalSelesai', 'desc')
                    ->first();
                if ($jadwal && $sekarang->greaterThan(
                    \Carbon\Carbon::parse($jadwal->TanggalSelesai)->endOfDay()
                )) {

                    $item->bolehKelolaStatus = true;
                }
            }

            // study case
            elseif ($item->tahapAktif === 'study_case') {
                $jadwal = $item->study_case?->jadwal_sesi;
                if ($jadwal && $sekarang->greaterThan(
                    \Carbon\Carbon::parse($jadwal->TanggalSelesai)->endOfDay()
                )) {
                    $item->bolehKelolaStatus = true;
                }
            }

            // wawancara
            elseif ($item->tahapAktif === 'wawancara') {
                $jadwal = $item->wawancara?->jadwal_sesi;
                if ($jadwal && $sekarang->greaterThan(
                    \Carbon\Carbon::parse($jadwal->TanggalSelesai)->endOfDay()
                )) {
                    $item->bolehKelolaStatus = true;
                }
            }

            $jadwalSesi = JadwalSesi::orderBy('TanggalMulai', 'asc')->get();

            return view('admin.peserta', compact('pendaftaran'));
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::with([
            'study_case.jadwal_sesi',
            'wawancara.jadwal_sesi'
        ])->findOrFail($id);

        $tahap = $request->input('tahap');
        $hasil = $request->input('hasil');

        // Validasi hasil
        if (!in_array($hasil, ['lolos', 'tidak_lolos'])) {
            return back()->with('error', 'Hasil seleksi tidak valid.');
        }

        $sekarang = \Carbon\Carbon::now();

        // Berkas
        if ($tahap == 'berkas') {
            if (strtolower($pendaftaran->StatusBerkas ?? '') === 'lolos') {
                return back()->with(
                    'error', 'Status seleksi berkas yang sudah lolos tidak dapat diubah'
                );
            }

            // Cari jadwal berkas
            $jadwalBerkas = JadwalSesi::where('NamaSesi', 'Berkas')->orderBy('TanggalSelesai', 'desc')->first();

            if (!$jadwalBerkas) {
                return back()->with(
                    'error', 'Jadwal seleksi berkas belum tersedia.'
                );
            }

            // cek seleksi selesai
            $tanggalSelesai = \Carbon\Carbon::perse(
                $jadwalBerkas->TanggalSelesai
            )->endOfDay();

            if ($sekarang->lessThan($tanggalSelesai)) {
                return back()->with('error', 'Seleksi berkas belum selesai.');
            }

            $pendaftaran->StatusBerkas = $hasil;
            $pendaftaran->save();

            return back()->with(
                'success', 'Status seleksi berkas berhasil diperbarui.'
            );
        }

        // Study Case
        if ($tahap === 'study_case') {
            // Berkas harus sudah lolos
            if (strtolower($pendaftaran->StatusBerkas ?? '') !== 'lolos') {
                return back()->with(
                    'error', 'Study Case belum dapat diproses karena seleksi berkas belum Lolos.'
                );
            }
            // Harus sudah ada data Study Case
            if (!$pendaftaran->study_case) {
                return back()->with(
                    'error', 'Data Study Case peserta belum tersedia.'
                );
            }

            // Tidak boleh mengubah jika sudah lolos
            if (strtolower($pendaftaran->study_case->StatusCase ?? '') === 'lolos') {
                return back()->with(
                    'error', 'Status Study Case yang sudah Lolos tidak dapat diubah.'
                );
            }

            $jadwalStudyCase = $pendaftaran->study_case->jadwal_sesi;
            if(!$jadwalStudyCase) {
                return back()->with(
                    'error', 'Jadwal study case peserta belum tersedia.'
                );
            }

            $tanggalSelesai = \Carbon\Carbon::parse(
                $jadwalStudyCase->TanggalSelesai
            )->endOfDay();

            if ($sekarang->lessThan($tanggalSelesai)) {
                return back()->with(
                    'error',
                    'Study Case belum selesai.'
                );
            }

            $pendaftaran->study_case->StatusCase = $hasil;
            $pendaftaran->study_case->save();

            return back()->with(
                'success', 'Status Study Case berhasil diperbarui.'
            );
        }

        // Wawancara
        if ($tahap === 'wawancara') {

            // Berkas harus lolos
            if (strtolower($pendaftaran->StatusBerkas ?? '') !== 'lolos') {
                return back()->with(
                    'error', 'Wawancara belum dapat diproses.'
                );
            }

            // Study Case harus lolos
            if (strtolower($pendaftaran->study_case?->StatusCase ?? '') !== 'lolos') {
                return back()->with(
                    'error', 'Wawancara belum dapat diproses karena Study Case belum Lolos.'
                );
            }

            // Harus ada data wawancara
            if (!$pendaftaran->wawancara) {
                return back()->with(
                    'error', 'Data wawancara peserta belum tersedia.'
                );
            }

            // Tidak boleh mengubah jika sudah lolos
            if (strtolower($pendaftaran->wawancara->StatusWawancara ?? '') === 'lolos') {
                return back()->with(
                    'error',
                    'Status Wawancara yang sudah Lolos tidak dapat diubah.'
                );
            }

            $jadwalWawancara = $pendaftaran->wawancara->jadwal_sesi;
            if (!$jadwalWawancara) {
                return back()->with(
                    'error',
                    'Jadwal Wawancara peserta belum tersedia.'
                );
            }

            // Cek tanggal selesai
            $tanggalSelesai = \Carbon\Carbon::parse(
                $jadwalWawancara->TanggalSelesai
            )->endOfDay();

            if ($sekarang->lessThan($tanggalSelesai)) {
                return back()->with(
                    'error',
                    'Wawancara belum selesai.'
                );
            }

            $pendaftaran->wawancara->StatusWawancara = $hasil;
            $pendaftaran->wawancara->save();

            return back()->with(
                'success', 'Status Wawancara berhasil diperbarui.'
            );
        }

        return back()->with('error', 'Tahapan seleksi tidak valid.');
    }

    public function jadwal()
    {
        $jadwalSesi = JadwalSesi::orderBy('TanggalMulai', 'asc')->get();
        return view('admin.jadwal', compact('jadwalSesi'));
    }

    public function storeJadwal(Request $request)
    {
        $request->validate([
            'NamaSesi' => 'required|string',
        ]);

        $namaSesi = $request->input('NamaSesi');
        $pembagianHari = (int) $request->input('pembagian_hari', 1);

        // Tahapan Berkas
        if (strtolower($namaSesi) === 'berkas') {
            $request->validate([
                'TanggalMulai' => 'required|date',
                'TanggalSelesai' => "required|date|ater_or_equal:TanggalMulai",
                'Jam' => 'required',
                'Lokasi' => 'required|string|max:50',
            ]);

            $jadwalData = [
                'NamaSesi' => $namaSesi,
                'TanggalMulai' => $request->TanggalMulai,
                'TanggalSelesai' => $request->TanggalSelesai,
                'Jam' => $request->Jam,
                'Lokasi' => $request->Lokasi,
                'IsActive' => $request->has('IsActive') ? 1 : 0,
            ];

            JadwalSesi::create($jadwalData);
        }

        // jika study case dan wawancara >1 hari
        if ($pembagianHari > 1 && $request->has('hari')) {
            foreach ($request->input('hari') as $index => $dataHari) {
                if (!empty($dataHari['tanggal'])) {
                    $jadwalData = [
                        'NamaSesi' => $namaSesi . ' (Hari ke-' . ($index + 1) . ')',
                        'TanggalMulai' => $dataHari['tanggal'],
                        'Jam' => $dataHari['jam'] ?? '09:00',
                        'IsActive' => $request->has('IsActive') ? 1 : 0,
                    ];
                    if (Schema::hasColumn('jadwal_sesi', 'Lokasi') && !empty($dataHari['lokasi'])) {
                        $jadwalData['Lokasi'] = $dataHari['lokasi'];
                    }
                    JadwalSesi::create($jadwalData);
                }
            }
        } 
        
        // jika study case dan wawancara hanya 1 hari
        else {
            $request->validate([
                'TanggalMulai' => 'required|date',
                'Jam' => 'required',
            ]);

            $jadwalData = [
                'NamaSesi' => $namaSesi,
                'TanggalMulai' => $request->TanggalMulai,
                'Jam' => $request->Jam,
                'IsActive' => $request->has('IsActive') ? 1 : 0,
            ];
            if (Schema::hasColumn('jadwal_sesi', 'Lokasi') && !empty($request->Lokasi)) {
                $jadwalData['Lokasi'] = $request->Lokasi;
            }
            JadwalSesi::create($jadwalData);
        }

        return redirect()->back()->with('success', 'Jadwal tahapan seleksi ' . $namaSesi . ' berhasil didaftarkan!');
    }

    public function destroyJadwal($id)
    {
        $jadwal = JadwalSesi::findOrFail($id);
        $jadwal->delete();

        return redirect()->back()->with('success', 'Jadwal sesi berhasil dihapus!');
    }


}