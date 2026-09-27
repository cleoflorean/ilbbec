<?php

namespace App\Http\Controllers;

use App\Models\JadwalSesi;
use App\Models\Pendaftaran;
use App\Models\StudyCase;
use App\Models\User;
use App\Models\Wawancara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class AdminController extends Controller
{
    private function roleDivisionName(): ?string
    {
        $role = strtolower(trim((string) (Auth::user()?->Role ?? '')));

        return match ($role) {
            'admin', 'pres' => null,
            'hr' => 'Human Resources',
            'cc' => 'Curiculum',
            'bendahara' => 'Bendahara',
            'sekretaris' => 'Sekretaris',
            'pr' => 'Public Relation',
            'medinfo' => 'Media & Information',
            default => null,
        };
    }

    private function scopeToRoleDivision($query)
    {
        $division = $this->roleDivisionName();

        if ($division === null) {
            return $query;
        }

        return $query->whereRaw('LOWER(Divisi) = ?', [strtolower($division)]);
    }

    public function index(): View
    {
        $applicationsQuery = $this->scopeToRoleDivision(Pendaftaran::query());

        $metrics = [
            'candidates' => (clone $applicationsQuery)->distinct('UserId')->count('UserId'),
            'applications' => (clone $applicationsQuery)->count(),
            'study_cases' => (clone $applicationsQuery)->whereNotNull('StatusAkhir')->count(),
        ];

        $pipeline = [
            'Menunggu review' => (clone $applicationsQuery)->where('StatusBerkas', 'Menunggu')->count(),
            'Lolos berkas' => (clone $applicationsQuery)->where('StatusBerkas', 'Lolos')->count(),
            'Selesai' => (clone $applicationsQuery)->where('StatusAkhir', 'Lolos')->count(),
        ];

        $recentApplications = (clone $applicationsQuery)
            ->with('user')
            ->latest('created_at')
            ->limit(6)
            ->get();

        $nextSession = JadwalSesi::where(function ($q) {
                $q->where('status', 'available')->orWhereNull('status');
            })
            ->where(function ($q) {
                $q->where('IsActive', true)->orWhereNull('IsActive');
            })
            ->orderBy('TanggalMulai', 'asc')
            ->first();

        return view('admin.home', compact('metrics', 'pipeline', 'recentApplications', 'nextSession'));
    }

    public function peserta(): View
    {
        $pendaftaran = $this->scopeToRoleDivision(
            Pendaftaran::query()->with([
                'user.prodi',
                'study_case.jadwal_sesi',
                'wawancara.jadwal_sesi',
                'jadwal_pendaftar.jadwal_sesi'
            ])
        )
            ->latest()
            ->get();

        $sekarang = \Carbon\Carbon::now();

        foreach ($pendaftaran as $item) {
            $statusBerkas = strtolower($item->StatusBerkas ?? '');
            $statusCase = strtolower($item->study_case?->StatusKasus ?? $item->study_case?->StatusCase ?? '');
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
                $jadwal = JadwalSesi::where('NamaSesi', 'LIKE', '%Berkas%')
                    ->orderBy('TanggalSelesai', 'desc')
                    ->first();
                if ($jadwal && $jadwal->TanggalSelesai && $sekarang->greaterThan(
                    \Carbon\Carbon::parse($jadwal->TanggalSelesai)->endOfDay()
                )) {
                    $item->bolehKelolaStatus = true;
                } else {
                    $item->bolehKelolaStatus = true; // izinkan kelola berkas
                }
            }
            // study case
            elseif ($item->tahapAktif === 'study_case') {
                $jadwal = $item->study_case?->jadwal_sesi ?? $item->jadwal_study_case?->jadwal_sesi;
                if ($jadwal) {
                    $item->bolehKelolaStatus = true;
                }
            }
            // wawancara
            elseif ($item->tahapAktif === 'wawancara') {
                $jadwal = $item->wawancara?->jadwal_sesi ?? $item->jadwal_wawancara?->jadwal_sesi;
                if ($jadwal) {
                    $item->bolehKelolaStatus = true;
                }
            }
        }

        return view('admin.peserta', compact('pendaftaran'));
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
        if ($tahap === 'berkas') {
            if (strtolower($pendaftaran->StatusBerkas ?? '') === 'lolos') {
                return back()->with(
                    'error', 'Status seleksi berkas yang sudah lolos tidak dapat diubah'
                );
            }

            $pendaftaran->StatusBerkas = ($hasil === 'lolos') ? 'Lolos' : 'Tidak Lolos';
            $pendaftaran->save();

            return back()->with(
                'success', 'Status seleksi berkas berhasil diperbarui.'
            );
        }

        // Study Case
        if ($tahap === 'study_case') {
            if (strtolower($pendaftaran->StatusBerkas ?? '') !== 'lolos') {
                return back()->with(
                    'error', 'Study Case belum dapat diproses karena seleksi berkas belum Lolos.'
                );
            }

            if (!$pendaftaran->study_case) {
                // Buat record study_case jika belum ada
                $pendaftaran->study_case()->create([
                    'StatusKasus' => ($hasil === 'lolos') ? 'Lolos' : 'Tidak Lolos',
                ]);
            } else {
                $pendaftaran->study_case->StatusKasus = ($hasil === 'lolos') ? 'Lolos' : 'Tidak Lolos';
                $pendaftaran->study_case->save();
            }

            return back()->with(
                'success', 'Status Study Case berhasil diperbarui.'
            );
        }

        // Wawancara
        if ($tahap === 'wawancara') {
            if (strtolower($pendaftaran->StatusBerkas ?? '') !== 'lolos') {
                return back()->with(
                    'error', 'Wawancara belum dapat diproses.'
                );
            }

            if (!$pendaftaran->wawancara) {
                // Buat record wawancara jika belum ada
                $pendaftaran->wawancara()->create([
                    'StatusWawancara' => ($hasil === 'lolos') ? 'Lolos' : 'Tidak Lolos',
                ]);
            } else {
                $pendaftaran->wawancara->StatusWawancara = ($hasil === 'lolos') ? 'Lolos' : 'Tidak Lolos';
                $pendaftaran->wawancara->save();
            }

            // Jika lolos wawancara, set StatusAkhir pendaftaran
            if ($hasil === 'lolos') {
                $pendaftaran->StatusAkhir = 'Lolos';
            } else {
                $pendaftaran->StatusAkhir = 'Tidak Lolos';
            }
            $pendaftaran->save();

            return back()->with(
                'success', 'Status Wawancara berhasil diperbarui.'
            );
        }

        return back()->with('error', 'Tahapan seleksi tidak valid.');
    }

    public function jadwal()
    {
        $jadwalSesi = JadwalSesi::with([
            'jadwal_pendaftar.pendaftaran.user.prodi'
        ])
        ->withCount('jadwal_pendaftar')
        ->orderBy('TanggalMulai', 'asc')
        ->orderBy('Jam', 'asc')
        ->get();

        return view('admin.jadwal', compact('jadwalSesi'));
    }

    public function storeJadwal(Request $request)
    {
        $request->validate([
            'NamaSesi' => 'required|string',
            'TanggalMulai' => 'required|date',
            'Jam' => 'required',
            'Lokasi' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:available,closed,cancelled',
        ]);

        $namaSesi = $request->input('NamaSesi');

        $jadwalData = [
            'NamaSesi' => $namaSesi,
            'TanggalMulai' => $request->TanggalMulai,
            'Jam' => $request->Jam,
            'Lokasi' => $request->Lokasi,
            'keterangan' => $request->keterangan,
            'status' => $request->input('status', 'available'),
            'IsActive' => $request->has('IsActive') ? 1 : 1,
        ];

        if (strtolower($namaSesi) === 'berkas' && $request->filled('TanggalBerakhir')) {
            $jadwalData['TanggalSelesai'] = $request->TanggalBerakhir;
        }

        JadwalSesi::create($jadwalData);

        return redirect()->back()->with('success', 'Jadwal seleksi ' . $namaSesi . ' berhasil ditambahkan!');
    }

    public function updateJadwal(Request $request, $id)
    {
        $jadwal = JadwalSesi::findOrFail($id);

        $request->validate([
            'NamaSesi' => 'required|string',
            'TanggalMulai' => 'required|date',
            'Jam' => 'required',
            'Lokasi' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'status' => 'required|string|in:available,closed,cancelled',
        ]);

        $jadwal->update([
            'NamaSesi' => $request->NamaSesi,
            'TanggalMulai' => $request->TanggalMulai,
            'Jam' => $request->Jam,
            'Lokasi' => $request->Lokasi,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Jadwal seleksi berhasil diperbarui!');
    }

    public function updateStatusJadwal(Request $request, $id)
    {
        $jadwal = JadwalSesi::findOrFail($id);

        $request->validate([
            'status' => 'required|in:available,closed,cancelled',
        ]);

        $jadwal->update([
            'status' => $request->status,
            'IsActive' => ($request->status === 'available') ? 1 : 0,
        ]);

        $statusLabel = match ($request->status) {
            'available' => 'Tersedia (Available)',
            'closed' => 'Ditutup (Closed)',
            'cancelled' => 'Dibatalkan (Cancelled)',
            default => $request->status,
        };

        return redirect()->back()->with('success', 'Status jadwal berhasil diubah menjadi: ' . $statusLabel);
    }

    public function destroyJadwal($id)
    {
        $jadwal = JadwalSesi::findOrFail($id);
        $jadwal->delete();

        return redirect()->back()->with('success', 'Jadwal sesi berhasil dihapus!');
    }
}