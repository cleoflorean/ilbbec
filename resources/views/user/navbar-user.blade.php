<!-- Main Navigation Bar -->
<header class="sticky top-0 z-40 w-full glass-nav border-b border-slate-100/80 transition-all duration-300" id="navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            
            <!-- Logo & Brand Name -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="relative w-12 h-12 flex-shrink-0 flex items-center justify-center p-0.5 bg-white rounded-xl shadow-sm border border-slate-100 group-hover:shadow-md transition-shadow">
                    <img src="{{ asset('images/logo.png') }}" alt="ILBBEC Logo" class="w-full h-full object-contain">
                </div>
                <div class="flex flex-col">
                    <div class="flex items-center gap-1.5">
                        <span class="font-extrabold text-xl tracking-tight text-brand-navy group-hover:text-brand-blue transition-colors">ILBBEC</span>
                    </div>
                    <span class="text-[10px] text-slate-500 font-medium tracking-normal hidden sm:inline-block leading-tight">
                        International Logistics & Business Baccalaureate English Center
                    </span>
                </div>
            </a>

            <!-- Desktop Navigation Menu -->
            <nav class="hidden md:flex items-center space-x-1 lg:space-x-2">
                <a href="{{ route('user.home') }}" class="nav-link px-3 py-2 text-sm font-medium {{ request()->routeIs('user.home') ? 'text-brand-blue font-semibold active' : 'text-slate-700 hover:text-brand-blue' }} rounded-lg transition-colors">Home</a>
                <a href="{{ route('user.profile') }}" class="nav-link px-3 py-2 text-sm font-medium {{ request()->routeIs('user.profile') ? 'text-brand-blue font-semibold active' : 'text-slate-700 hover:text-brand-blue' }} rounded-lg transition-colors">Profile</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="nav-link px-3 py-2 text-sm font-medium text-slate-700 hover:text-rose-600 rounded-lg transition-colors">Logout</button>
                </form>
            </nav>

            <!-- Mobile Hamburger Button -->
            <div class="flex items-center md:hidden gap-2">
                @auth
                    <span class="text-xs font-semibold px-2.5 py-1 bg-blue-50 text-brand-blue rounded-lg border border-blue-100">
                        {{ auth()->user()->Nama ?? 'User' }}
                    </span>
                @else
                    <a href="{{ route('login') }}" class="text-xs font-semibold px-3 py-1.5 bg-brand-blue text-white rounded-lg">Masuk</a>
                @endauth
                <button id="mobile-menu-btn" type="button" aria-label="Toggle navigation menu" class="p-2 rounded-xl text-slate-700 hover:text-brand-blue hover:bg-slate-100 focus:outline-none transition-colors">
                    <svg id="hamburger-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Drawer Navigation (390×844 Optimized) -->
    <div id="mobile-menu" class="hidden md:hidden border-b border-slate-200 bg-white/95 backdrop-blur-xl px-4 pt-2 pb-5 space-y-2 shadow-xl">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="ILBBEC Logo" class="w-7 h-7 object-contain">
                <span class="text-xs font-bold text-brand-navy">ILBBEC • ULBI</span>
            </div>
            @auth
                <span class="text-[10px] text-brand-blue font-semibold bg-blue-50 px-2 py-0.5 rounded-full border border-blue-100">Calon Anggota</span>
            @else
                <span class="text-[10px] text-brand-orange font-semibold bg-brand-orange-50 px-2 py-0.5 rounded-full">Recruitment Open</span>
            @endauth
        </div>

        @auth
            <div class="grid grid-cols-2 gap-2 pt-2">
                <a href="{{ route('user.home') }}" class="mobile-nav-link flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('user.home') ? 'bg-brand-blue text-white shadow-sm' : 'text-slate-700 hover:bg-blue-50 hover:text-brand-blue' }} transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Home
                </a>
                <a href="{{ route('user.profile') }}" class="mobile-nav-link flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('user.profile') ? 'bg-brand-blue text-white shadow-sm' : 'text-slate-700 hover:bg-blue-50 hover:text-brand-blue' }} transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Profile
                </a>
            </div>
            <div class="pt-2">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 py-2 px-4 rounded-xl text-xs font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </form>
            </div>
        @else
            <div class="grid grid-cols-2 gap-2 pt-2">
                <a href="{{ request()->is('/') ? '#home' : route('home') . '#home' }}" class="mobile-nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:bg-brand-blue-50 hover:text-brand-blue transition-colors">
                    Home
                </a>
                <a href="{{ request()->is('/') ? '#about' : route('home') . '#about' }}" class="mobile-nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:bg-brand-blue-50 hover:text-brand-blue transition-colors">
                    About
                </a>
            </div>
            <div class="pt-3">
                <a href="{{ route('login') }}" class="mobile-nav-link flex items-center justify-center w-full py-2.5 px-4 rounded-xl text-sm font-semibold text-white bg-brand-blue hover:bg-brand-blue-dark shadow-md">
                    Masuk Akun
                </a>
            </div>
        @endauth
    </div>
</header>
