@extends('layouts.app-admin')

@section('title', 'Jadwal Seleksi | ILBBEC Admin')

@section('content')
<div class="min-h-screen bg-slate-50/60 pb-16">
    <div class="max-w-[1600px] mx-auto px-4 sm:px-4 lg:px-4 py-4 lg:py-6">

        <!-- Pesan -->
        @if (session('success'))
            <div class="mb-6 flex items-center justify-between rounded-2xl border border-emerald-200 bg-emerald-50/90 px-5 py-4 text-sm text-emerald-800 shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5 shrink-0 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">
                    &times;
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 flex items-center justify-between rounded-2xl border border-rose-200 bg-rose-50/90 px-5 py-4 text-sm text-rose-800 shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5 shrink-0 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700">
                    &times;
                </button>
            </div>
        @endif

        <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between mb-8 pb-6 border-b border-slate-200/70">
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-brand-navy">
                    Kelola Jadwal Seleksi
                </h1>
                <p class="mt-1.5 text-sm text-slate-500">
                    Atur dan pantau penjadwalan tahapan seleksi.
                </p>
            </div>

            <!-- Tombol Trigger Modal Jadwal -->
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <button type="button" 
                    data-modal-open="jadwal-modal" 
                    class="w-full sm:w-auto justify-center inline-flex items-center gap-2.5 rounded-xl bg-brand-blue px-5 py-3 text-sm font-semibold text-white shadow-md shadow-blue-700/20 hover:bg-blue-800 transition-all transform hover:-translate-y-0.5">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Daftarkan Tahapan Seleksi
                </button>
            </div>
        </div>

        <!-- Jadwal Tahapan Seleksi yang Terdaftar -->
        <section class="rounded-3xl border border-slate-200/80 bg-white p-6 sm:p-7 shadow-sm mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-lg font-bold text-brand-navy flex items-center gap-2.5">
                        <svg class="h-5 w-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Jadwal Tahapan Seleksi Terdaftar
                    </h2>
                </div>
            </div>

            @if(isset($jadwalSesi) && $jadwalSesi->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($jadwalSesi as $sesi)
                        <div class="rounded-2xl border border-blue-50 bg-gradient-to-br from-blue-50/30 to-white p-4 relative group hover:border-blue-200 hover:shadow-sm transition-all">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold 
                                        {{ str_contains($sesi->NamaSesi, 'Berkas') ? 'bg-amber-50 text-amber-700 border border-amber-200' : 
                                        (str_contains($sesi->NamaSesi, 'Study') ? 'bg-blue-50 text-brand-blue border border-blue-200' : 'bg-purple-50 text-purple-700 border border-purple-200') }}">
                                        {{ $sesi->NamaSesi }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold {{ $sesi->IsActive ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                                        {{ $sesi->IsActive ? 'Aktif' : 'Non-Aktif' }}
                                    </span>
                                    <form action="{{ route('admin.jadwal.destroy', $sesi->SesiId) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-slate-300 hover:text-rose-600 transition p-1" title="Hapus Jadwal">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="space-y-1.5 text-xs text-slate-600">
                                <div class="flex items-center gap-2">
                                    <svg class="h-3.5 w-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span>{{ \Carbon\Carbon::parse($sesi->TanggalSesi)->format('d F Y') }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="h-3.5 w-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span>{{ \Carbon\Carbon::parse($sesi->Jam ?? $sesi->WaktuMulai)->format('H:i') }} WIB</span>
                                </div>
                                @if(!empty($sesi->Lokasi))
                                <div class="flex items-center gap-2">
                                    <svg class="h-3.5 w-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                    <span class="font-medium text-slate-700">{{ $sesi->Lokasi }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="rounded-2xl border border-dashed border-blue-200 bg-blue-50/30 p-8 text-center">
                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-brand-blue mb-3">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-brand-navy">Belum Ada Jadwal Tahapan Seleksi</h3>
                    <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">
                        Klik tombol di bawah untuk mendaftarkan jadwal berkas, study case (2-3 hari), atau wawancara.
                    </p>
                    <button type="button" 
                            data-modal-open="jadwal-modal" 
                            class="mt-4 inline-flex items-center gap-2 rounded-xl bg-brand-blue px-4 py-2 text-xs font-semibold text-white shadow hover:bg-blue-800 transition">
                        + Daftarkan Jadwal Sekarang
                    </button>
                </div>
            @endif
        </section>
    </div>
</div>
@include('modals.form-jadwal')

@endsection
