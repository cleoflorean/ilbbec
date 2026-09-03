<!-- Photo Gallery Section -->
<section id="gallery" class="py-20 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="text-xs font-bold uppercase tracking-wider text-brand-blue bg-brand-blue-50 px-3 py-1 rounded-full border border-brand-blue/20">
                Moments & Memories
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-navy mt-4 tracking-tight">
                ILBBEC Campus Life in Pictures
            </h2>
            <div class="w-16 h-1 bg-brand-blue mx-auto mt-4 rounded-full"></div>
            <p class="text-slate-600 text-base mt-4">
                Capturing student achievements, vibrant debate sessions, international conferences, and lifelong friendships.
            </p>
        </div>

        <!-- Gallery Grid: 2-column on mobile (390px), 3/4-column on desktop -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6">
            
            <!-- Gallery Item 1 -->
            <div class="group relative rounded-xl sm:rounded-2xl overflow-hidden bg-slate-100 shadow-sm cursor-pointer aspect-square" onclick="openLightbox('{{ asset('images/hero-students.jpg') }}', 'Interactive Group Collaboration in University Lounge')">
                <img src="{{ asset('images/hero-students.jpg') }}" alt="Student Collaboration" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-brand-navy/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-3 sm:p-4 text-white">
                    <span class="text-[10px] text-brand-orange-light font-bold uppercase">Study Group</span>
                    <p class="text-xs sm:text-sm font-semibold truncate">Collaborative English Learning</p>
                </div>
            </div>

            <!-- Gallery Item 2 -->
            <div class="group relative rounded-xl sm:rounded-2xl overflow-hidden bg-slate-100 shadow-sm cursor-pointer aspect-square" onclick="openLightbox('{{ asset('images/activity-debate.jpg') }}', 'National Speech & Debate Competition')">
                <img src="{{ asset('images/activity-debate.jpg') }}" alt="Debate Speech" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-brand-navy/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-3 sm:p-4 text-white">
                    <span class="text-[10px] text-brand-orange-light font-bold uppercase">Debate</span>
                    <p class="text-xs sm:text-sm font-semibold truncate">Public Speaking Stage</p>
                </div>
            </div>

            <!-- Gallery Item 3 -->
            <div class="group relative rounded-xl sm:rounded-2xl overflow-hidden bg-slate-100 shadow-sm cursor-pointer aspect-square" onclick="openLightbox('{{ asset('images/activity-workshop.jpg') }}', 'Logistics Supply Chain Digital Presentation Workshop')">
                <img src="{{ asset('images/activity-workshop.jpg') }}" alt="Logistics Workshop" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-brand-navy/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-3 sm:p-4 text-white">
                    <span class="text-[10px] text-brand-orange-light font-bold uppercase">Workshop</span>
                    <p class="text-xs sm:text-sm font-semibold truncate">Global Logistics Case Prep</p>
                </div>
            </div>

            <!-- Gallery Item 4 -->
            <div class="group relative rounded-xl sm:rounded-2xl overflow-hidden bg-slate-100 shadow-sm cursor-pointer aspect-square" onclick="openLightbox('{{ asset('images/activity-gathering.jpg') }}', 'Graduation & Award Celebration Ceremony')">
                <img src="{{ asset('images/activity-gathering.jpg') }}" alt="Awards and Community" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-brand-navy/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-3 sm:p-4 text-white">
                    <span class="text-[10px] text-brand-orange-light font-bold uppercase">Achievement</span>
                    <p class="text-xs sm:text-sm font-semibold truncate">English Certificate Awards</p>
                </div>
            </div>

        </div>

    </div>
</section>
