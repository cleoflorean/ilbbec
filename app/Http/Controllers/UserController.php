<?php

namespace App\Http\Controllers;

use App\Models\JadwalPendaftar;
use App\Models\JadwalSesi;
use App\Models\Pendaftaran;
use App\Models\StudyCase;
use App\Models\User;
use App\Models\Wawancara;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        
        $pendaftaran = $user->pendaftaran()->with([
            'study_case.jadwal_sesi',
            'wawancara.jadwal_sesi',
            'jadwal_pendaftar.jadwal_sesi',
        ])->first();

        $hasPendaftaran = ($pendaftaran !== null);
        $sekarang = Carbon::now();

        // 1. Ambil pilihan jadwal yang sudah tersimpan
        $selectedJadwalSC = null;
        $selectedJadwalWwn = null;

        if ($pendaftaran) {
            $jpSC = $pendaftaran->jadwal_study_case;
            $selectedJadwalSC = $jpSC ? $jpSC->jadwal_sesi : optional($pendaftaran->study_case)->jadwal_sesi;

            $jpWwn = $pendaftaran->jadwal_wawancara;
            $selectedJadwalWwn = $jpWwn ? $jpWwn->jadwal_sesi : optional($pendaftaran->wawancara)->jadwal_sesi;
        }

        // 2. Ambil daftar jadwal available yang disediakan admin
        $availableJadwalSC = JadwalSesi::available()
            ->forTahap('Study')
            ->orderBy('TanggalMulai', 'asc')
            ->orderBy('Jam', 'asc')
            ->get();

        $availableJadwalWwn = JadwalSesi::available()
            ->forTahap('Wawancara')
            ->orderBy('TanggalMulai', 'asc')
            ->orderBy('Jam', 'asc')
            ->get();

        // 3. Status Tiap Tahap
        $statusBerkas = strtolower($pendaftaran->StatusBerkas ?? '');
        $statusSC = strtolower($pendaftaran->study_case->StatusKasus ?? $pendaftaran->study_case->StatusCase ?? '');
        $statusWwn = strtolower($pendaftaran->wawancara->StatusWawancara ?? '');

        $lolosBerkas = ($statusBerkas === 'lolos');
        $lolosSC = ($statusSC === 'lolos');
        $lolosWwn = ($statusWwn === 'lolos');

        $selesaiBerkas = $hasPendaftaran;
        $selesaiSC = $lolosSC || in_array($statusSC, ['selesai']);
        $selesaiWwn = $lolosWwn || in_array($statusWwn, ['selesai']);
        $selesaiPengumuman = $pendaftaran && !is_null($pendaftaran->StatusAkhir) && $pendaftaran->StatusAkhir !== 'Menunggu';
        $aktifPengumuman = $pendaftaran && !is_null($pendaftaran->StatusAkhir);

        // Hitung Progres Timeline (0% - 100%)
        if ($selesaiPengumuman) {
            $progressWidth = '75%';
        } elseif ($selesaiWwn || $selectedJadwalWwn) {
            $progressWidth = '50%';
        } elseif ($selesaiSC || $selectedJadwalSC) {
            $progressWidth = '25%';
        } elseif ($selesaiBerkas) {
            $progressWidth = '12.5%';
        } else {
            $progressWidth = '0%';
        }

        return view('user.home', compact(
            'user',
            'pendaftaran',
            'hasPendaftaran',
            'sekarang',
            'selectedJadwalSC',
            'selectedJadwalWwn',
            'availableJadwalSC',
            'availableJadwalWwn',
            'lolosBerkas',
            'lolosSC',
            'lolosWwn',
            'selesaiBerkas',
            'selesaiSC',
            'selesaiWwn',
            'selesaiPengumuman',
            'aktifPengumuman',
            'progressWidth'
        ));
    }

    public function pilihJadwal(Request $request)
    {
        $request->validate([
            'SesiId' => 'required|integer|exists:jadwal_sesi,SesiId',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $pendaftaran = $user->pendaftaran()->first();

        if (!$pendaftaran) {
            return redirect()->back()->with('error', 'Anda harus mengisi formulir pendaftaran terlebih dahulu.');
        }

        $jadwalSesi = JadwalSesi::findOrFail($request->SesiId);

        // Validasi ketersediaan jadwal
        if (
            $jadwalSesi->status === 'closed' ||
            $jadwalSesi->status === 'cancelled' ||
            ($jadwalSesi->IsActive !== null && !$jadwalSesi->IsActive)
        ) {
            return redirect()->back()->with('error', 'Jadwal yang Anda pilih sudah ditutup atau dibatalkan oleh admin.');
        }

        $isSC = str_contains(strtolower($jadwalSesi->NamaSesi), 'study');
        $isWwn = str_contains(strtolower($jadwalSesi->NamaSesi), 'wawancara');

        // Validasi kualifikasi tahapan
        $statusBerkas = strtolower($pendaftaran->StatusBerkas ?? '');
        if ($statusBerkas !== 'lolos') {
            return redirect()->back()->with('error', 'Anda belum dapat memilih jadwal karena seleksi berkas belum Lolos.');
        }

        if ($isWwn) {
            $statusSC = strtolower($pendaftaran->study_case->StatusKasus ?? $pendaftaran->study_case->StatusCase ?? '');
            if ($statusSC !== 'lolos') {
                return redirect()->back()->with('error', 'Anda belum dapat memilih jadwal wawancara karena tahap Study Case belum Lolos.');
            }
        }

        // Database transaction untuk menjamin data tersimpan bersih & tidak duplicate
        DB::transaction(function () use ($pendaftaran, $jadwalSesi, $isSC, $isWwn) {
            // Hapus assignment lama untuk tahapan yang sama agar tidak duplicate
            $oldAssignments = JadwalPendaftar::where('PendaftaranId', $pendaftaran->PendaftaranId)
                ->whereHas('jadwal_sesi', function ($q) use ($isSC, $isWwn) {
                    if ($isSC) {
                        $q->where('NamaSesi', 'LIKE', '%Study%');
                    } elseif ($isWwn) {
                        $q->where('NamaSesi', 'LIKE', '%Wawancara%');
                    }
                })->get();

            foreach ($oldAssignments as $old) {
                $old->delete();
            }

            // Simpan assignment jadwal yang dipilih
            JadwalPendaftar::create([
                'PendaftaranId' => $pendaftaran->PendaftaranId,
                'SesiId' => $jadwalSesi->SesiId,
                'status' => 'dikonfirmasi',
                'selected_at' => now(),
                'confirmed_at' => now(),
            ]);

            // Sinkronisasi data ke study_case / wawancara untuk kompatibilitas data
            if ($isSC) {
                StudyCase::updateOrCreate(
                    ['PendaftaranId' => $pendaftaran->PendaftaranId],
                    [
                        'SesiId' => $jadwalSesi->SesiId,
                        'Lokasi' => $jadwalSesi->Lokasi,
                    ]
                );
            } elseif ($isWwn) {
                Wawancara::updateOrCreate(
                    ['PendaftaranId' => $pendaftaran->PendaftaranId],
                    [
                        'SesiId' => $jadwalSesi->SesiId,
                        'Lokasi' => $jadwalSesi->Lokasi,
                    ]
                );
            }
        });

        return redirect()->back()->with('success', 'Jadwal ' . $jadwalSesi->NamaSesi . ' berhasil dipilih!');
    }
}
