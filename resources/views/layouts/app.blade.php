<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>@yield('title', 'ILBBEC - International Logistics & Business Baccalaureate English Center | ULBI')</title>
    
    <meta name="description" content="@yield('meta_description', 'ILBBEC is the premier Student Activity Unit at Universitas Logistik & Bisnis Internasional (ULBI) dedicated to English proficiency, global logistics & business acumen, debate leadership, and international networking.')">
    <meta name="keywords" content="ILBBEC, ULBI, English Center, International Logistics, Business English, English Debate, Student Activity Unit, Universitas Logistik dan Bisnis Internasional Bandung">
    <meta name="author" content="ILBBEC ULBI">
    
    <!-- Open Graph / Social Meta -->
    <meta property="og:title" content="@yield('title', 'ILBBEC - Learn. Connect. Grow Globally.')">
    <meta property="og:description" content="Empowering ULBI students with English proficiency, international logistics & business knowledge, and global leadership skills.">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Google Fonts: Poppins & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> //alpaine js

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'Plus Jakarta Sans', 'system-ui', 'sans-serif'],
                        heading: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            blue: '#1E40AF',       // Dominant Royal Blue
                            'blue-dark': '#1E3A8A',
                            'blue-light': '#3B82F6',
                            'blue-50': '#EFF6FF',
                            'blue-100': '#DBEAFE',
                            navy: '#0F172A',       // Dark Navy for text & headers
                            'navy-light': '#1E293B',
                            orange: '#F97316',     // Accent Orange from logo shield
                            'orange-dark': '#EA580C',
                            'orange-light': '#FB923C',
                            'orange-50': '#FFF7ED',
                            'orange-100': '#FFEDD5',
                            slate: '#64748B',
                        }
                    },
                    boxShadow: {
                        'premium': '0 20px 40px -15px rgba(30, 64, 175, 0.08)',
                        'glow': '0 0 25px rgba(37, 99, 235, 0.25)',
                        'card-hover': '0 22px 35px -10px rgba(15, 23, 42, 0.08)',
                    }
                }
            }
        }
    </script>

    <style>
        :root {
            --royal-blue: #1E40AF;
            --accent-orange: #F97316;
            --dark-navy: #0F172A;
            --bg-light: #FFFFFF;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: #1E293B;
            background-color: #FFFFFF;
            overflow-x: hidden;
        }

        /* Custom Modern Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #F1F5F9;
        }
        ::-webkit-scrollbar-thumb {
            background: #94A3B8;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #1E40AF;
        }

        /* Glassmorphism Classes */
        .glass-nav {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        /* Subtle animated gradient background */
        .hero-mesh {
            background-color: #ffffff;
            background-image: 
                radial-gradient(at 0% 0%, rgba(30, 64, 175, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(249, 115, 22, 0.06) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(59, 130, 246, 0.04) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(249, 115, 22, 0.03) 0px, transparent 50%);
        }

        /* Pulse subtle */
        @keyframes subtle-pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.85; }
        }
        .pulse-subtle {
            animation: subtle-pulse 3s infinite ease-in-out;
        }

        /* FAQ Accordion */
        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease;
            opacity: 0;
        }
        .faq-answer.open {
            max-height: 400px;
            opacity: 1;
        }

        /* Active Nav link */
        .nav-link.active {
            color: #1E40AF;
            font-weight: 600;
        }
        .nav-link.active::after {
            content: '';
            display: block;
            width: 100%;
            height: 2px;
            background: #1E40AF;
            border-radius: 2px;
            margin-top: 2px;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-white text-slate-800 antialiased selection:bg-brand-blue selection:text-white flex flex-col min-h-screen">

    <!-- Top Announcement Bar -->
    @include('partials.topbar')

    <!-- Main Navigation Bar -->
    @include('partials.navbar')

    <!-- Page Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Global Modals (Lightbox, RSVP, Registration Success) -->
    @include('partials.modals')

    <!-- Global Scripts -->
    <script>
        // 1. Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');

        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                const isHidden = mobileMenu.classList.toggle('hidden');
                if (!isHidden) {
                    hamburgerIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                } else {
                    hamburgerIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                }
            });

            document.querySelectorAll('.mobile-nav-link').forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                    hamburgerIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                });
            });
        }

        // 2. FAQ Accordion Toggle
        function toggleFaq(button) {
            const answer = button.nextElementSibling;
            const icon = button.querySelector('.faq-icon');
            const isOpen = answer.classList.contains('open');

            document.querySelectorAll('.faq-answer').forEach(el => el.classList.remove('open'));
            document.querySelectorAll('.faq-icon').forEach(el => el.classList.remove('rotate-180'));

            if (!isOpen) {
                answer.classList.add('open');
                icon.classList.add('rotate-180');
            }
        }

        // 3. Lightbox for Photo Gallery
        function openLightbox(src, caption) {
            const modal = document.getElementById('lightbox-modal');
            const img = document.getElementById('lightbox-img');
            const cap = document.getElementById('lightbox-caption');
            if (modal && img && cap) {
                img.src = src;
                cap.innerText = caption;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeLightbox(event) {
            const modal = document.getElementById('lightbox-modal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = 'auto';
            }
        }

        function closeLightboxDirect() {
            closeLightbox();
        }

        // 4. Registration Form Submission
        function handleRegistration(e) {
            e.preventDefault();
            const form = e.target;
            const fullname = form.fullname ? form.fullname.value : 'Student';
            const modalMsg = document.getElementById('success-modal-msg');
            if (modalMsg) {
                modalMsg.innerText = `Welcome, ${fullname}! Your ILBBEC membership application has been received. Our recruitment team will contact your WhatsApp soon with orientation details.`;
            }
            const modal = document.getElementById('success-modal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
            form.reset();
        }

        function closeSuccessModal() {
            const modal = document.getElementById('success-modal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        // 5. Event RSVP Modal
        function openRegisterEventModal(title) {
            const titleEl = document.getElementById('event-modal-title');
            if (titleEl) titleEl.innerText = title;
            const modal = document.getElementById('event-modal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function closeEventModal() {
            const modal = document.getElementById('event-modal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        function handleEventSubmit(e) {
            e.preventDefault();
            closeEventModal();
            const modalMsg = document.getElementById('success-modal-msg');
            if (modalMsg) {
                modalMsg.innerText = `You have successfully RSVP'd for the event! The access link and pass have been emailed to you.`;
            }
            const modal = document.getElementById('success-modal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        // 6. Navbar Scroll Active State
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (nav) {
                if (window.scrollY > 30) {
                    nav.classList.add('shadow-sm', 'bg-white/95');
                } else {
                    nav.classList.remove('shadow-sm');
                }
            }

            const sections = document.querySelectorAll('section[id]');
            const scrollPos = window.scrollY + 120;

            sections.forEach(sec => {
                const top = sec.offsetTop;
                const height = sec.offsetHeight;
                const id = sec.getAttribute('id');
                const link = document.querySelector(`.nav-link[href$="#${id}"]`);

                if (scrollPos >= top && scrollPos < top + height) {
                    document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                    if (link) link.classList.add('active');
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
