<!-- Footer Section -->
<footer class="bg-brand-navy text-slate-300 pt-16 pb-12 border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-slate-800">
            
            <!-- Col 1: Brand & Logo -->
            <div class="lg:col-span-2 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-white p-1 flex items-center justify-center">
                        <img src="{{ asset('images/logo.png') }}" alt="ILBBEC Logo" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <span class="text-xl font-extrabold text-white tracking-tight">ILBBEC</span>
                        <span class="text-xs text-brand-orange block font-semibold">Universitas Logistik & Bisnis Internasional</span>
                    </div>
                </div>
                <p class="text-xs text-slate-400 leading-relaxed max-w-sm">
                    International Logistics & Business Baccalaureate English Center — empowering the next generation of global logistics executives, international trade diplomats, and fluent English communicators at ULBI.
                </p>
                <div class="flex items-center space-x-3 pt-2">
                    <!-- Instagram -->
                    <a href="https://instagram.com" target="_blank" rel="noopener" class="w-9 h-9 rounded-xl bg-slate-800 hover:bg-brand-blue flex items-center justify-center text-white transition-colors" aria-label="Instagram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <!-- LinkedIn -->
                    <a href="https://linkedin.com" target="_blank" rel="noopener" class="w-9 h-9 rounded-xl bg-slate-800 hover:bg-brand-blue flex items-center justify-center text-white transition-colors" aria-label="LinkedIn">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                    </a>
                    <!-- YouTube -->
                    <a href="https://youtube.com" target="_blank" rel="noopener" class="w-9 h-9 rounded-xl bg-slate-800 hover:bg-brand-blue flex items-center justify-center text-white transition-colors" aria-label="YouTube">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Col 2: Quick Links -->
            <div>
                <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Navigation</h4>
                <ul class="space-y-2 text-xs">
                    <li><a href="{{ request()->is('/') ? '#home' : route('home') . '#home' }}" class="hover:text-white transition-colors">Home</a></li>
                    <li><a href="{{ request()->is('/') ? '#about' : route('home') . '#about' }}" class="hover:text-white transition-colors">About ILBBEC</a></li>
                    <li><a href="{{ request()->is('/') ? '#activities' : route('home') . '#activities' }}" class="hover:text-white transition-colors">Flagship Activities</a></li>
                    <li><a href="{{ request()->is('/') ? '#events' : route('home') . '#events' }}" class="hover:text-white transition-colors">Upcoming Events</a></li>
                    <li><a href="{{ request()->is('/') ? '#gallery' : route('home') . '#gallery' }}" class="hover:text-white transition-colors">Photo Gallery</a></li>
                    <li><a href="{{ request()->is('/') ? '#faq' : route('home') . '#faq' }}" class="hover:text-white transition-colors">Membership FAQ</a></li>
                </ul>
            </div>

            <!-- Col 3: Programs -->
            <div>
                <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Focus Programs</h4>
                <ul class="space-y-2 text-xs">
                    <li><a href="{{ request()->is('/') ? '#activities' : route('home') . '#activities' }}" class="hover:text-white transition-colors">English Speaking Society</a></li>
                    <li><a href="{{ request()->is('/') ? '#activities' : route('home') . '#activities' }}" class="hover:text-white transition-colors">Logistics Business English</a></li>
                    <li><a href="{{ request()->is('/') ? '#activities' : route('home') . '#activities' }}" class="hover:text-white transition-colors">TOEFL & IELTS Clinic</a></li>
                    <li><a href="{{ request()->is('/') ? '#activities' : route('home') . '#activities' }}" class="hover:text-white transition-colors">Parliamentary Debate</a></li>
                    <li><a href="{{ request()->is('/') ? '#activities' : route('home') . '#activities' }}" class="hover:text-white transition-colors">Global Youth Summit</a></li>
                </ul>
            </div>

            <!-- Col 4: Campus Address -->
            <div>
                <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Secretariat</h4>
                <p class="text-xs text-slate-400 leading-relaxed">
                    <strong>Universitas Logistik & Bisnis Internasional (ULBI)</strong><br>
                    Gedung Student Center Lt. 2<br>
                    Jl. Sari Asih No.54, Sarijadi, Kec. Sukasari, Kota Bandung, Jawa Barat 40151
                </p>
                <p class="text-xs text-slate-400 mt-2">
                    Email: <a href="mailto:ilbbec@ulbi.ac.id" class="text-brand-orange hover:underline">ilbbec@ulbi.ac.id</a>
                </p>
            </div>

        </div>

        <!-- Bottom Copyright & Credit -->
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
            <p>© 2026 ILBBEC ULBI. All rights reserved.</p>
            <div class="flex items-center space-x-4">
                <span>Designed for ULBI International Community</span>
                <a href="#home" class="text-brand-blue-light hover:text-white">Back to top ↑</a>
            </div>
        </div>
    </div>
</footer>
