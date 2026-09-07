<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        // 1. Ambil ID user yang sedang login
        $userId = auth()->user()->UserId;

        // 2. Tarik data user beserta relasi ke prodi->fakultas dan pendaftaran
        $user = User::with(['prodi.fakultas', 'pendaftaran.study_case', 'pendaftaran.wawancara'])->findOrFail($userId);

        // 3. Mengambil data pendaftaran paling terbaru milik user (jika ada)
        $pendaftaran = $user->pendaftaran->last();

        $tahapan = [
            1 => 'Berkas',
            2 => 'Study Case',
            3 => 'Wawancara',
            4 => 'Pengumuman',
        ];

        $nomorTahap = 1;
        if ($pendaftaran?->wawancara?->StatusWawancara === 'Lolos') {
            $nomorTahap = 4;
        } elseif ($pendaftaran?->study_case?->StatusKasus === 'Lolos') {
            $nomorTahap = 3;
        } elseif ($pendaftaran?->StatusBerkas === 'Lolos') {
            $nomorTahap = 2;
        }

        $tahapAktif = [
            'nomor' => $nomorTahap,
            'nama' => $tahapan[$nomorTahap] ?? 'Belum Mendaftar',
        ];
        // 4. Kirim data ke tampilan view profile
        return view('user.profile', compact('user', 'pendaftaran', 'tahapAktif'));
    }
}
