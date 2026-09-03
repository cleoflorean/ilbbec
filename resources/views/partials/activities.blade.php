<!-- Activities & Programs Section -->
<section id="activities" class="py-20 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Title -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-brand-blue bg-brand-blue-50 px-3 py-1 rounded-full border border-brand-blue/20">
                    Our Activities
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-navy mt-3 tracking-tight">
                    Flagship Programs & Weekly Sessions
                </h2>
                <p class="text-slate-600 text-sm sm:text-base mt-2 max-w-2xl">
                    Structured, engaging activities designed to develop speaking agility, critical thinking, business pitching, and exam readiness.
                </p>
            </div>
            
            <!-- Category Filter Buttons -->
            <div class="flex items-center gap-1.5 overflow-x-auto pb-2 md:pb-0 mt-6 md:mt-0 max-w-full">
                <button class="filter-btn active px-4 py-2 text-xs font-semibold rounded-xl bg-brand-blue text-white shadow-sm transition-all" data-category="all">
                    All
                </button>
                <button class="filter-btn px-4 py-2 text-xs font-semibold rounded-xl bg-slate-100 text-slate-700 hover:bg-slate-200 transition-all" data-category="speaking">
                    Speaking & Debate
                </button>
                <button class="filter-btn px-4 py-2 text-xs font-semibold rounded-xl bg-slate-100 text-slate-700 hover:bg-slate-200 transition-all" data-category="business">
                    Logistics & Business
                </button>
                <button class="filter-btn px-4 py-2 text-xs font-semibold rounded-xl bg-slate-100 text-slate-700 hover:bg-slate-200 transition-all" data-category="prep">
                    TOEFL/IELTS Prep
                </button>
            </div>
        </div>

        <!-- Activities Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="activities-grid">
            
            <!-- Program 1: English Debate & Speech Club -->
            <div class="activity-card bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm hover:shadow-card-hover transition-all duration-300 flex flex-col" data-category="speaking">
                <div class="relative h-48 overflow-hidden bg-slate-100">
                    <img src="{{ asset('images/activity-debate.jpg') }}" alt="Speech and Debate Session" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-brand-blue text-white text-[11px] font-bold px-2.5 py-1 rounded-full shadow">
                        Weekly Session
                    </div>
                    <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-slate-800 text-[11px] font-semibold px-2.5 py-1 rounded-full">
                        Wednesdays • 16:00
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                    <div>
                        <div class="flex items-center gap-2 text-xs text-brand-orange font-semibold mb-1">
                            <span>Public Speaking</span> • <span>British Parliamentary</span>
                        </div>
                        <h3 class="text-lg font-bold text-brand-navy hover:text-brand-blue transition-colors">
                            English & Speech Society
                        </h3>
                        <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                            Practice impromptu speeches, structured debate motions on global economy, and constructive rebuttals with supportive senior mentors.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-slate-500">📍 ULBI Amphitheater / Zoom</span>
                        <button onclick="openActivityModal('debate')" class="font-semibold text-brand-blue hover:text-brand-blue-dark inline-flex items-center gap-1">
                            Details <span>→</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Program 2: Logistics & Business Workshop -->
            <div class="activity-card bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm hover:shadow-card-hover transition-all duration-300 flex flex-col" data-category="business">
                <div class="relative h-48 overflow-hidden bg-slate-100">
                    <img src="{{ asset('images/activity-workshop.jpg') }}" alt="Business Case & Logistics Workshop" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-brand-orange text-white text-[11px] font-bold px-2.5 py-1 rounded-full shadow">
                        Bi-Weekly Masterclass
                    </div>
                    <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-slate-800 text-[11px] font-semibold px-2.5 py-1 rounded-full">
                        Fridays • 14:00
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                    <div>
                        <div class="flex items-center gap-2 text-xs text-brand-blue font-semibold mb-1">
                            <span>Supply Chain</span> • <span>International Business</span>
                        </div>
                        <h3 class="text-lg font-bold text-brand-navy hover:text-brand-blue transition-colors">
                            Global Logistics Case & Pitching
                        </h3>
                        <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                            Analyze real-world international trade cases, port operations, and pitch business strategy presentations entirely in professional English.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-slate-500">📍 Smart Classroom 302</span>
                        <button onclick="openActivityModal('business')" class="font-semibold text-brand-blue hover:text-brand-blue-dark inline-flex items-center gap-1">
                            Details <span>→</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Program 3: TOEFL & IELTS Prep -->
            <div class="activity-card bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm hover:shadow-card-hover transition-all duration-300 flex flex-col" data-category="prep">
                <div class="relative h-48 overflow-hidden bg-slate-100">
                    <img src="{{ asset('images/activity-gathering.jpg') }}" alt="TOEFL and IELTS Preparation" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-emerald-600 text-white text-[11px] font-bold px-2.5 py-1 rounded-full shadow">
                        Exam Clinic
                    </div>
                    <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-slate-800 text-[11px] font-semibold px-2.5 py-1 rounded-full">
                        Saturdays • 09:30
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                    <div>
                        <div class="flex items-center gap-2 text-xs text-emerald-600 font-semibold mb-1">
                            <span>TOEFL ITP</span> • <span>IELTS Band 7+</span>
                        </div>
                        <h3 class="text-lg font-bold text-brand-navy hover:text-brand-blue transition-colors">
                            TOEFL & IELTS Intensive Booster
                        </h3>
                        <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                            Diagnostic drills for listening comprehension, grammar structure, academic reading, and high-scoring IELTS speaking simulations.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-slate-500">📍 Language Lab & CBT</span>
                        <button onclick="openActivityModal('toefl')" class="font-semibold text-brand-blue hover:text-brand-blue-dark inline-flex items-center gap-1">
                            Details <span>→</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

@push('scripts')
<script>
    // Activity Filtering Tabs
    document.addEventListener('DOMContentLoaded', () => {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const activityCards = document.querySelectorAll('.activity-card');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => {
                    b.classList.remove('active', 'bg-brand-blue', 'text-white');
                    b.classList.add('bg-slate-100', 'text-slate-700');
                });
                btn.classList.add('active', 'bg-brand-blue', 'text-white');
                btn.classList.remove('bg-slate-100', 'text-slate-700');

                const category = btn.getAttribute('data-category');

                activityCards.forEach(card => {
                    if (category === 'all' || card.getAttribute('data-category') === category) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endpush
