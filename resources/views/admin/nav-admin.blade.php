<aside class="fixed inset-y-0 left-0 z-40 hidden w-64 flex-col bg-brand-navy text-white lg:flex">
    <div class="flex h-20 items-center gap-3 border-b border-white/10 px-6">
        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white p-1 shadow-sm">
            <img src="{{ asset('images/logo.png') }}" alt="ILBBEC Logo" class="h-full w-full object-contain">
        </div>
        <div><p class="text-lg font-bold tracking-tight">ILBBEC</p><p class="text-[10px] uppercase tracking-[0.2em] text-slate-400">Admin</p></div>
    </div>
    <div class="flex-1 overflow-y-auto px-4 py-7">
        <nav class="mt-3 space-y-1">
            <a href="{{ route('admin.home') }}" class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition {{ request()->routeIs('admin.home') ? 'bg-brand-blue text-white shadow-lg shadow-blue-950/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}"><svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 13h8V3H3v10zm0 8h8v-4H3v4zm10 0h8V11h-8v10zm0-18v4h8V3h-8z"/></svg>Home</a>
            <a href="{{ route('admin.peserta') }}" class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition {{ request()->routeIs('admin.peserta') ? 'bg-brand-blue text-white shadow-lg shadow-blue-950/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}"><svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 2h9l3 3v17H6V2zm3 7h6m-6 4h6m-6 4h4"/></svg>Kelola Peserta</a>
            <a href="{{ route('admin.jadwal') }}" class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/10 hover:text-white"><svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 19V5m0 14h16M8 16v-4m4 4V8m4 8V5"/></svg>Jadwal Seleksi</a>
            <a href="{{ route('admin.home') }}#schedule" class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/10 hover:text-white"><svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 2v4m8-4v4M3 10h18M5 4h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z"/></svg>Jadwal sesi</a>
        </nav>
    </div>
    <div class="border-t border-white/10 p-4">
        <div class="mb-3 flex items-center gap-3 rounded-xl bg-white/5 p-3"><div class="flex h-9 w-9 items-center justify-center rounded-full bg-brand-orange text-sm font-bold">{{ substr(auth()->user()->Nama, 0, 1) }}</div><div class="min-w-0"><p class="truncate text-sm font-semibold">{{ auth()->user()->Nama }}</p><p class="text-[11px] text-slate-400">Administrator</p></div></div>
        <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit" class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-300 transition hover:bg-red-500/10 hover:text-red-300"><svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10 17l5-5-5-5m5 5H3m13-8h3a2 2 0 012 2v12a2 2 0 01-2 2h-3"/></svg>Keluar</button></form>
    </div>
</aside>
<header class="sticky top-0 z-30 flex h-16 items-center justify-between border-b border-slate-200 bg-white/95 px-4 shadow-sm backdrop-blur lg:ml-64 lg:px-8">
    <div class="flex items-center gap-3">
        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-brand-blue text-white lg:hidden">
            <span class="text-sm font-bold">I</span>
        </div>
        <div>
            <p class="text-sm font-bold text-brand-navy">ILBBEC Operations</p>
            <p class="hidden text-xs text-slate-400 sm:block">Recruitment management system</p>
        </div>
    </div>
    <div class="flex items-center gap-2 sm:gap-3">
        <span class="hidden items-center gap-2 text-xs font-medium text-emerald-600 sm:flex">
            <span class="h-2 w-2 rounded-full bg-emerald-500"></span>System online
        </span>
        <div class="flex items-center gap-2 lg:hidden">
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" aria-label="Logout" title="Keluar dari akun admin" class="flex items-center gap-1.5 text-xs font-semibold text-rose-600 hover:bg-rose-50 px-2.5 py-1.5 rounded-lg border border-rose-200/70 transition">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
</header>
<nav class="flex gap-1 overflow-x-auto border-b border-slate-200 bg-white px-4 py-2 lg:hidden">
    <a href="{{ route('admin.home') }}" class="whitespace-nowrap rounded-lg px-3 py-2 text-xs font-semibold {{ request()->routeIs('admin.home') ? 'bg-brand-blue text-white' : 'text-slate-600 hover:bg-brand-blue-50 hover:text-brand-blue' }}">Overview</a>
    <a href="{{ route('admin.peserta') }}" class="whitespace-nowrap rounded-lg px-3 py-2 text-xs font-semibold {{ request()->routeIs('admin.peserta') ? 'bg-brand-blue text-white' : 'text-slate-600 hover:bg-brand-blue-50 hover:text-brand-blue' }}">Kelola Peserta</a>
    <a href="{{ route('admin.jadwal') }}"class="whitespace-nowrap rounded-lg px-3 py-2 text-xs font-medium text-slate-600 hover:bg-brand-blue-50 hover:text-brand-blue">Pendaftaran</a>
    <a href="{{ route('admin.home') }}#pipeline" class="whitespace-nowrap rounded-lg px-3 py-2 text-xs font-medium text-slate-600 hover:bg-brand-blue-50 hover:text-brand-blue">Seleksi kandidat</a>
    <a href="{{ route('admin.home') }}#schedule" class="whitespace-nowrap rounded-lg px-3 py-2 text-xs font-medium text-slate-600 hover:bg-brand-blue-50 hover:text-brand-blue">Jadwal sesi</a>
</nav>
