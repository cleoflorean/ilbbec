<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ── Tampilkan form registrasi ──────────────────────────────────────────────
    public function showRegister()
    {
        $prodis = Prodi::orderBy('NamaProdi')->get();
        return view('auth.register', compact('prodis'));
    }

    // ── Proses registrasi ─────────────────────────────────────────────────────
    public function register(Request $request)
    {
        $request->validate([
            'Nama'         => 'required|string|max:100',
            'Npm'          => 'required|integer|unique:users,Npm',
            'ProdiId'      => 'required|exists:prodi,ProdiId',
            'TempatLahir'  => 'required|string|max:50',
            'TanggalLahir' => 'required|date',
            'NoTlp'        => 'required|string|max:15',
            'Email'        => 'required|email|max:50|unique:users,Email',
            'Password'     => 'required|string|min:8|confirmed',
            'Angkatan'     => 'required|integer|digits:4',
        ], [
            'Npm.unique'   => 'NPM ini sudah terdaftar.',
            'Email.unique' => 'Email ini sudah digunakan.',
            'Password.confirmed' => 'Konfirmasi password tidak cocok.',
            'Angkatan.digits'    => 'Angkatan harus 4 digit (contoh: 2024).',
        ]);

        User::create([
            'ProdiId'      => $request->ProdiId,
            'Nama'         => $request->Nama,
            'Npm'          => $request->Npm,
            'TempatLahir'  => $request->TempatLahir,
            'TanggalLahir' => $request->TanggalLahir,
            'NoTlp'        => $request->NoTlp,
            'Email'        => $request->Email,
            'Password'     => Hash::make($request->Password),
            'Angkatan'     => $request->Angkatan,
            'Role'         => 'user',
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan masuk.');
    }

    // ── Tampilkan form login ───────────────────────────────────────────────────
    public function showLogin()
    {
        return view('auth.login');
    }

    // ── Proses login ──────────────────────────────────────────────────────────
    public function login(Request $request)
    {
        $request->validate([
            'Email'    => 'required|email',
            'Password' => 'required|string',
        ]);

        $user = User::where('Email', $request->Email)->first();

        if (!$user || !Hash::check($request->Password, $user->Password)) {
            return back()->withErrors([
                'Email' => 'Email atau password salah.',
            ])->withInput($request->only('Email'));
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Selamat datang, ' . $user->Nama . '!');
    }

    // ── Logout ────────────────────────────────────────────────────────────────
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
