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

        foreach ($pendaftaran as $item) {

            $statusCase = $item->study_case?->StatusCase;
            $statusWawancara = $item->wawancara?->StatusWawancara;

            if ($item->StatusBerkas === 'pending') {

                $item->statusTerkini = 'Seleksi Berkas';

            } elseif (
                $item->StatusBerkas === 'lolos' &&
                $statusCase !== 'lolos'
            ) {

                $item->statusTerkini = 'Study Case';

            } elseif (
                $statusCase === 'lolos' &&
                $statusWawancara !== 'lolos'
            ) {

                $item->statusTerkini = 'Wawancara';

            } elseif ($statusWawancara === 'lolos') {

                $item->statusTerkini = 'Menunggu Pengumuman';

            } else {

                $item->statusTerkini = 'Seleksi Berkas';
            }
        }

        $jadwalSesi = JadwalSesi::orderBy('TanggalMulai', 'asc')->get();

        return view('admin.peserta', compact('pendaftaran'));
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