<!-- Events & Conferences Section -->
<section id="events" class="py-20 bg-slate-50/80 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-wider text-brand-orange bg-brand-orange-50 px-3 py-1 rounded-full border border-brand-orange/20">
                Upcoming Events
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-navy mt-4 tracking-tight">
                Join Our Conferences & Competitions
            </h2>
            <div class="w-16 h-1 bg-brand-orange mx-auto mt-4 rounded-full"></div>
            <p class="text-slate-600 text-base mt-4">
                Participate in national speech competitions, global trade seminars, and network with international guest lecturers and industry leaders.
            </p>
        </div>

        <!-- Featured Large Event Card -->
        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-lg overflow-hidden grid grid-cols-1 lg:grid-cols-12 mb-10">
            <div class="lg:col-span-6 relative h-64 lg:h-auto min-h-[300px]">
                <img src="{{ asset('images/event-summit.jpg') }}" alt="ILBBEC International Summit" class="w-full h-full object-cover">
                <div class="absolute top-4 left-4 bg-brand-blue text-white text-xs font-bold px-3 py-1.5 rounded-xl shadow-md">
                    Flagship Annual Event
                </div>
            </div>
            <div class="lg:col-span-6 p-8 sm:p-10 flex flex-col justify-between space-y-6">
                <div>
                    <div class="flex items-center gap-3 text-xs font-semibold text-brand-orange">
                        <span class="bg-brand-orange-50 px-2.5 py-1 rounded-md border border-brand-orange/20">October 15-16, 2026</span>
                        <span>ULBI Grand Auditorium & Live Streaming</span>
                    </div>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-brand-navy mt-3 tracking-tight">
                        ILBBEC National English & Logistics Pitch Cup 2026
                    </h3>
                    <p class="text-slate-600 text-sm mt-3 leading-relaxed">
                        A nationwide university competition bringing together students from across Indonesia to present innovative solutions for green supply chains and sustainable international trade in English.
                    </p>
                    
                    <!-- Event Highlights -->
                    <div class="grid grid-cols-2 gap-3 mt-5 text-xs text-slate-700">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-brand-blue flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Total Prize IDR 25,000,000</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-brand-blue flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>International Jury Panel</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-brand-blue flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>National Certificate</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-brand-blue flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Logistics Industry Networking</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-4 border-t border-slate-100">
                    <button onclick="openRegisterEventModal('ILBBEC National English & Logistics Pitch Cup 2026')" class="px-6 py-3 rounded-xl bg-brand-blue hover:bg-brand-blue-dark text-white font-semibold text-sm shadow-md transition-all">
                        Register Delegate
                    </button>
                    <a href="{{ request()->is('/') ? '#join' : route('home') . '#join' }}" class="text-xs font-semibold text-slate-600 hover:text-brand-blue">
                        Volunteer as Committee →
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
