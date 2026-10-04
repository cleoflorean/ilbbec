<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            'Gender'       => 'required|in:Laki laki,Perempuan',
        ], [
            'Npm.unique'         => 'NPM ini sudah terdaftar.',
            'Email.unique'       => 'Email ini sudah digunakan.',
            'Password.confirmed' => 'Konfirmasi password tidak cocok.',
            'Angkatan.digits'    => 'Angkatan harus 4 digit (contoh: 2024).',
        ]);

        $emailClean = strtolower($request->string('Email')->trim()->toString());
        $hashedPassword = Hash::make($request->Password);

        DB::transaction(function () use ($request, $emailClean, $hashedPassword) {
            User::create([
                'ProdiId'      => $request->ProdiId,
                'Nama'         => trim((string) $request->Nama),
                'Npm'          => $request->Npm,
                'TempatLahir'  => trim((string) $request->TempatLahir),
                'TanggalLahir' => $request->TanggalLahir,
                'NoTlp'        => trim((string) $request->NoTlp),
                'Email'        => $emailClean,
                'Password'     => $hashedPassword,
                'Angkatan'     => $request->Angkatan,
                'Gender'       => $request->Gender,
                'Role'         => 'user',
            ]);
        });

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan masuk.');
    }

    // ── Tampilkan form login ───────────────────────────────────────────────────
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }

        return view('auth.login');
    }

    // ── Proses login ──────────────────────────────────────────────────────────
    public function login(Request $request)
    {
        $request->validate([
            'Email'    => 'required|email',
            'Password' => 'required|string',
        ]);

        $credentials = [
            'Email' => strtolower($request->string('Email')->trim()->toString()),
            'password' => $request->string('Password')->toString(),
        ];

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'Email' => 'Email atau password salah.',
            ])->onlyInput('Email');
        }

        $request->session()->regenerate();
        $user = Auth::user();

        return $this->redirectByRole($user)->with('success', 'Selamat datang, ' . $user->Nama . '!');
    }

    private function normalizeRole(?string $role): string
    {
        $role = strtolower(trim((string) $role));

        return match ($role) {
            'admin' => 'admin',
            'pres', 'presiden' => 'pres',
            'hr', 'human resources', 'human_resources' => 'hr',
            'cc', 'curiculum', 'curriculum' => 'cc',
            'bendahara' => 'bendahara',
            'sekretaris' => 'sekretaris',
            'pr', 'public relation', 'public_relation' => 'pr',
            'medinfo', 'media & information', 'media_and_information', 'media-information' => 'medinfo',
            'user' => 'user',
            default => 'invalid',
        };
    }

    private function redirectByRole(User $user)
    {
        return match ($this->normalizeRole($user->Role)) {
            'admin', 'pres', 'hr', 'cc', 'bendahara', 'sekretaris', 'pr', 'medinfo' => redirect()->route('admin.home'),
            'user' => redirect()->route('user.home'),
            default => $this->rejectInvalidRole(),
        };
    }

    private function rejectInvalidRole(): never
    {
        Auth::logout();
        abort(403, 'Role pengguna tidak valid.');
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
