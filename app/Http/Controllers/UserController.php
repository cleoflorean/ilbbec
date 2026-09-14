<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        // $hasPendaftaran = $user->pendaftaran()->exists();
        $pendaftaran = $user->pendaftaran()->with([
            'study_case.jadwal_sesi',
            'wawancara.jadwal_sesi'
        ])->first();

        $hasPendaftaran = $pendaftaran !== null;

        return view('user.home', compact('user', 'hasPendaftaran', 'pendaftaran'));
    }

    public function home()
    {
        // Ambil data pendaftaran milik user yang sedang login
        $pendaftaran = Pendaftaran::where('UserId', auth()->id())->first();
        
        // 1. Relasi & Data Pendaftaran
        $sekarang = Carbon::now();
        $tglPendaftaran = $pendaftaran
            ? $pendaftaran->created_at
            : null;
        $hasPendaftaran = !is_null($pendaftaran);
        $studyCase = optional($pendaftaran)->study_case;
        $jadwalSC = optional($studyCase)->jadwal_sesi;
        $wawancara = optional($pendaftaran)->wawancara;
        $jadwalWwn = optional($wawancara)->jadwal_sesi;

        // 2. Parse Tanggal Langsung dari Database
        $tglSC = ($jadwalSC && $jadwalSC->TanggalSesi)
            ? Carbon::parse($jadwalSC->TanggalSesi)
            : null;
        $tglWwn = ($jadwalWwn && $jadwalWwn->TanggalSesi)
            ? Carbon::parse($jadwalWwn->TanggalSesi)
            : null;

        // 3. Logika Kondisional H-5 & Keaktifan Sesi
        $bukaSC = $tglSC &&
            $sekarang->copy()->addDays(5)->greaterThanOrEqualTo($tglSC);
        $aktifSC = $tglSC &&
            $sekarang->greaterThanOrEqualTo($tglSC);
        $bukaWwn = $tglWwn &&
            $sekarang->copy()->addDays(5)->greaterThanOrEqualTo($tglWwn);
        $aktifWwn = $tglWwn &&
            $sekarang->greaterThanOrEqualTo($tglWwn);

        // 4. Status Penyelesaian Tiap Tahap
        $selesaiBerkas = $hasPendaftaran;
        $selesaiSC = $studyCase &&
            (
                !is_null($studyCase->NilaiKasus) ||
                in_array($studyCase->StatusKasus, ['Selesai', 'Lolos'])
            );
        $selesaiWwn = $wawancara &&
            (
                !is_null($wawancara->NilaiWawancara) ||
                in_array($wawancara->StatusWawancara, ['Selesai', 'Lolos'])
            );
        $selesaiPengumuman = $pendaftaran &&
            !is_null($pendaftaran->StatusAkhir) &&
            $pendaftaran->StatusAkhir !== 'Menunggu';
        $aktifPengumuman = $pendaftaran &&
            !is_null($pendaftaran->StatusAkhir);

        // 5. Hitung Progres Timeline
        if ($selesaiPengumuman) {
            $progressWidth = '75%';
        } elseif ($selesaiWwn || $aktifWwn) {
            $progressWidth = '50%';
        } elseif ($selesaiSC || $aktifSC) {
            $progressWidth = '25%';
        } elseif ($selesaiBerkas) {
            $progressWidth = '12.5%';
        } else {
            $progressWidth = '0%';
        }

        // Kirim semua data ke halaman user.home
        return view('user.home', compact(
            'pendaftaran',
            'sekarang',
            'tglPendaftaran',
            'hasPendaftaran',
            'studyCase',
            'jadwalSC',
            'wawancara',
            'jadwalWwn',
            'tglSC',
            'tglWwn',
            'bukaSC',
            'aktifSC',
            'bukaWwn',
            'aktifWwn',
            'selesaiBerkas',
            'selesaiSC',
            'selesaiWwn',
            'selesaiPengumuman',
            'aktifPengumuman',
            'progressWidth'
        ));
    }
}
