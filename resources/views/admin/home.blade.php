@extends('layouts.app-admin')

@section('title', 'Admin ERP | ILBBEC')

@section('content')
<div class="min-h-screen bg-slate-50">
        <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-10">
                <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between mb-8">
                        <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-brand-blue">Operations control center</p>
                                <h1 class="mt-2 text-3xl font-bold tracking-tight text-brand-navy">Dashboard administrasi</h1>
                                <p class="mt-2 text-sm text-slate-500">Pantau seluruh proses rekrutmen ILBBEC dari satu ruang kerja.</p>
                        </div>
                </div>

                <section class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4" id="overview">
                        @foreach([
                                ['label' => 'Kandidat aktif', 'value' => $metrics['candidates'], 'icon' => 'users', 'tone' => 'blue'],
                                ['label' => 'Total pendaftaran', 'value' => $metrics['applications'], 'icon' => 'clipboard', 'tone' => 'orange'],
                                ['label' => 'Study case', 'value' => $metrics['study_cases'], 'icon' => 'document', 'tone' => 'emerald'],
                                ['label' => 'Sesi wawancara', 'value' => $metrics['interviews'], 'icon' => 'calendar', 'tone' => 'violet'],
                        ] as $metric)
                                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                                        <div class="flex items-start justify-between">
                                                <p class="text-sm font-medium text-slate-500">{{ $metric['label'] }}</p>
                                                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-{{ $metric['tone'] }}-50 text-{{ $metric['tone'] }}-600">
                                                        @if($metric['icon'] === 'users')
                                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m8-10a4 4 0 100-8 4 4 0 000 8zm6 10v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                                                        @elseif($metric['icon'] === 'calendar')
                                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 2v4m8-4v4M3 10h18M5 4h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z"/></svg>
                                                        @else
                                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h16M4 18h10"/></svg>
                                                        @endif
                                                </span>
                                        </div>
                                        <p class="mt-4 text-3xl font-bold text-brand-navy">{{ number_format($metric['value']) }}</p>
                                        <p class="mt-1 text-xs text-slate-400">Data tersinkronisasi dari sistem</p>
                                </div>
                        @endforeach
                </section>

                <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-3">
                            <section id="applications" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm xl:col-span-2">
                                <div class="flex items-center justify-between mb-6">
                                        <div><h2 class="text-lg font-bold text-brand-navy">Pendaftaran terbaru</h2><p class="mt-1 text-xs text-slate-400">Aktivitas kandidat yang masuk terakhir.</p></div>
                                        <span class="rounded-full bg-brand-blue-50 px-3 py-1 text-xs font-semibold text-brand-blue">Live pipeline</span>
                                </div>
                                <div class="overflow-x-auto">
                                        <table class="w-full min-w-[620px] text-left text-sm">
                                                <thead class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400">
                                                    <tr>
                                                        <th class="pb-3 font-semibold">Kandidat</th>
                                                        <th class="pb-3 font-semibold">Divisi</th>
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
                                                                <tr><td colspan="4" class="py-10 text-center text-sm text-slate-400">Belum ada pendaftaran.</td></tr>
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