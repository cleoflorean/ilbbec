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
                <a href="{{ request()->is('/') ? '#home' : route('home') . '#home' }}" class="nav-link px-3 py-2 text-sm font-medium text-slate-700 hover:text-brand-blue rounded-lg transition-colors">Home</a>
                <a href="{{ request()->is('/') ? '#about' : route('home') . '#about' }}" class="nav-link px-3 py-2 text-sm font-medium text-slate-700 hover:text-brand-blue rounded-lg transition-colors">About</a>
                <a href="{{ request()->is('/') ? '#activities' : route('home') . '#activities' }}" class="nav-link px-3 py-2 text-sm font-medium text-slate-700 hover:text-brand-blue rounded-lg transition-colors">Activities</a>
                <a href="{{ request()->is('/') ? '#events' : route('home') . '#events' }}" class="nav-link px-3 py-2 text-sm font-medium text-slate-700 hover:text-brand-blue rounded-lg transition-colors">Events</a>
                <a href="{{ request()->is('/') ? '#gallery' : route('home') . '#gallery' }}" class="nav-link px-3 py-2 text-sm font-medium text-slate-700 hover:text-brand-blue rounded-lg transition-colors">Gallery</a>
                <a href="{{ request()->is('/') ? '#testimonials' : route('home') . '#testimonials' }}" class="nav-link px-3 py-2 text-sm font-medium text-slate-700 hover:text-brand-blue rounded-lg transition-colors">Voices</a>
                <a href="{{ request()->is('/') ? '#faq' : route('home') . '#faq' }}" class="nav-link px-3 py-2 text-sm font-medium text-slate-700 hover:text-brand-blue rounded-lg transition-colors">FAQ</a>
            </nav>

            <!-- Desktop CTA -->
            <div class="hidden md:flex items-center gap-3">
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-brand-blue hover:bg-brand-blue-dark shadow-md hover:shadow-glow transition-all duration-300 group">
                    <span>Login</span>
                    <svg class="w-4 h-4 ml-1.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="flex items-center md:hidden gap-2">
                <a href="{{ request()->is('/') ? '#join' : route('home') . '#join' }}" class="text-xs font-semibold px-3 py-1.5 bg-brand-blue text-white rounded-lg">Join</a>
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
    <div id="mobile-menu" class="hidden md:hidden border-b border-slate-200 bg-white/95 backdrop-blur-xl px-4 pt-2 pb-6 space-y-2 shadow-xl">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="ILBBEC Logo" class="w-7 h-7 object-contain">
                <span class="text-xs font-bold text-brand-navy">ILBBEC • ULBI</span>
            </div>
            <span class="text-[10px] text-brand-orange font-semibold bg-brand-orange-50 px-2 py-0.5 rounded-full">Recruitment Open</span>
        </div>
        <div class="grid grid-cols-2 gap-2 pt-2">
            <a href="{{ request()->is('/') ? '#home' : route('home') . '#home' }}" class="mobile-nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:bg-brand-blue-50 hover:text-brand-blue transition-colors">
                <svg class="w-4 h-4 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Home
            </a>
            <a href="{{ request()->is('/') ? '#about' : route('home') . '#about' }}" class="mobile-nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:bg-brand-blue-50 hover:text-brand-blue transition-colors">
                <svg class="w-4 h-4 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                About
            </a>
            <a href="{{ request()->is('/') ? '#activities' : route('home') . '#activities' }}" class="mobile-nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:bg-brand-blue-50 hover:text-brand-blue transition-colors">
                <svg class="w-4 h-4 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Activities
            </a>
            <a href="{{ request()->is('/') ? '#events' : route('home') . '#events' }}" class="mobile-nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:bg-brand-blue-50 hover:text-brand-blue transition-colors">
                <svg class="w-4 h-4 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Events
            </a>
            <a href="{{ request()->is('/') ? '#gallery' : route('home') . '#gallery' }}" class="mobile-nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:bg-brand-blue-50 hover:text-brand-blue transition-colors">
                <svg class="w-4 h-4 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Gallery
            </a>
            <a href="{{ request()->is('/') ? '#faq' : route('home') . '#faq' }}" class="mobile-nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:bg-brand-blue-50 hover:text-brand-blue transition-colors">
                <svg class="w-4 h-4 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                FAQ
            </a>
        </div>
        <div class="pt-3">
            <a href="{{ request()->is('/') ? '#join' : route('home') . '#join' }}" class="mobile-nav-link flex items-center justify-center w-full py-3 px-4 rounded-xl text-sm font-semibold text-white bg-brand-blue hover:bg-brand-blue-dark shadow-md">
                Apply for Membership 2026
            </a>
        </div>
    </div>
</header>
