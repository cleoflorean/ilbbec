@extends('layouts.auth')
@section('title', 'Masuk')

@section('content')
<div class="w-full max-w-md">

    {{-- Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">

        {{-- Card Header --}}
        <div class="px-8 pt-8 pb-6 border-b border-slate-100">
            <div class="flex items-center gap-3 mb-1">
                <div class="w-9 h-9 rounded-xl bg-brand-blue-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-brand-navy">Masuk ke ILBBEC</h1>
                    <p class="text-xs text-slate-500">Gunakan email dan password yang terdaftar</p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('login.post') }}" class="px-8 py-7 space-y-5">
            @csrf

            {{-- Flash success (dari redirect setelah register) --}}
            @if(session('success'))
                <div class="flex items-center gap-2 px-4 py-3 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 text-xs">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error --}}
            @if($errors->any())
                <div class="flex items-center gap-2 px-4 py-3 bg-red-50 border border-red-200 rounded-xl text-red-600 text-xs">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $errors->first('Email') ?? $errors->first() }}
                </div>
            @endif

            {{-- Email --}}
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email" name="Email" value="{{ old('Email') }}" autofocus
                       class="w-full px-4 py-2.5 rounded-xl border text-sm transition-all duration-200
                              {{ $errors->has('Email') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-white' }}
                              focus:outline-none focus:ring-2 focus:ring-brand-blue/30 focus:border-brand-blue"
                       placeholder="nama@email.com">
            </div>

            {{-- Password --}}
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label class="text-xs font-semibold text-slate-700">
                        Password <span class="text-red-500">*</span>
                    </label>
                </div>
                <div class="relative">
                    <input type="password" name="Password" id="login-password"
                           class="w-full px-4 py-2.5 pr-10 rounded-xl border text-sm transition-all duration-200
                                  border-slate-200 bg-white
                                  focus:outline-none focus:ring-2 focus:ring-brand-blue/30 focus:border-brand-blue"
                           placeholder="Masukkan password">
                    <button type="button" onclick="toggleLoginPass()"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-brand-blue">
                        <svg id="login-eye" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Submit --}}
            <div class="pt-1">
                <button type="submit"
                        class="w-full py-3 rounded-xl bg-brand-blue hover:bg-brand-blue-dark text-white
                               font-semibold text-sm shadow-md hover:shadow-lg transition-all duration-200
                               flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Masuk
                </button>
            </div>

            {{-- Divider --}}
            <div class="flex items-center gap-3 text-slate-300 text-xs">
                <div class="flex-1 border-t border-slate-100"></div>
                <span>atau</span>
                <div class="flex-1 border-t border-slate-100"></div>
            </div>

            {{-- Link ke register --}}
            <p class="text-center text-xs text-slate-500">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-brand-blue font-semibold hover:underline">
                    Daftar sekarang
                </a>
            </p>

        </form>
    </div>

    {{-- Info box --}}
    <div class="mt-4 flex items-start gap-2.5 px-4 py-3 bg-brand-blue-50 border border-brand-blue-100 rounded-xl text-xs text-brand-blue">
        <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span>Login menggunakan <strong>Email</strong> dan <strong>Password</strong> yang kamu daftarkan saat registrasi.</span>
    </div>

</div>

<script>
    function toggleLoginPass() {
        const input = document.getElementById('login-password');
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>
@endsection
