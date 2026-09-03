<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ILBBEC') — ULBI</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                    colors: {
                        brand: {
                            blue:        '#1E40AF',
                            'blue-dark': '#1E3A8A',
                            'blue-50':   '#EFF6FF',
                            'blue-100':  '#DBEAFE',
                            navy:        '#0F172A',
                            orange:      '#F97316',
                            'orange-50': '#FFF7ED',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Poppins', sans-serif; }
        .input-field {
            @apply w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm
                   focus:outline-none focus:ring-2 focus:ring-brand-blue/30 focus:border-brand-blue
                   transition-all duration-200 bg-white;
        }
        .input-field::placeholder { color: #94A3B8; }
        .btn-primary {
            @apply w-full py-3 rounded-xl bg-brand-blue hover:bg-brand-blue-dark text-white font-semibold
                   text-sm shadow-md hover:shadow-lg transition-all duration-200;
        }
    </style>
</head>
<body class="min-h-screen bg-slate-50 flex flex-col">

    {{-- Minimal top bar --}}
    <div class="max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <div class="flex items-center gap-3 group">
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
                <a href="{{ route('home') }}" class="text-xs text-slate-500 hover:text-brand-blue transition-colors inline-flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>



    <!-- <div class="w-full bg-white border-b border-slate-100 px-6 py-3 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
            <img src="{{ asset('images/logo.png') }}" alt="ILBBEC" class="w-8 h-8 object-contain">
            <div>
                <span class="font-extrabold text-brand-navy text-base leading-none">ILBBEC</span>
                <span class="text-[10px] text-slate-400 block leading-none">ULBI Bandung</span>
            </div>
        </a>
        
    </div> -->

    {{-- Main Content --}}
    <main class="flex-grow flex items-center justify-center px-4 py-10">
        @yield('content')
    </main>

    {{-- Footer kecil --}}
    <div class="text-center py-4 text-xs text-slate-400 border-t border-slate-100 bg-white">
        © {{ date('Y') }} ILBBEC — Universitas Logistik & Bisnis Internasional
    </div>

</body>
</html>
