@extends('layouts.app-user')

@section('title', 'Dashboard Seleksi | ILBBEC')

@section('content')

    <!-- KONTEN UTAMA (Dashboard Timeline) -->
    <main class="max-w-6xl mx-auto px-4 sm:px-6 pt-6 md:pt-14 pb-24 md:pb-16">
        
        <!-- Flash Alert Messages -->
        @if (session('success'))
            <div class="mb-8 flex items-center justify-between rounded-2xl border border-emerald-200 bg-emerald-50/90 px-5 py-4 text-sm text-emerald-800 shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5 shrink-0 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 font-bold text-lg">
                    &times;
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-8 flex items-center justify-between rounded-2xl border border-rose-200 bg-rose-50/90 px-5 py-4 text-sm text-rose-800 shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5 shrink-0 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700 font-bold text-lg">
                    &times;
                </button>
            </div>
        @endif

        <!-- Header / Greeting -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-extrabold text-brand-navy tracking-tight">
                Halo, {{ $user->Nama ?? 'Calon Anggota' }}
            </h2>
            <p class="text-slate-500 mt-2.5 text-sm md:text-base">
                Pantau seluruh rangkaian dan tentukan jadwal seleksi yang sesuai dengan ketersediaan Anda.
            </p>
        </div>

        <!-- TIMELINE HORIZONTAL -->
        <div class="bg-white rounded-3xl p-6 md:p-8 border border-slate-100 shadow-sm mb-10">
            <div class="overflow-x-auto pb-4 pt-2 -mx-2 px-2">
                <div class="min-w-[620px] md:min-w-0 relative">
                    
                    <!-- Garis Penghubung Track Background -->
                    <div class="absolute top-5 left-[12.5%] right-[12.5%] h-1 bg-slate-100 rounded-full -z-0"></div>
                    
                    <!-- Garis Penghubung Progress Aktif -->
                    <div class="absolute top-5 left-[12.5%] h-1 bg-brand-blue rounded-full -z-0 transition-all duration-500"
                        style="width: {{ $progressWidth }};"></div>

                    <!-- 4 Titik Tahapan -->
                    <div class="relative z-10 grid grid-cols-4">
                        
                        <!-- TAHAP 1: PENDAFTARAN -->
                        <div class="flex flex-col items-center text-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm shadow-sm transition-all border-4 border-white
                                {{ $selesaiBerkas ? 'bg-brand-blue text-white ring-4 ring-blue-50' : 'bg-brand-blue text-white ring-4 ring-blue-100 animate-pulse' }}">
                                @if($selesaiBerkas)
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                @else
                                    1
                                @endif
                            </div>
                            <div class="mt-3">
                                <h4 class="text-xs md:text-sm font-bold text-brand-navy">Pendaftaran</h4>
                                @if($selesaiBerkas)
                                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-emerald-600 mt-0.5">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                        Selesai
                                    </span>
                                @else
                                    <span class="inline-block text-[11px] font-semibold text-amber-600 mt-0.5">Aktif</span>
                                @endif
                            </div>
                        </div>

                        <!-- TAHAP 2: STUDY CASE -->
                        <div class="flex flex-col items-center text-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm shadow-sm transition-all border-4 border-white
                                {{ $selesaiSC ? 'bg-brand-blue text-white ring-4 ring-blue-50' : ($selectedJadwalSC ? 'bg-brand-blue text-white ring-4 ring-blue-100' : ($lolosBerkas ? 'bg-blue-100 text-brand-blue ring-4 ring-blue-50 animate-pulse' : 'bg-slate-100 text-slate-400 border-2 border-slate-200')) }}">
                                @if($selesaiSC)
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                @else
                                    2
                                @endif
                            </div>
                            <div class="mt-3">
                                <h4 class="text-xs md:text-sm font-bold text-brand-navy">Study Case</h4>
                                @if($selesaiSC)
                                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-emerald-600 mt-0.5">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                        Selesai
                                    </span>
                                @elseif($selectedJadwalSC)
                                    <span class="inline-block text-[11px] font-semibold text-brand-blue mt-0.5">Jadwal Dipilih</span>
                                @elseif($lolosBerkas)
                                    <span class="inline-block text-[11px] font-semibold text-amber-600 mt-0.5">Pilih Jadwal</span>
                                @else
                                    <span class="inline-block text-[11px] font-medium text-slate-400 mt-0.5">Menunggu</span>
                                @endif
                            </div>
                        </div>

                        <!-- TAHAP 3: WAWANCARA -->
                        <div class="flex flex-col items-center text-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm shadow-sm transition-all border-4 border-white
                                {{ $selesaiWwn ? 'bg-brand-blue text-white ring-4 ring-blue-50' : ($selectedJadwalWwn ? 'bg-brand-blue text-white ring-4 ring-blue-100' : ($lolosSC ? 'bg-blue-100 text-brand-blue ring-4 ring-blue-50 animate-pulse' : 'bg-slate-100 text-slate-400 border-2 border-slate-200')) }}">
                                @if($selesaiWwn)
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                @else
                                    3
                                @endif
                            </div>
                            <div class="mt-3">
                                <h4 class="text-xs md:text-sm font-bold text-brand-navy">Wawancara</h4>
                                @if($selesaiWwn)
                                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-emerald-600 mt-0.5">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                        Selesai
                                    </span>
                                @elseif($selectedJadwalWwn)
                                    <span class="inline-block text-[11px] font-semibold text-brand-blue mt-0.5">Jadwal Dipilih</span>
                                @elseif($lolosSC)
                                    <span class="inline-block text-[11px] font-semibold text-amber-600 mt-0.5">Pilih Jadwal</span>
                                @else
                                    <span class="inline-block text-[11px] font-medium text-slate-400 mt-0.5">Menunggu</span>
                                @endif
                            </div>
                        </div>

                        <!-- TAHAP 4: PENGUMUMAN -->
                        <div class="flex flex-col items-center text-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm shadow-sm transition-all border-4 border-white
                                {{ $selesaiPengumuman ? 'bg-brand-blue text-white ring-4 ring-blue-50' : ($aktifPengumuman ? 'bg-brand-blue text-white ring-4 ring-blue-100 animate-pulse' : 'bg-slate-100 text-slate-400 border-2 border-slate-200') }}">
                                @if($selesaiPengumuman)
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                @else
                                    4
                                @endif
                            </div>
                            <div class="mt-3">
                                <h4 class="text-xs md:text-sm font-bold text-brand-navy">Pengumuman</h4>
                                @if($selesaiPengumuman)
                                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-emerald-600 mt-0.5">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                        Selesai
                                    </span>
                                @elseif($aktifPengumuman)
                                    <span class="inline-block text-[11px] font-semibold text-brand-blue mt-0.5">Tahap Evaluasi</span>
                                @else
                                    <span class="inline-block text-[11px] font-medium text-slate-400 mt-0.5">Belum Dimulai</span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- KARTU INFORMASI LANJUTAN                   -->
        <!-- ========================================== -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- TAHAP 1: PENDAFTARAN BERKAS -->
            <div class="bg-white rounded-2xl p-6 border border-slate-100 flex flex-col h-full shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tahap 01</span>
                    @if($hasPendaftaran)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Selesai
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-amber-50 text-amber-700 border border-amber-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                            Sedang Berlangsung
                        </span>
                    @endif
                </div>

                <h3 class="text-lg font-bold text-brand-navy mb-4">Pendaftaran Berkas</h3>

                <div class="space-y-3 text-sm text-slate-600 mb-6 flex-grow font-medium">
                    <div class="flex items-center justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-400 text-xs">Tanggal Submit</span>
                        <span class="font-semibold text-slate-700">{{ $pendaftaran ? $pendaftaran->created_at->format('d M Y') : '-' }}</span>
                    </div>
                    <div class="flex items-center justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-400 text-xs">Waktu</span>
                        <span class="font-semibold text-slate-700">{{ $pendaftaran ? $pendaftaran->created_at->format('H:i') . ' WIB' : '-' }}</span>
                    </div>
                    <div class="flex items-center justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-400 text-xs">Status Berkas</span>
                        <span class="font-semibold {{ ($pendaftaran && $pendaftaran->StatusBerkas === 'Lolos') ? 'text-emerald-600' : ($pendaftaran && in_array($pendaftaran->StatusBerkas, ['Tidak Lolos', 'Gagal']) ? 'text-rose-600' : 'text-slate-700') }}">
                            {{ $pendaftaran ? ($pendaftaran->StatusBerkas ?? 'Menunggu') : 'Belum Submit' }}
                        </span>
                    </div>
                    @if($pendaftaran && $pendaftaran->Divisi)
                    <div class="flex items-center justify-between py-1">
                        <span class="text-slate-400 text-xs">Divisi Pilihan</span>
                        <span class="font-semibold text-brand-navy text-xs px-2 py-0.5 bg-blue-50 rounded">{{ $pendaftaran->Divisi }}</span>
                    </div>
                    @endif
                    @if($pendaftaran && $pendaftaran->Divisi2)
                    <div class="flex items-center justify-between py-1">
                        <span class="text-slate-400 text-xs">Divisi Pilihan 2</span>
                        <span class="font-semibold text-brand-navy text-xs px-2 py-0.5 bg-blue-50 rounded">{{ $pendaftaran->Divisi2 }}</span>
                    </div>
                    @endif
                </div>

                <div class="mt-auto pt-2">
                    @if($hasPendaftaran)
                        <button disabled class="w-full flex items-center justify-center gap-2 bg-slate-100 text-slate-400 font-semibold py-2.5 px-4 rounded-xl text-sm cursor-not-allowed">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            Telah Terdaftar
                        </button>
                    @else
                        <button type="button" data-modal-open="pendaftaran-modal" class="w-full flex items-center justify-center gap-2 bg-brand-blue hover:bg-blue-800 text-white font-semibold py-2.5 px-4 rounded-xl text-sm shadow-sm transition hover:shadow-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Isi Formulir
                        </button>
                    @endif
                </div>
            </div>

            <!-- TAHAP 2: STUDY CASE -->
            <div class="bg-white rounded-2xl p-6 border border-slate-100 flex flex-col h-full shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tahap 02</span>
                    @if($selesaiSC)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Selesai
                        </span>
                    @elseif($selectedJadwalSC)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-blue-50 text-brand-blue border border-blue-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-brand-blue"></span>
                            Dikonfirmasi
                        </span>
                    @elseif($lolosBerkas)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-amber-50 text-amber-700 border border-amber-200">
                            Pilih Jadwal
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-400 border border-slate-200">
                            Belum Terbuka
                        </span>
                    @endif
                </div>

                <h3 class="text-lg font-bold text-brand-navy mb-4">Study Case</h3>

                <div class="space-y-3 text-sm text-slate-600 mb-6 flex-grow font-medium">
                    @if($selectedJadwalSC)
                        <!-- Tampilan Jika Sudah Memilih Jadwal -->
                        <div class="p-3 bg-blue-50/60 rounded-xl border border-blue-100 mb-2">
                            <div class="flex items-center gap-1.5 text-xs font-bold text-brand-blue uppercase tracking-wide mb-2">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                Jadwal Anda
                            </div>
                            <div class="space-y-1.5 text-xs">
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Tanggal:</span>
                                    <span class="font-bold text-brand-navy">{{ \Carbon\Carbon::parse($selectedJadwalSC->TanggalMulai)->format('d F Y') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Waktu Mulai:</span>
                                    <span class="font-bold text-brand-navy">{{ \Carbon\Carbon::parse($selectedJadwalSC->Jam)->format('H:i') }} WIB</span>
                                </div>
                                @if(!empty($selectedJadwalSC->Lokasi))
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Lokasi / Ruang:</span>
                                    <span class="font-bold text-brand-navy">{{ $selectedJadwalSC->Lokasi }}</span>
                                </div>
                                @endif
                                @if(!empty($selectedJadwalSC->keterangan))
                                <div class="text-[11px] text-slate-500 pt-1 border-t border-blue-100">
                                    Info: {{ $selectedJadwalSC->keterangan }}
                                </div>
                                @endif
                            </div>
                        </div>
                    @elseif($lolosBerkas)
                        <!-- Belum Memilih Jadwal -->
                        <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-100 text-xs text-slate-600 leading-relaxed">
                            <p class="font-semibold text-brand-navy mb-1">Silakan pilih waktu yang sesuai dengan ketersediaan Anda.</p>
                            <p class="text-slate-500 text-[11px]">Pilih salah satu jadwal yang telah disediakan admin di bawah.</p>
                        </div>
                    @else
                        <!-- Belum Lolos Berkas -->
                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 text-xs text-slate-400 leading-relaxed">
                            Jadwal Study Case akan dapat dipilih setelah Anda dinyatakan <strong>Lolos</strong> pada tahap Seleksi Berkas.
                        </div>
                    @endif
                </div>

                <div class="mt-auto pt-2">
                    @if($lolosBerkas)
                        @if($selectedJadwalSC)
                            <!-- <button type="button" 
                                    data-modal-open="modal-pilih-sc" 
                                    class="w-full flex items-center justify-center gap-2 bg-white border border-blue-200 hover:bg-blue-50 text-brand-blue font-semibold py-2.5 px-4 rounded-xl text-sm transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                Ubah Jadwal
                            </button> -->
                            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Anda Sudah Terdaftar</span>
                        @else
                            <button type="button" 
                                    data-modal-open="modal-pilih-sc" 
                                    class="w-full flex items-center justify-center gap-2 bg-brand-blue hover:bg-blue-800 text-white font-semibold py-2.5 px-4 rounded-xl text-sm shadow-sm transition hover:shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Pilih Jadwal
                            </button>
                        @endif
                    @else
                        <button disabled class="w-full flex items-center justify-center gap-2 bg-slate-100 text-slate-400 font-semibold py-2.5 px-4 rounded-xl text-sm cursor-not-allowed">
                            Terkunci
                        </button>
                    @endif
                </div>
            </div>

            <!-- TAHAP 3: WAWANCARA -->
            <div class="bg-white rounded-2xl p-6 border border-slate-100 flex flex-col h-full shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tahap 03</span>
                    @if($selesaiWwn)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Selesai
                        </span>
                    @elseif($selectedJadwalWwn)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-blue-50 text-brand-blue border border-blue-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-brand-blue"></span>
                            Dikonfirmasi
                        </span>
                    @elseif($lolosSC)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-amber-50 text-amber-700 border border-amber-200">
                            Pilih Jadwal
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-400 border border-slate-200">
                            Belum Terbuka
                        </span>
                    @endif
                </div>

                <h3 class="text-lg font-bold text-brand-navy mb-4">Wawancara</h3>

                <div class="space-y-3 text-sm text-slate-600 mb-6 flex-grow font-medium">
                    @if($selectedJadwalWwn)
                        <!-- Tampilan Jika Sudah Memilih Jadwal Wawancara -->
                        <div class="p-3 bg-blue-50/60 rounded-xl border border-blue-100 mb-2">
                            <div class="flex items-center gap-1.5 text-xs font-bold text-brand-blue uppercase tracking-wide mb-2">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                Jadwal Anda
                            </div>
                            <div class="space-y-1.5 text-xs">
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Tanggal:</span>
                                    <span class="font-bold text-brand-navy">{{ \Carbon\Carbon::parse($selectedJadwalWwn->TanggalMulai)->format('d F Y') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Waktu Mulai:</span>
                                    <span class="font-bold text-brand-navy">{{ \Carbon\Carbon::parse($selectedJadwalWwn->Jam)->format('H:i') }} WIB</span>
                                </div>
                                @if(!empty($selectedJadwalWwn->Lokasi))
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Lokasi / Ruang:</span>
                                    <span class="font-bold text-brand-navy">{{ $selectedJadwalWwn->Lokasi }}</span>
                                </div>
                                @endif
                                @if(!empty($selectedJadwalWwn->keterangan))
                                <div class="text-[11px] text-slate-500 pt-1 border-t border-blue-100">
                                    Info: {{ $selectedJadwalWwn->keterangan }}
                                </div>
                                @endif
                            </div>
                        </div>
                    @elseif($lolosSC)
                        <!-- Belum Memilih Jadwal Wawancara -->
                        <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-100 text-xs text-slate-600 leading-relaxed">
                            <p class="font-semibold text-brand-navy mb-1">Silakan pilih waktu yang sesuai dengan ketersediaan Anda.</p>
                            <p class="text-slate-500 text-[11px]">Pilih salah satu jadwal wawancara yang telah disediakan admin.</p>
                        </div>
                    @else
                        <!-- Belum Lolos Study Case -->
                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 text-xs text-slate-400 leading-relaxed">
                            Jadwal Wawancara akan dapat dipilih setelah Anda dinyatakan <strong>Lolos</strong> pada tahap Study Case.
                        </div>
                    @endif
                </div>

                <div class="mt-auto pt-2">
                    @if($lolosSC)
                        @if($selectedJadwalWwn)
                            <button type="button" 
                                    data-modal-open="modal-pilih-wwn" 
                                    class="w-full flex items-center justify-center gap-2 bg-white border border-blue-200 hover:bg-blue-50 text-brand-blue font-semibold py-2.5 px-4 rounded-xl text-sm transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                Ubah Jadwal
                            </button>
                        @else
                            <button type="button" 
                                    data-modal-open="modal-pilih-wwn" 
                                    class="w-full flex items-center justify-center gap-2 bg-brand-blue hover:bg-blue-800 text-white font-semibold py-2.5 px-4 rounded-xl text-sm shadow-sm transition hover:shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Pilih Jadwal
                            </button>
                        @endif
                    @else
                        <button disabled class="w-full flex items-center justify-center gap-2 bg-slate-100 text-slate-400 font-semibold py-2.5 px-4 rounded-xl text-sm cursor-not-allowed">
                            Terkunci
                        </button>
                    @endif
                </div>
            </div>

            <!-- TAHAP 4: PENGUMUMAN -->
            <div class="bg-white rounded-2xl p-6 border border-slate-100 flex flex-col h-full shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tahap 04</span>
                    @if($selesaiPengumuman)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Selesai
                        </span>
                    @elseif($aktifPengumuman)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-blue-50 text-brand-blue border border-blue-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-brand-blue"></span>
                            Tahap Evaluasi
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-500 border border-slate-200">
                            Belum Dimulai
                        </span>
                    @endif
                </div>

                <h3 class="text-lg font-bold text-brand-navy mb-4">Pengumuman</h3>

                <div class="space-y-3 text-sm text-slate-600 mb-6 flex-grow font-medium">
                    <div class="flex items-center justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-400 text-xs">Hasil Seleksi</span>
                        @if($pendaftaran && $pendaftaran->StatusAkhir)
                            @if($pendaftaran->StatusAkhir === 'Lolos')
                                <span class="font-bold text-xs px-2.5 py-1 rounded-md bg-emerald-50 text-emerald-700 border border-emerald-200">Lolos Seleksi 🎉</span>
                            @elseif(in_array($pendaftaran->StatusAkhir, ['Tidak Lolos', 'Gagal']))
                                <span class="font-bold text-xs px-2.5 py-1 rounded-md bg-rose-50 text-rose-700 border border-rose-200">Tidak Lolos</span>
                            @else
                                <span class="font-bold text-xs px-2.5 py-1 rounded-md bg-blue-50 text-brand-blue border border-blue-200">{{ $pendaftaran->StatusAkhir }}</span>
                            @endif
                        @else
                            <span class="text-slate-400 text-xs italic">Menunggu Evaluasi</span>
                        @endif
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 text-xs text-slate-500 leading-relaxed">
                        @if($pendaftaran && $pendaftaran->StatusAkhir === 'Lolos')
                            Selamat! Anda dinyatakan lolos sebagai anggota ILBBEC. Informasi onboarding akan segera disampaikan.
                        @elseif($pendaftaran && in_array($pendaftaran->StatusAkhir, ['Tidak Lolos', 'Gagal']))
                            Terima kasih atas partisipasi Anda dalam seleksi ILBBEC. Tetap semangat dan jangan menyerah!
                        @else
                            Pengumuman kelolosan final akan diperbarui setelah seluruh tahapan seleksi selesai dievaluasi.
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <!-- ======================================================== -->
        <!-- MODAL PILIH JADWAL: STUDY CASE                           -->
        <!-- ======================================================== -->
        <div id="modal-pilih-sc" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4 overflow-y-auto" role="dialog" aria-modal="true">
            <div class="w-full max-w-lg rounded-3xl bg-white shadow-2xl border border-slate-100 overflow-hidden transform transition-all">
                <div class="flex items-center justify-between border-b border-slate-100 px-6 py-4 bg-slate-50/70">
                    <div>
                        <h3 class="text-base font-bold text-brand-navy">Pilih Jadwal Study Case</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Pilih salah satu jadwal yang sesuai dengan ketersediaan Anda.</p>
                    </div>
                    <button type="button" data-modal-close="modal-pilih-sc" class="rounded-xl p-1.5 text-slate-400 hover:bg-slate-100">✕</button>
                </div>
                
                <form action="{{ route('user.jadwal.pilih') }}" method="POST" class="p-6">
                    @csrf
                    <div class="space-y-3 mb-6">
                        @forelse($availableJadwalSC as $sesi)
                            @php
                                $isSelected = $selectedJadwalSC && $selectedJadwalSC->SesiId === $sesi->SesiId;
                            @endphp
                            <label class="flex items-start gap-3.5 p-4 rounded-2xl border transition cursor-pointer hover:border-brand-blue hover:bg-blue-50/40 {{ $isSelected ? 'border-brand-blue bg-blue-50/50 ring-2 ring-blue-200' : 'border-slate-200 bg-white' }}">
                                <input type="radio" 
                                       name="SesiId" 
                                       value="{{ $sesi->SesiId }}" 
                                       class="mt-1 h-4 w-4 text-brand-blue focus:ring-brand-blue border-slate-300"
                                       {{ $isSelected ? 'checked' : '' }}
                                       required>
                                <div class="flex-1 text-xs">
                                    <div class="flex items-center justify-between gap-2 mb-1">
                                        <span class="font-bold text-sm text-brand-navy">
                                            {{ \Carbon\Carbon::parse($sesi->TanggalMulai)->format('d F Y') }}
                                        </span>
                                        <span class="px-2 py-0.5 rounded-md bg-blue-100/70 text-brand-blue font-bold text-[11px]">
                                            {{ \Carbon\Carbon::parse($sesi->Jam)->format('H:i') }} WIB
                                        </span>
                                    </div>
                                    @if(!empty($sesi->Lokasi))
                                        <p class="text-slate-600 font-medium flex items-center gap-1.5 mt-1">
                                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                            {{ $sesi->Lokasi }}
                                        </p>
                                    @endif
                                    @if(!empty($sesi->keterangan))
                                        <p class="text-slate-400 text-[11px] mt-1">{{ $sesi->keterangan }}</p>
                                    @endif
                                </div>
                            </label>
                        @empty
                            <div class="py-8 text-center text-xs text-slate-400 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                                <svg class="w-8 h-8 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Belum ada jadwal yang tersedia.
                            </div>
                        @endforelse
                    </div>

                    <div class="flex justify-end gap-3 pt-3 border-t border-slate-100">
                        <button type="button" data-modal-close="modal-pilih-sc" class="px-5 py-2.5 text-xs font-semibold text-slate-600 rounded-xl border border-slate-200 hover:bg-slate-50">Batal</button>
                        @if($availableJadwalSC->count() > 0)
                            <button type="submit" class="px-6 py-2.5 text-xs font-semibold text-white bg-brand-blue rounded-xl hover:bg-blue-800 shadow-sm transition">
                                Konfirmasi Pilihan
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- ======================================================== -->
        <!-- MODAL PILIH JADWAL: WAWANCARA                            -->
        <!-- ======================================================== -->
        <div id="modal-pilih-wwn" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4 overflow-y-auto" role="dialog" aria-modal="true">
            <div class="w-full max-w-lg rounded-3xl bg-white shadow-2xl border border-slate-100 overflow-hidden transform transition-all">
                <div class="flex items-center justify-between border-b border-slate-100 px-6 py-4 bg-slate-50/70">
                    <div>
                        <h3 class="text-base font-bold text-brand-navy">Pilih Jadwal Wawancara</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Pilih salah satu jadwal interview yang sesuai dengan ketersediaan Anda.</p>
                    </div>
                    <button type="button" data-modal-close="modal-pilih-wwn" class="rounded-xl p-1.5 text-slate-400 hover:bg-slate-100">✕</button>
                </div>
                
                <form action="{{ route('user.jadwal.pilih') }}" method="POST" class="p-6">
                    @csrf
                    <div class="space-y-3 mb-6">
                        @forelse($availableJadwalWwn as $sesi)
                            @php
                                $isSelected = $selectedJadwalWwn && $selectedJadwalWwn->SesiId === $sesi->SesiId;
                            @endphp
                            <label class="flex items-start gap-3.5 p-4 rounded-2xl border transition cursor-pointer hover:border-brand-blue hover:bg-blue-50/40 {{ $isSelected ? 'border-brand-blue bg-blue-50/50 ring-2 ring-blue-200' : 'border-slate-200 bg-white' }}">
                                <input type="radio" 
                                       name="SesiId" 
                                       value="{{ $sesi->SesiId }}" 
                                       class="mt-1 h-4 w-4 text-brand-blue focus:ring-brand-blue border-slate-300"
                                       {{ $isSelected ? 'checked' : '' }}
                                       required>
                                <div class="flex-1 text-xs">
                                    <div class="flex items-center justify-between gap-2 mb-1">
                                        <span class="font-bold text-sm text-brand-navy">
                                            {{ \Carbon\Carbon::parse($sesi->TanggalMulai)->format('d F Y') }}
                                        </span>
                                        <span class="px-2 py-0.5 rounded-md bg-blue-100/70 text-brand-blue font-bold text-[11px]">
                                            {{ \Carbon\Carbon::parse($sesi->Jam)->format('H:i') }} WIB
                                        </span>
                                    </div>
                                    @if(!empty($sesi->Lokasi))
                                        <p class="text-slate-600 font-medium flex items-center gap-1.5 mt-1">
                                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                            {{ $sesi->Lokasi }}
                                        </p>
                                    @endif
                                    @if(!empty($sesi->keterangan))
                                        <p class="text-slate-400 text-[11px] mt-1">{{ $sesi->keterangan }}</p>
                                    @endif
                                </div>
                            </label>
                        @empty
                            <div class="py-8 text-center text-xs text-slate-400 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                                <svg class="w-8 h-8 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Belum ada jadwal yang tersedia.
                            </div>
                        @endforelse
                    </div>

                    <div class="flex justify-end gap-3 pt-3 border-t border-slate-100">
                        <button type="button" data-modal-close="modal-pilih-wwn" class="px-5 py-2.5 text-xs font-semibold text-slate-600 rounded-xl border border-slate-200 hover:bg-slate-50">Batal</button>
                        @if($availableJadwalWwn->count() > 0)
                            <button type="submit" class="px-6 py-2.5 text-xs font-semibold text-white bg-brand-blue rounded-xl hover:bg-blue-800 shadow-sm transition">
                                Konfirmasi Pilihan
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Form Pendaftaran Modal -->
        @include('modals.form')
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleModal = (modalId, isOpen) => {
            const modal = document.getElementById(modalId);
            if (!modal) return;
            if (isOpen) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.classList.add('overflow-hidden');
            } else {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
            }
        };

        document.addEventListener('click', (e) => {
            const openTrigger = e.target.closest('[data-modal-open]');
            const closeTrigger = e.target.closest('[data-modal-close]');

            if (openTrigger) {
                e.preventDefault();
                toggleModal(openTrigger.dataset.modalOpen, true);
            } else if (closeTrigger) {
                e.preventDefault();
                toggleModal(closeTrigger.dataset.modalClose, false);
            }
        });

        // Close on backdrop click
        ['modal-pilih-sc', 'modal-pilih-wwn'].forEach(id => {
            const modal = document.getElementById(id);
            modal?.addEventListener('click', (e) => {
                if (e.target === modal) {
                    toggleModal(id, false);
                }
            });
        });

        // Close on Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                toggleModal('modal-pilih-sc', false);
                toggleModal('modal-pilih-wwn', false);
            }
        });
    });
    </script>
@endsection