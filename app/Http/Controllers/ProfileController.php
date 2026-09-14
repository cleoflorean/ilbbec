<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Prodi;

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

        $prodis = Prodi::all();
        // 4. Kirim data ke tampilan view profile
        return view('user.profile', compact('user', 'pendaftaran', 'tahapAktif', 'prodis'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        // Validasi input
        $validatedData = $request->validate([
            'Nama' => 'required|string|max:255',
            'Npm' => 'required|string|max:20|unique:users,Npm,' . $user->UserId . ',UserId',
            'NoTlp' => 'nullable|string|max:20',
            'TanggalLahir' => 'nullable|string|max:500',
            'ProdiId' => 'required|exists:prodi,ProdiId',
        ]);

        // Update data user
        $user->update($validatedData);

        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
