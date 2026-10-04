@extends('layouts.auth')
@section('title', 'Daftar Akun')

@section('content')
<div class="w-full max-w-2xl">

    {{-- Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">

        {{-- Card Header --}}
        <div class="px-5 sm:px-8 pt-6 sm:pt-8 pb-5 sm:pb-6 border-b border-slate-100">
            <div class="flex items-center gap-3 mb-1">
                <div class="w-9 h-9 rounded-xl bg-brand-blue-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-brand-navy">Daftar Akun ILBBEC</h1>
                    <p class="text-xs text-slate-500">Lengkapi data diri untuk bergabung</p>
                </div>
            </div>
        </div>

        <form id="register-form" method="POST" action="{{ route('register') }}" class="px-5 sm:px-8 py-6 sm:py-7 space-y-5">
            @csrf

            {{-- Flash success --}}
            @if(session('success'))
                <div class="flex items-center gap-2 px-4 py-3 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 text-xs">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Rate limit error banner --}}
            @if($errors->has('rate_limit'))
                <div class="flex items-center gap-3 px-4 py-3 bg-amber-50 border border-amber-200 rounded-xl text-amber-800 text-xs">
                    <svg class="w-5 h-5 flex-shrink-0 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <div>
                        <p class="font-semibold">Pembatasan Antrean Server</p>
                        <p>{{ $errors->first('rate_limit') }}</p>
                    </div>
                </div>
            @endif

            {{-- Global error --}}
            @if($errors->any() && !$errors->has('rate_limit'))
                <div class="px-4 py-3 bg-red-50 border border-red-200 rounded-xl text-red-600 text-xs space-y-1">
                    @foreach($errors->all() as $error)
                        <p class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $error }}
                        </p>
                    @endforeach
                </div>
            @endif

            {{-- Row 1: Nama & NPM --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="Nama" value="{{ old('Nama') }}" required
                           class="w-full px-4 py-2.5 rounded-xl border text-sm transition-all duration-200
                                  {{ $errors->has('Nama') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-white' }}
                                  focus:outline-none focus:ring-2 focus:ring-brand-blue/30 focus:border-brand-blue"
                           placeholder="Masukkan nama lengkap">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                        NPM <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="Npm" value="{{ old('Npm') }}" required
                           class="w-full px-4 py-2.5 rounded-xl border text-sm transition-all duration-200
                                  {{ $errors->has('Npm') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-white' }}
                                  focus:outline-none focus:ring-2 focus:ring-brand-blue/30 focus:border-brand-blue"
                           placeholder="Nomor Pokok Mahasiswa">
                </div>
            </div>

            {{-- Row 2: Program Studi & Angkatan --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                        Program Studi <span class="text-red-500">*</span>
                    </label>
                    <select name="ProdiId" required
                            class="w-full px-4 py-2.5 rounded-xl border text-sm transition-all duration-200
                                   {{ $errors->has('ProdiId') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-white' }}
                                   focus:outline-none focus:ring-2 focus:ring-brand-blue/30 focus:border-brand-blue">
                        <option value="" disabled {{ old('ProdiId') ? '' : 'selected' }}>-- Pilih Program Studi --</option>
                        @foreach($prodis as $prodi)
                            <option value="{{ $prodi->ProdiId }}" {{ old('ProdiId') == $prodi->ProdiId ? 'selected' : '' }}>
                                {{ $prodi->NamaProdi }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                        Angkatan <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="Angkatan" value="{{ old('Angkatan') }}" required
                           class="w-full px-4 py-2.5 rounded-xl border text-sm transition-all duration-200
                                  {{ $errors->has('Angkatan') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-white' }}
                                  focus:outline-none focus:ring-2 focus:ring-brand-blue/30 focus:border-brand-blue"
                           placeholder="Contoh: 2024" maxlength="4">
                </div>
            </div>

            {{-- Row 3: Tempat & Tanggal Lahir --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                        Tempat Lahir <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="TempatLahir" value="{{ old('TempatLahir') }}" required
                           class="w-full px-4 py-2.5 rounded-xl border text-sm transition-all duration-200
                                  {{ $errors->has('TempatLahir') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-white' }}
                                  focus:outline-none focus:ring-2 focus:ring-brand-blue/30 focus:border-brand-blue"
                           placeholder="Kota kelahiran">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                        Tanggal Lahir <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="TanggalLahir" value="{{ old('TanggalLahir') }}" required
                           class="w-full px-4 py-2.5 rounded-xl border text-sm transition-all duration-200
                                  {{ $errors->has('TanggalLahir') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-white' }}
                                  focus:outline-none focus:ring-2 focus:ring-brand-blue/30 focus:border-brand-blue">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                        Gender <span class="text-red-500">*</span>
                    </label>
                    <select name="Gender" required
                            class="w-full px-4 py-2.5 rounded-xl border text-sm transition-all duration-200
                                   {{ $errors->has('Gender') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-white' }}
                                   focus:outline-none focus:ring-2 focus:ring-brand-blue/30 focus:border-brand-blue">
                        <option value="" disabled {{ old('Gender') ? '' : 'selected' }}>Pilih Gender</option>
                        <option value="Laki laki" {{ old('Gender') === 'Laki laki' ? 'selected' : '' }}>
                            Laki laki
                        </option>
                        <option value="Perempuan" {{ old('Gender') === 'Perempuan' ? 'selected' : '' }}>
                            Perempuan
                        </option>
                   </select>
                </div>
            </div>

            {{-- Row 4: No. HP & Email --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                        No. WhatsApp / HP <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" name="NoTlp" value="{{ old('NoTlp') }}" required
                           class="w-full px-4 py-2.5 rounded-xl border text-sm transition-all duration-200
                                  {{ $errors->has('NoTlp') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-white' }}
                                  focus:outline-none focus:ring-2 focus:ring-brand-blue/30 focus:border-brand-blue"
                           placeholder="08xxxxxxxxxx">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="Email" value="{{ old('Email') }}" required
                           class="w-full px-4 py-2.5 rounded-xl border text-sm transition-all duration-200
                                  {{ $errors->has('Email') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-white' }}
                                  focus:outline-none focus:ring-2 focus:ring-brand-blue/30 focus:border-brand-blue"
                           placeholder="nama@email.com">
                </div>
            </div>

            {{-- Row 5: Password & Konfirmasi --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" name="Password" id="password" required minlength="8"
                               class="w-full px-4 py-2.5 pr-10 rounded-xl border text-sm transition-all duration-200
                                      {{ $errors->has('Password') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-white' }}
                                      focus:outline-none focus:ring-2 focus:ring-brand-blue/30 focus:border-brand-blue"
                               placeholder="Min. 8 karakter">
                        <button type="button" onclick="togglePass('password', 'eye1')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-brand-blue">
                            <svg id="eye1" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                        Konfirmasi Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" name="Password_confirmation" id="password_confirm" required minlength="8"
                               class="w-full px-4 py-2.5 pr-10 rounded-xl border text-sm transition-all duration-200
                                      border-slate-200 bg-white
                                      focus:outline-none focus:ring-2 focus:ring-brand-blue/30 focus:border-brand-blue"
                               placeholder="Ulangi password">
                        <button type="button" onclick="togglePass('password_confirm', 'eye2')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-brand-blue">
                            <svg id="eye2" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    <p id="password-match-msg" class="text-[11px] mt-1 hidden"></p>
                </div>
            </div>

            {{-- Submit Button with Double-Submit Prevention & Loading State --}}
            <div class="pt-2">
                <button type="submit" id="register-btn"
                        class="w-full py-3 rounded-xl bg-brand-blue hover:bg-brand-blue-dark text-white
                               font-semibold text-sm shadow-md hover:shadow-lg transition-all duration-200
                               flex items-center justify-center gap-2 cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed">
                    <span id="btn-icon" class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        <span>Buat Akun</span>
                    </span>
                    <span id="btn-loading" class="hidden items-center gap-2">
                        <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span>Memproses Pendaftaran...</span>
                    </span>
                </button>
            </div>

            {{-- Link ke login --}}
            <p class="text-center text-xs text-slate-500">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-brand-blue font-semibold hover:underline">
                    Masuk di sini
                </a>
            </p>

        </form>
    </div>

</div>

<script>
    function togglePass(inputId, iconId) {
        const input = document.getElementById(inputId);
        input.type = input.type === 'password' ? 'text' : 'password';
    }

    // Real-time password confirmation match check
    const pwdInput = document.getElementById('password');
    const pwdConfirmInput = document.getElementById('password_confirm');
    const matchMsg = document.getElementById('password-match-msg');

    function checkPasswordMatch() {
        if (!pwdConfirmInput.value) {
            matchMsg.classList.add('hidden');
            return;
        }
        matchMsg.classList.remove('hidden');
        if (pwdInput.value === pwdConfirmInput.value) {
            matchMsg.textContent = '✓ Password cocok';
            matchMsg.className = 'text-[11px] mt-1 text-emerald-600 font-medium';
        } else {
            matchMsg.textContent = '✗ Password belum cocok';
            matchMsg.className = 'text-[11px] mt-1 text-rose-500 font-medium';
        }
    }

    pwdInput.addEventListener('input', checkPasswordMatch);
    pwdConfirmInput.addEventListener('input', checkPasswordMatch);

    // Form submit throttling / double-click prevention
    const regForm = document.getElementById('register-form');
    const regBtn = document.getElementById('register-btn');
    const btnIcon = document.getElementById('btn-icon');
    const btnLoading = document.getElementById('btn-loading');

    regForm.addEventListener('submit', function (e) {
        if (regBtn.disabled) {
            e.preventDefault();
            return;
        }

        // Kunci tombol untuk mencegah duplikasi submit request
        regBtn.disabled = true;
        btnIcon.classList.add('hidden');
        btnLoading.classList.remove('hidden');
        btnLoading.classList.add('flex');
    });
</script>
@endsection
