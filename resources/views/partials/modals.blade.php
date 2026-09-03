<!-- Success Toast Modal -->
<div id="success-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl p-8 max-w-md w-full text-center shadow-2xl space-y-4">
        <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto text-2xl font-bold">
            ✓
        </div>
        <h3 class="text-2xl font-extrabold text-brand-navy">Registration Received!</h3>
        <p class="text-sm text-slate-600 leading-relaxed" id="success-modal-msg">
            Thank you for applying to ILBBEC ULBI. Our recruitment coordinator will reach out to your WhatsApp shortly with orientation details!
        </p>
        <button onclick="closeSuccessModal()" class="w-full py-3 bg-brand-blue hover:bg-brand-blue-dark text-white font-semibold rounded-xl text-sm transition-colors shadow">
            Awesome, Got it!
        </button>
    </div>
</div>

<!-- Event Registration Modal -->
<div id="event-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl p-7 max-w-md w-full shadow-2xl space-y-4" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <h3 class="text-lg font-bold text-brand-navy">Event Registration</h3>
            <button onclick="closeEventModal()" class="text-slate-400 hover:text-slate-600">✕</button>
        </div>
        <p class="text-xs text-brand-blue font-semibold" id="event-modal-title"></p>
        <form onsubmit="handleEventSubmit(event)" class="space-y-3 text-xs">
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Full Name</label>
                <input type="text" required class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-brand-blue/30 focus:border-brand-blue">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">NIM / University</label>
                <input type="text" required placeholder="ULBI or other university" class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-brand-blue/30 focus:border-brand-blue">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">WhatsApp Number</label>
                <input type="tel" required class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs focus:ring-2 focus:ring-brand-blue/30 focus:border-brand-blue">
            </div>
            <button type="submit" class="w-full py-2.5 bg-brand-blue text-white font-semibold rounded-xl text-xs hover:bg-brand-blue-dark transition-colors mt-2">
                Confirm RSVP
            </button>
        </form>
    </div>
</div>

<!-- Activity Detail Modal -->
<div id="activity-detail-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl p-7 max-w-lg w-full shadow-2xl space-y-4" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <h3 class="text-lg font-bold text-brand-navy" id="activity-detail-title">Program Details</h3>
            <button onclick="closeActivityModal()" class="text-slate-400 hover:text-slate-600">✕</button>
        </div>
        <div class="text-xs text-slate-600 leading-relaxed space-y-3" id="activity-detail-body">
            <!-- Content injected via JS -->
        </div>
        <div class="pt-3 border-t border-slate-100 flex justify-end gap-2">
            <button onclick="closeActivityModal()" class="px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 rounded-lg">Close</button>
            <a href="{{ request()->is('/') ? '#join' : route('home') . '#join' }}" onclick="closeActivityModal()" class="px-4 py-2 text-xs font-semibold bg-brand-blue text-white rounded-lg hover:bg-brand-blue-dark">Join This Track</a>
        </div>
    </div>
</div>

<!-- Lightbox Modal for Photo Gallery -->
<div id="lightbox-modal" class="fixed inset-0 z-50 bg-black/90 backdrop-blur-md hidden flex items-center justify-center p-4 transition-all duration-300" onclick="closeLightbox(event)">
    <div class="relative max-w-4xl w-full bg-transparent rounded-2xl overflow-hidden" onclick="event.stopPropagation()">
        <button onclick="closeLightboxDirect()" class="absolute top-3 right-3 text-white bg-black/60 hover:bg-black p-2 rounded-full z-10 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <img id="lightbox-img" src="" alt="Full view" class="w-full max-h-[80vh] object-contain rounded-xl">
        <p id="lightbox-caption" class="text-center text-white text-sm font-medium mt-3 px-4"></p>
    </div>
</div>

<script>
    const activityDetailsData = {
        debate: {
            title: 'English Debate & Speech Society',
            content: `
                <p><strong>Schedule:</strong> Every Wednesday at 16:00 - 18:00 WIB</p>
                <p><strong>Venue:</strong> ULBI Campus Amphitheater & Hybrid Online</p>
                <p><strong>Format:</strong> British Parliamentary (BP), Asian Parliamentary (AP), and 3-Minute Impromptu Pitch.</p>
                <p><strong>Curriculum:</strong> Motion analysis, rebuttal logic, rhetorical delivery, argumentation frameworks on international trade and current affairs.</p>
                <p><strong>Prerequisites:</strong> None! All English levels are coached by senior champions.</p>
            `
        },
        business: {
            title: 'Global Logistics Case & Pitching Masterclass',
            content: `
                <p><strong>Schedule:</strong> Bi-Weekly on Fridays at 14:00 - 16:30 WIB</p>
                <p><strong>Venue:</strong> Smart Classroom 302</p>
                <p><strong>Format:</strong> International business case analysis, supply chain simulation, slide design & executive pitch.</p>
                <p><strong>Topics:</strong> Multimodal transport agreements, port congestion strategies, green supply chains, and Incoterms in English.</p>
            `
        },
        toefl: {
            title: 'TOEFL & IELTS Intensive Score Booster',
            content: `
                <p><strong>Schedule:</strong> Every Saturday at 09:30 - 12:00 WIB</p>
                <p><strong>Venue:</strong> Language Center Computer Lab</p>
                <p><strong>Format:</strong> Diagnostic practice tests, listening tricks, reading speed strategies, and 1-on-1 IELTS speaking assessment.</p>
                <p><strong>Target:</strong> TOEFL ITP 550+ / IELTS Band 7.0+ for graduate studies and international career recruitment.</p>
            `
        }
    };

    function openActivityModal(key) {
        const data = activityDetailsData[key];
        if (data) {
            document.getElementById('activity-detail-title').innerText = data.title;
            document.getElementById('activity-detail-body').innerHTML = data.content;
            document.getElementById('activity-detail-modal').classList.remove('hidden');
            document.getElementById('activity-detail-modal').classList.add('flex');
        }
    }

    function closeActivityModal() {
        document.getElementById('activity-detail-modal').classList.add('hidden');
        document.getElementById('activity-detail-modal').classList.remove('flex');
    }
</script>
