<!-- Hero Section -->
<section id="home" class="relative hero-mesh pt-4 pb-16 md:pt-8 md:pb-12 lg:pt-12 lg:pb-18 overflow-hidden">
    
    <!-- Background Ambient Accents -->
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-brand-blue-100/40 rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div class="absolute top-1/3 right-5 w-72 h-72 bg-brand-orange-100/50 rounded-full blur-3xl pointer-events-none -z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
            
            <!-- Left Column: Hero Content -->
            <div class="lg:col-span-7 flex flex-col items-start text-left space-y-6">

                <!-- Main Headline -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-brand-navy leading-[1.15]">
                    Learn. Connect. <br class="hidden sm:inline">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-blue via-blue-600 to-brand-orange">
                        Grow Globally.
                    </span>
                </h1>

                <!-- Short Description -->
                <p class="text-base sm:text-lg text-slate-600 font-normal leading-relaxed max-w-2xl">
                    Empowering students of <span class="font-semibold text-brand-navy">Universitas Logistik & Bisnis Internasional</span> with fluent English communication, global logistics and business acumen, international debate leadership, and a world-class professional network.
                </p>

                <!-- CTAs -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3.5 w-full sm:w-auto pt-2">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-7 py-4 rounded-xl text-base font-semibold text-white bg-brand-blue hover:bg-brand-blue-dark shadow-lg shadow-brand-blue/20 hover:shadow-glow transition-all duration-300 group">
                        <span>Join ILBBEC 2026</span>
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                    <a href="{{ request()->is('/') ? '#activities' : route('home') . '#activities' }}" class="inline-flex items-center justify-center px-6 py-4 rounded-xl text-base font-semibold text-slate-700 bg-white hover:bg-slate-50 border border-slate-200 shadow-sm hover:border-brand-blue/30 transition-all duration-300">
                        <svg class="w-5 h-5 mr-2 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Explore Activities</span>
                    </a>
                </div> 
            </div>

            <!-- Right Column: Hero Image with Floating Badges -->
            <div class="lg:col-span-5 relative mt-4 lg:mt-0">
                
                <!-- Decorative Glow Ring -->
                <div class="absolute -inset-4 bg-gradient-to-tr from-brand-blue/15 via-transparent to-brand-orange/15 rounded-3xl blur-xl -z-10"></div>
                
                <!-- Main Collaborating Photo -->
                <div class="relative rounded-2xl sm:rounded-3xl overflow-hidden shadow-2xl border-4 border-white bg-slate-100 aspect-[4/3] sm:aspect-[16/11]">
                   <img 
                            src="./images/sertijab.jpeg" 
                            alt="ULBI Students Collaborating at ILBBEC" 
                            class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700"
                            loading="eager"
                        >
                    <div class="absolute inset-0 bg-gradient-to-t from-brand-navy/60 via-transparent to-transparent"></div>
                    
                    <div class="absolute bottom-10 left-4 right-4 text-white">
                        <p class="text-xs font-semibold tracking-wide uppercase text-brand-orange-light">ULBI International Community</p>
                        <p class="text-sm font-bold truncate">Cross-Disciplinary English & Logistics Collaboration</p>
                    </div>
                </div>

                <!-- Floating Glass Badge 1: Logistics -->
                <div class="absolute -top-4 -right-2 sm:-right-4 glass-card px-3.5 py-2.5 rounded-2xl shadow-lg flex items-center gap-2.5 animate-bounce" style="animation-duration: 4s;">
                    <div class="w-9 h-9 rounded-xl bg-brand-orange-50 text-brand-orange flex items-center justify-center flex-shrink-0 font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-brand-navy">Global Logistics</div>
                        <div class="text-[10px] text-slate-500 font-medium">Business English</div>
                    </div>
                </div>

                <!-- Floating Glass Badge 2: Debate -->
                <div class="absolute -bottom-6 -left-2 sm:-left-4 glass-card px-3.5 py-2.5 rounded-2xl shadow-lg flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-brand-blue-50 text-brand-blue flex items-center justify-center flex-shrink-0 font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 100-6 3 3 0 000 6z"></path></svg>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-brand-navy">Public Speaking</div>
                        <div class="text-[10px] text-slate-500 font-medium">Debate & Leadership</div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
