@extends('layouts.app-user')

@section('content')

    @php
    // Data Dummy untuk Timeline Seleksi
        $stages = [
            [
                'title' => 'Pendaftaran Berkas',
                'date' => '10 Okt 2026',
                'time' => '23:59 WIB',
                'location' => 'Online (Website)',
                'status' => 'Belum Dimulai',
                'status_color' => 'bg-slate-200 text-slate-600'
            ],
            [
                'title' => 'Study Case',
                'date' => '15 Okt 2026',
                'time' => '09:00 - 11:30 WIB',
                'location' => 'Ruang 402, Gd. Rektorat',
                'status' => 'Belum Dimulai',
                'status_color' => 'bg-slate-200 text-slate-600'
            ],
            [
                'title' => 'Wawancara',
                'date' => '20 Okt 2026',
                'time' => '13:00 - 15:00 WIB',
                'location' => 'Ruang Rapat UKM',
                'status' => 'Belum Dimulai',
                'status_color' => 'bg-slate-200 text-slate-600'
            ],
            [
                'title' => 'Pengumuman',
                'date' => '25 Okt 2026',
                'time' => '12:00 WIB',
                'location' => 'Dashboard ILBBEC',
                'status' => 'Belum Dimulai',
                'status_color' => 'bg-slate-200 text-slate-600'
            ]
        ];
    @endphp

    <!-- KONTEN UTAMA (Dashboard Timeline) -->
    <main class="max-w-5xl mx-auto px-5 sm:px-6 lg:px-8 pt-12 md:pt-16">
        
        <!-- Header / Greeting -->
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold text-ilbbec-navy tracking-tight">
                Halo, Calon Anggota 👋
            </h2>
            <p class="text-slate-500 mt-3 text-base">
                Pantau progres tahapan seleksi ILBBEC kamu di bawah ini.
            </p>
        </div>

        <!-- ========================================== -->
        <!-- TIMELINE DESKTOP (Horizontal)              -->
        <!-- ========================================== -->
        <div class="hidden md:block">
            <!-- Timeline Indicator -->
            <div class="relative flex justify-between mb-12">
                <!-- Garis Penghubung -->
                <div class="absolute top-5 left-0 w-full h-[3px] bg-slate-100 -z-10 rounded-full"></div>
                
                @foreach($stages as $index => $stage)
                <div class="flex flex-col items-center bg-white px-4 relative">
                    <!-- Lingkaran -->
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm shadow-sm transition-all border-4 border-white
                        {{ $stage['status'] == 'Selesai' ? 'bg-ilbbec-navy text-white' : 
                          ($stage['status'] == 'Sedang Berlangsung' ? 'bg-ilbbec-orange text-white ring-4 ring-orange-100' : 'bg-slate-200 text-slate-500') }}">
                        @if($stage['status'] == 'Selesai')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        @else
                            {{ $index + 1 }}
                        @endif
                    </div>
                    <!-- Label Bawah -->
                    <span class="mt-4 text-sm font-semibold {{ $stage['status'] == 'Belum Dimulai' || $stage['status'] == 'Menunggu' ? 'text-slate-400' : 'text-ilbbec-navy' }}">
                        {{ $stage['title'] }}
                    </span>
                </div>
                @endforeach
            </div>

            <!-- Kartu Detail Seleksi -->
            <div class="grid grid-cols-4 gap-6">
                @foreach($stages as $stage)
                <div class="bg-white rounded-2xl p-6 shadow-[0_4px_24px_rgb(0,0,0,0.04)] border border-slate-100 flex flex-col h-full hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition duration-300">
                    
                    <div class="mb-4">
                        <span class="inline-block px-3 py-1.5 text-xs font-bold rounded-md {{ $stage['status_color'] }}">
                            {{ $stage['status'] }}
                        </span>
                    </div>
                    
                    <h3 class="text-lg font-bold text-ilbbec-navy mb-5">{{ $stage['title'] }}</h3>
                    
                    <div class="space-y-4 text-sm text-slate-500 mt-auto font-medium">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>{{ $stage['date'] }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>{{ $stage['time'] }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span>{{ $stage['location'] }}</span>
                        </div>
                        @if($stage['title'] == 'Pendaftaran Berkas')
                        <div class="mt-auto pt-2">
                            @if($stage['status'] == 'Sedang Berlangsung' || $stage['status'] == 'Belum Dimulai')
                                <button type="button" data-modal-open="pendaftaran-modal" class="w-full text-center bg-sky-100 border border-blue-800 hover:bg-sky-900 font-semibold py-2.5 px-4 rounded-xl text-sm shadow-sm">
                                    Isi Formulir
                                </button>
                            @else
                                <button disabled class="w-full bg-slate-100 text-slate-400 font-semibold py-2.5 px-4 rounded-xl text-sm cursor-not-allowed">
                                    Selesai
                                </button>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- ========================================== -->
        <!-- TIMELINE MOBILE (Vertical)                 -->
        <!-- ========================================== -->
        <div class="md:hidden relative border-l-2 border-slate-100 ml-4 space-y-8 mt-10">
            @foreach($stages as $index => $stage)
            <div class="relative pl-8">
                
                <div class="absolute -left-[17px] top-4 w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold border-4 border-white
                    {{ $stage['status'] == 'Selesai' ? 'bg-ilbbec-navy text-white' : 
                      ($stage['status'] == 'Sedang Berlangsung' ? 'bg-ilbbec-orange text-white' : 'bg-slate-200 text-slate-500') }}">
                    @if($stage['status'] == 'Selesai')
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    @else
                        {{ $index + 1 }}
                    @endif
                </div>
                
                <div class="bg-white rounded-2xl p-5 shadow-[0_4px_20px_rgb(0,0,0,0.03)] border border-slate-100 relative overflow-hidden">
                    @if($stage['status'] == 'Sedang Berlangsung')
                        <div class="absolute top-0 left-0 w-1 h-full bg-ilbbec-orange"></div>
                    @endif
                    
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-base font-bold text-ilbbec-navy">{{ $stage['title'] }}</h3>
                        <span class="px-2 py-1 text-[10px] font-bold rounded-md {{ $stage['status_color'] }} whitespace-nowrap ml-2">
                            {{ $stage['status'] }}
                        </span>
                    </div>
                    
                    <div class="space-y-3 text-xs text-slate-500 font-medium">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>{{ $stage['date'] }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>{{ $stage['time'] }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span>{{ $stage['location'] }}</span>
                        </div>
                        @if($stage['title'] == 'Pendaftaran Berkas' && ($stage['status'] == 'Sedang Berlangsung' || $stage['status'] == 'Belum Dimulai'))
                            <button type="button" data-modal-open="pendaftaran-modal" class="w-full text-center bg-sky-100 border border-blue-800 hover:bg-sky-900 font-semibold py-2.5 px-4 rounded-xl text-sm shadow-sm">
                                Isi Formulir
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @include('modals.form')
    </main>

    <!-- Bottom Navigation (Mobile) -->
    <nav class="md:hidden fixed bottom-0 left-0 w-full bg-white border-t border-slate-100 shadow-[0_-4px_20px_rgb(0,0,0,0.04)] z-50 px-8 py-3 flex justify-between items-center text-xs pb-safe">
        <a href="#" class="flex flex-col items-center text-slate-900">
            <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 24 24"><path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" /><path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" /></svg>
            <span class="font-bold">Home</span>
        </a>
        <a href="#" class="flex flex-col items-center text-slate-400 hover:text-slate-900 transition-colors">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
            <span class="font-medium">Information</span>
        </a>
        <a href="#" class="flex flex-col items-center text-slate-400 hover:text-slate-900 transition-colors">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            <span class="font-medium">Profile</span>
        </a>
    </nav>
@endsection