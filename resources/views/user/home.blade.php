@extends('layouts.app-user')

@section('content')

    @php
        $sekarang = \Carbon\Carbon::now();

        // 1. Relasi & Data Pendaftaran
        $tglPendaftaran = $pendaftaran ? $pendaftaran->created_at : null;
        $hasPendaftaran = !is_null($pendaftaran);

        $studyCase = optional($pendaftaran)->study_case;
        $jadwalSC = optional($studyCase)->jadwal_sesi;

        $wawancara = optional($pendaftaran)->wawancara;
        $jadwalWwn = optional($wawancara)->jadwal_sesi;

        // 2. Parse Tanggal Langsung dari Database
        $tglSC = ($jadwalSC && $jadwalSC->TanggalSesi) ? \Carbon\Carbon::parse($jadwalSC->TanggalSesi) : null;
        $tglWwn = ($jadwalWwn && $jadwalWwn->TanggalSesi) ? \Carbon\Carbon::parse($jadwalWwn->TanggalSesi) : null;

        // 3. Logika Kondisional H-3 & Keaktifan Sesi
        $bukaSC = $tglSC && $sekarang->copy()->addDays(5)->greaterThanOrEqualTo($tglSC);
        $aktifSC = $tglSC && $sekarang->greaterThanOrEqualTo($tglSC);

        $bukaWwn = $tglWwn && $sekarang->copy()->addDays(5)->greaterThanOrEqualTo($tglWwn);
        $aktifWwn = $tglWwn && $sekarang->greaterThanOrEqualTo($tglWwn);

        // 4. Status Penyelesaian Tiap Tahap
        $selesaiBerkas = $hasPendaftaran;
        $selesaiSC = $studyCase && (!is_null($studyCase->NilaiKasus) || in_array($studyCase->StatusKasus, ['Selesai', 'Lolos']));
        $selesaiWwn = $wawancara && (!is_null($wawancara->NilaiWawancara) || in_array($wawancara->StatusWawancara, ['Selesai', 'Lolos']));
        $selesaiPengumuman = $pendaftaran && !is_null($pendaftaran->StatusAkhir) && $pendaftaran->StatusAkhir !== 'Menunggu';
        $aktifPengumuman = $pendaftaran && !is_null($pendaftaran->StatusAkhir);

        // Hitung Progres Garis Horizontal Timeline (0% s/d 75%)
        if ($selesaiPengumuman) {
            $progressWidth = '75%';
        } elseif ($selesaiWwn || $aktifWwn) {
            $progressWidth = '50%';
        } elseif ($selesaiSC || $aktifSC) {
            $progressWidth = '25%';
        } elseif ($selesaiBerkas) {
            $progressWidth = '12.5%';
        } else {
            $progressWidth = '0%';
        }
    @endphp

    <!-- KONTEN UTAMA (Dashboard Timeline) -->
    <main class="max-w-6xl mx-auto px-4 sm:px-6 pt-6 md:pt-14 pb-24 md:pb-16">
        
        <!-- Flash Alert Messages -->
        @if (session('success'))
            <div class="mb-8 flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50/90 px-5 py-4 text-sm text-emerald-800 shadow-sm">
                <svg class="h-5 w-5 shrink-0 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-8 flex items-center gap-3 rounded-2xl border border-rose-200 bg-rose-50/90 px-5 py-4 text-sm text-rose-800 shadow-sm">
                <svg class="h-5 w-5 shrink-0 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Header / Greeting -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-extrabold text-brand-navy tracking-tight">
                Halo, {{ $user->Nama ?? 'Calon Anggota' }}
            </h2>
            <p class="text-slate-500 mt-2.5 text-sm md:text-base">
                Pantau seluruh rangkaian dan progres tahapan seleksi ILBBEC di bawah ini.
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
                                {{ $selesaiSC ? 'bg-brand-blue text-white ring-4 ring-blue-50' : ($aktifSC ? 'bg-brand-blue text-white ring-4 ring-blue-100 animate-pulse' : ($jadwalSC ? 'bg-slate-100 text-slate-700 border-2 border-slate-300' : 'bg-slate-100 text-slate-400 border-2 border-slate-200')) }}">
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
                                @elseif($aktifSC)
                                    <span class="inline-block text-[11px] font-semibold text-brand-blue mt-0.5">Sedang Berlangsung</span>
                                @elseif($jadwalSC)
                                    <span class="inline-block text-[11px] font-medium text-slate-500 mt-0.5">Dijadwalkan</span>
                                @else
                                    <span class="inline-block text-[11px] font-medium text-slate-400 mt-0.5">Menunggu</span>
                                @endif
                            </div>
                        </div>

                        <!-- TAHAP 3: WAWANCARA -->
                        <div class="flex flex-col items-center text-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm shadow-sm transition-all border-4 border-white
                                {{ $selesaiWwn ? 'bg-brand-blue text-white ring-4 ring-blue-50' : ($aktifWwn ? 'bg-brand-blue text-white ring-4 ring-blue-100 animate-pulse' : ($jadwalWwn ? 'bg-slate-100 text-slate-700 border-2 border-slate-300' : 'bg-slate-100 text-slate-400 border-2 border-slate-200')) }}">
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
                                @elseif($aktifWwn)
                                    <span class="inline-block text-[11px] font-semibold text-brand-blue mt-0.5">Sedang Berlangsung</span>
                                @elseif($jadwalWwn)
                                    <span class="inline-block text-[11px] font-medium text-slate-500 mt-0.5">Dijadwalkan</span>
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
                        <span class="text-slate-400 text-xs">Tanggal</span>
                        <span class="font-semibold text-slate-700">{{ $pendaftaran ? $pendaftaran->created_at->format('d M Y') : '-' }}</span>
                    </div>
                    <div class="flex items-center justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-400 text-xs">Waktu</span>
                        <span class="font-semibold text-slate-700">{{ $pendaftaran ? $pendaftaran->created_at->format('H:i') . ' WIB' : '-' }}</span>
                    </div>
                    <div class="flex items-center justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-400 text-xs">Status Berkas</span>
                        <span class="font-semibold {{ ($pendaftaran && $pendaftaran->StatusBerkas === 'Lolos') ? 'text-emerald-600' : 'text-slate-700' }}">
                            {{ $pendaftaran ? ($pendaftaran->StatusBerkas ?? 'Menunggu') : 'Belum Submit' }}
                        </span>
                    </div>
                    @if($pendaftaran && $pendaftaran->Divisi)
                    <div class="flex items-center justify-between py-1">
                        <span class="text-slate-400 text-xs">Divisi Pilihan</span>
                        <span class="font-semibold text-brand-navy text-xs px-2 py-0.5 bg-blue-50 rounded">{{ $pendaftaran->Divisi }}</span>
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
                    @elseif($jadwalSC && $jadwalSC->IsActive)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-blue-50 text-brand-blue border border-blue-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-brand-blue"></span>
                            Aktif
                        </span>
                    @elseif($jadwalSC)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-600 border border-slate-200">
                            Dijadwalkan
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-500 border border-slate-200">
                            Belum Ada Jadwal
                        </span>
                    @endif
                </div>

                <h3 class="text-lg font-bold text-brand-navy mb-4">Study Case</h3>

                <div class="space-y-3 text-sm text-slate-600 mb-6 flex-grow font-medium">
                    @if($jadwalSC && $bukaSC)
                        <div class="flex items-center justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-400 text-xs">Tanggal</span>
                            <span class="font-semibold text-slate-700">{{ $tglSC->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-400 text-xs">Waktu</span>
                            <span class="font-semibold text-slate-700">{{ \Carbon\Carbon::parse($jadwalSC->WaktuMulai)->format('H:i') }} WIB</span>
                        </div>
                        <div class="flex items-center justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-400 text-xs">Ruangan / Sesi</span>
                            <span class="font-semibold text-slate-700">{{ $studyCase->Lokasi ?? ('Sesi ID: ' . $jadwalSC->SesiId) }}</span>
                        </div>
                        @if($studyCase && $studyCase->Kelompok)
                        <div class="flex items-center justify-between py-1">
                            <span class="text-slate-400 text-xs">Kelompok</span>
                            <span class="font-semibold text-brand-navy text-xs px-2 py-0.5 bg-blue-50 rounded">{{ $studyCase->Kelompok }}</span>
                        </div>
                        @endif
                    @else
                        <div class="flex items-center justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-400 text-xs">Tanggal</span>
                            <span class="font-semibold text-slate-700">{{ ($jadwalSC && $tglSC) ? $tglSC->format('d M Y') : '-' }}</span>
                        </div>
                        <div class="flex items-center justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-400 text-xs">Waktu</span>
                            <span class="text-slate-400 italic text-xs">Terkunci (H-3)</span>
                        </div>
                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 text-xs text-slate-400 leading-relaxed italic">
                            Detail waktu & ruangan baru akan dibuka secara otomatis pada H-3 dari jadwal sesi.
                        </div>
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
                    @elseif($jadwalWwn && $jadwalWwn->IsActive)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-blue-50 text-brand-blue border border-blue-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-brand-blue"></span>
                            Aktif
                        </span>
                    @elseif($jadwalWwn)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-600 border border-slate-200">
                            Dijadwalkan
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-500 border border-slate-200">
                            Belum Ada Jadwal
                        </span>
                    @endif
                </div>

                <h3 class="text-lg font-bold text-brand-navy mb-4">Wawancara</h3>

                <div class="space-y-3 text-sm text-slate-600 mb-6 flex-grow font-medium">
                    @if($jadwalWwn && $bukaWwn)
                        <div class="flex items-center justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-400 text-xs">Tanggal</span>
                            <span class="font-semibold text-slate-700">{{ $tglWwn->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-400 text-xs">Waktu</span>
                            <span class="font-semibold text-slate-700">{{ \Carbon\Carbon::parse($jadwalWwn->WaktuMulai)->format('H:i') }} WIB</span>
                        </div>
                        <div class="flex items-center justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-400 text-xs">Ruangan / Lokasi</span>
                            <span class="font-semibold text-slate-700">{{ $wawancara->Lokasi ?? ('Sesi ID: ' . $jadwalWwn->SesiId) }}</span>
                        </div>
                    @else
                        <div class="flex items-center justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-400 text-xs">Tanggal</span>
                            <span class="font-semibold text-slate-700">{{ ($jadwalWwn && $tglWwn) ? $tglWwn->format('d M Y') : '-' }}</span>
                        </div>
                        <div class="flex items-center justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-400 text-xs">Waktu</span>
                            <span class="text-slate-400 italic text-xs">Terkunci (H-3)</span>
                        </div>
                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 text-xs text-slate-400 leading-relaxed italic">
                            Detail waktu & ruangan wawancara baru akan dibuka secara otomatis pada H-3 dari jadwal sesi.
                        </div>
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

        <!-- Form Pendaftaran Modal -->
        @include('modals.form')
    </main>
@endsection