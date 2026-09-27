@extends('layouts.app-admin')

@section('title', 'Admin | ILBBEC')

@section('content')
<div class="min-h-screen bg-slate-50">
        <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-10">
                <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between mb-8">
                        <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-brand-blue">Operations control center</p>
                                <h1 class="mt-2 text-3xl font-bold tracking-tight text-brand-navy">Dashboard administrasi</h1>
                                <p class="mt-2 text-sm text-slate-500">
                                        @php
                                                $role = auth()->user()?->Role ?? 'Admin';
                                        @endphp
                                        @if(in_array(strtolower($role), ['admin', 'pres']))
                                                Pantau seluruh proses rekrutmen ILBBEC dari satu ruang kerja.
                                        @else
                                                Menampilkan data pendaftaran divisi {{ $role }} saja.
                                        @endif
                                </p>
                        </div>
                </div>

                <section class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4" id="overview">
                        @foreach([
                                ['label' => 'User Register', 'value' => $metrics['candidates'], 'icon' => 'users', 'tone' => 'blue'],
                                ['label' => 'Total Pendaftaran', 'value' => $metrics['applications'], 'icon' => 'clipboard', 'tone' => 'orange'],
                                ['label' => 'Konfirmasi Status', 'value' => $metrics['study_cases'], 'icon' => 'document', 'tone' => 'emerald'],
                        ] as $metric)
                                <div class="rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-sm hover:shadow-md transition-shadow">
                                        <div class="flex items-start justify-between">
                                                <div>
                                                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">{{ $metric['label'] }}</p>
                                                        <p class="mt-2 text-2xl font-extrabold text-brand-navy">{{ $metric['value'] }}</p>
                                                </div>
                                                <span class="flex h-10 w-10 sm:h-12 sm:w-12 items-center justify-center rounded-2xl bg-{{ $metric['tone'] }}-50 text-{{ $metric['tone'] }}-600 shrink-0">
                                                        @if($metric['icon'] === 'users')
                                                                <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m8-10a4 4 0 100-8 4 4 0 000 8zm6 10v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                                                        @elseif($metric['icon'] === 'calendar')
                                                                <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 2v4m8-4v4M3 10h18M5 4h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z"/></svg>
                                                        @else
                                                                <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h16M4 18h10"/></svg>
                                                        @endif
                                                </span>
                                        </div>
                                </div>
                        @endforeach
                </section>

                <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-3">
                            <section id="applications" class="rounded-2xl border border-slate-200 bg-white p-4 sm:p-6 shadow-sm xl:col-span-2">
                                <div class="flex items-center justify-between mb-4 sm:mb-6">
                                        <div><h2 class="text-base sm:text-lg font-bold text-brand-navy">Pendaftaran terbaru</h2><p class="mt-0.5 text-xs text-slate-400">Aktivitas kandidat yang masuk terakhir.</p></div>
                                        <span class="rounded-full bg-brand-blue-50 px-3 py-1 text-xs font-semibold text-brand-blue">Live pipeline</span>
                                </div>
                                <p class="sm:hidden text-[11px] text-slate-400 mb-2 flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 animate-pulse text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                        Geser tabel ke kanan untuk melihat data lengkap
                                </p>
                                <div class="overflow-x-auto">
                                        <table class="w-full min-w-[620px] text-left text-sm">
                                                <thead class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400">
                                                    <tr>
                                                        <th class="pb-3 font-semibold">Kandidat</th>
                                                        <th class="pb-3 font-semibold">Divisi</th>
                                                        <th class="pb-3 font-semibold">Divisi 2</th>
                                                        <th class="pb-3 font-semibold">Berkas CV</th>
                                                        <th class="pb-3 font-semibold">Status Berkas</th>
                                                        <th class="pb-3 font-semibold">Status akhir</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y divide-slate-100">
                                                        @forelse($recentApplications as $application)
                                                                <tr>
                                                                        <td class="py-4">
                                                                                <p class="font-semibold text-brand-navy">{{ $application->user?->Nama ?? 'User tidak ditemukan' }}</p>
                                                                                <p class="text-xs text-slate-400">{{ $application->user?->Email ?? '-' }}</p>
                                                                        </td>
                                                                        <td class="py-4 text-slate-600">{{ $application->Divisi }}</td>
                                                                        <td class="py-4 text-slate-600">{{ $application->Divisi2 }}</td>
                                                                         <td class="py-4">
                                                                                <a href="{{ Storage::url($application->BerkasCV) }}" target="_blank" class="text-brand-blue hover:underline">Lihat Berkas</a>
                                                                        </td>
                                                                        <td class="py-4">
                                                                                <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-600">{{ $application->StatusBerkas }}</span>
                                                                        </td>
                                                                        <td class="py-4">
                                                                                <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700">{{ $application->StatusAkhir }}</span>
                                                                        </td>
                                                                </tr>
                                                        @empty
                                                                <tr><td colspan="5" class="py-10 text-center text-sm text-slate-400">Belum ada pendaftaran.</td></tr>
                                                        @endforelse
                                                </tbody>
                                        </table>
                                </div>
                        </section>

                            <section id="pipeline" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                                <h2 class="text-lg font-bold text-brand-navy">Ringkasan pipeline</h2>
                                <p class="mt-1 text-xs text-slate-400">Distribusi status seleksi kandidat.</p>
                                <div class="mt-7 space-y-5">
                                        @foreach($pipeline as $label => $value)
                                                @php $percentage = $metrics['applications'] > 0 ? min(100, round(($value / $metrics['applications']) * 100)) : 0; @endphp
                                                <div><div class="mb-2 flex justify-between text-sm"><span class="text-slate-600">{{ $label }}</span><strong class="text-brand-navy">{{ $value }}</strong></div><div class="h-2 overflow-hidden rounded-full bg-slate-100"><div class="h-full rounded-full bg-brand-blue transition-all" style="width: {{ $percentage }}%"></div></div></div>
                                        @endforeach
                                </div>
                                <div id="schedule" class="mt-8 border-t border-slate-100 pt-5"><p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Sesi berikutnya</p>@if($nextSession)<p class="mt-2 font-semibold text-brand-navy">{{ $nextSession->TanggalSesi }}</p><p class="mt-1 text-sm text-slate-500">{{ $nextSession->WaktuMulai }} · {{ $nextSession->Lokasi }}</p>@else<p class="mt-2 text-sm text-slate-400">Belum ada sesi aktif.</p>@endif</div>
                        </section>
                </div>
        </div>
</div>

@endsection