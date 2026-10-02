@extends('layouts.app-admin')

@section('title', 'Kelola Jadwal Seleksi | ILBBEC Admin')

@section('content')
<div class="min-h-screen bg-slate-50/60 pb-16">
    <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">

        <!-- Flash Alert Messages -->
        @if (session('success'))
            <div class="mb-6 flex items-center justify-between rounded-2xl border border-emerald-200 bg-emerald-50/90 px-5 py-4 text-sm text-emerald-800 shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5 shrink-0 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 font-bold text-lg">
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
                <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700 font-bold text-lg">
                    &times;
                </button>
            </div>
        @endif

        <!-- Header -->
        <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between mb-8 pb-6 border-b border-slate-200/70">
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-brand-navy">
                    Kelola Jadwal Seleksi
                </h1>
                <p class="mt-1.5 text-sm text-slate-500">
                    Sediakan pilihan tanggal & waktu seleksi bagi calon anggota. Sistem memungkinkan banyak pendaftar memilih jadwal yang sama.
                </p>
            </div>

            <!-- Tombol Trigger Modal Tambah Jadwal -->
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <button type="button" 
                    data-modal-open="jadwal-modal" 
                    class="w-full sm:w-auto justify-center inline-flex items-center gap-2.5 rounded-xl bg-brand-blue px-5 py-3 text-sm font-semibold text-white shadow-md shadow-blue-700/20 hover:bg-blue-800 transition-all transform hover:-translate-y-0.5">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    + Tambah Jadwal Seleksi
                </button>
            </div>
        </div>

        <!-- Jadwal Tahapan Seleksi Grid -->
        <section class="rounded-3xl border border-slate-200/80 bg-white p-6 sm:p-7 shadow-sm mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-lg font-bold text-brand-navy flex items-center gap-2.5">
                        <svg class="h-5 w-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Daftar Jadwal yang Disediakan
                    </h2>
                    <p class="text-xs text-slate-400 mt-0.5">Semua slot jadwal yang dapat dipilih peserta sesuai ketersediaan mereka.</p>
                </div>
            </div>

            @if(isset($jadwalSesi) && $jadwalSesi->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($jadwalSesi as $sesi)
                        @php
                            $status = $sesi->status ?? ($sesi->IsActive ? 'available' : 'closed');
                            $pesertaList = $sesi->jadwal_pendaftar->map(function($jp) {
                                return [
                                    'nama' => $jp->pendaftaran?->user?->Nama ?? 'Peserta',
                                    'npm' => $jp->pendaftaran?->user?->Npm ?? '-',
                                    'prodi' => $jp->pendaftaran?->user?->prodi?->NamaProdi ?? '-',
                                    'divisi' => $jp->pendaftaran?->Divisi ?? '-',
                                    'divisi2' => $jp->pendaftaran?->Divisi2 ?? '-',
                                    'selected_at' => $jp->selected_at ? $jp->selected_at->format('d M Y, H:i') : ($jp->created_at ? $jp->created_at->format('d M Y, H:i') : '-'),
                                    'status' => $jp->status ?? 'dipilih'
                                ];
                            });
                        @endphp
                        <div class="rounded-2xl border border-slate-200 bg-white p-5 flex flex-col justify-between hover:border-blue-300 hover:shadow-md transition-all duration-200">
                            <div>
                                <!-- Header Card: Tahap & Status Badge -->
                                <div class="flex items-start justify-between gap-2 mb-3">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold
                                        {{ str_contains($sesi->NamaSesi, 'Berkas') ? 'bg-amber-50 text-amber-700 border border-amber-200' : 
                                        (str_contains($sesi->NamaSesi, 'Study') ? 'bg-blue-50 text-brand-blue border border-blue-200' : 'bg-purple-50 text-purple-700 border border-purple-200') }}">
                                        {{ $sesi->NamaSesi }}
                                    </span>
                                    
                                    @if($status === 'available')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Available
                                        </span>
                                    @elseif($status === 'closed')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200">
                                            <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                            Closed
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                            <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                                            Cancelled
                                        </span>
                                    @endif
                                </div>

                                <!-- Waktu & Lokasi Detail -->
                                <div class="space-y-2 text-sm text-slate-700 my-4 bg-slate-50/70 p-3.5 rounded-xl border border-slate-100">
                                    <div class="flex items-center gap-2.5">
                                        <svg class="h-4 w-4 text-brand-blue shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="font-semibold text-brand-navy">
                                            {{ \Carbon\Carbon::parse($sesi->TanggalMulai ?? $sesi->TanggalSesi)->format('d F Y') }}
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-2.5">
                                        <svg class="h-4 w-4 text-brand-blue shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="font-medium text-slate-600">
                                            {{ \Carbon\Carbon::parse($sesi->Jam ?? $sesi->WaktuMulai)->format('H:i') }} WIB
                                        </span>
                                    </div>
                                    @if(!empty($sesi->Lokasi))
                                        <div class="flex items-center gap-2.5">
                                            <svg class="h-4 w-4 text-brand-blue shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span class="font-medium text-slate-700">{{ $sesi->Lokasi }}</span>
                                        </div>
                                    @endif
                                    @if(!empty($sesi->keterangan))
                                        <div class="text-xs text-slate-500 pt-1 border-t border-slate-200/60 flex items-start gap-2">
                                            <span class="font-bold text-slate-400">Info:</span>
                                            <span>{{ $sesi->keterangan }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Card Footer: Info Peserta & Aksi -->
                            <div class="pt-3 border-t border-slate-100 flex flex-col gap-3">
                                <!-- Info Jumlah Peserta Terdaftar -->
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-slate-500">Pendaftar Memilih:</span>
                                    <button type="button" 
                                            class="btn-lihat-peserta inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-bold bg-blue-50 text-brand-blue hover:bg-blue-100 transition"
                                            data-sesi-title="{{ $sesi->NamaSesi }} - {{ \Carbon\Carbon::parse($sesi->TanggalMulai)->format('d M Y') }} ({{ \Carbon\Carbon::parse($sesi->Jam)->format('H:i') }} WIB)"
                                            data-peserta='@json($pesertaList)'>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        {{ $sesi->jadwal_pendaftar_count ?? $sesi->jadwal_pendaftar->count() }} Peserta
                                    </button>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex items-center justify-between gap-2">
                                    <!-- Dropdown Toggle Status -->
                                    <form action="{{ route('admin.jadwal.status', $sesi->SesiId) }}" method="POST" class="inline-flex">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" class="text-xs font-semibold rounded-lg border border-slate-200 bg-white px-2.5 py-1.5 text-slate-700 hover:border-brand-blue focus:outline-none focus:ring-2 focus:ring-blue-100">
                                            <option value="available" {{ $status === 'available' ? 'selected' : '' }}>Tersedia</option>
                                            <option value="closed" {{ $status === 'closed' ? 'selected' : '' }}>Tutup</option>
                                            <option value="cancelled" {{ $status === 'cancelled' ? 'selected' : '' }}>Batalkan</option>
                                        </select>
                                    </form>

                                    <div class="flex items-center gap-1.5">
                                        <!-- Edit Jadwal -->
                                        <button type="button" 
                                                class="btn-edit-jadwal p-1.5 rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-50 hover:text-brand-blue transition"
                                                title="Edit Jadwal"
                                                data-sesi-id="{{ $sesi->SesiId }}"
                                                data-sesi-nama="{{ $sesi->NamaSesi }}"
                                                data-sesi-tanggal="{{ \Carbon\Carbon::parse($sesi->TanggalMulai)->format('Y-m-d') }}"
                                                data-sesi-jam="{{ \Carbon\Carbon::parse($sesi->Jam)->format('H:i') }}"
                                                data-sesi-lokasi="{{ $sesi->Lokasi }}"
                                                data-sesi-keterangan="{{ $sesi->keterangan }}"
                                                data-sesi-status="{{ $status }}">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>

                                        <!-- Hapus Jadwal -->
                                        <form action="{{ route('admin.jadwal.destroy', $sesi->SesiId) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 rounded-lg border border-slate-200 text-slate-400 hover:bg-rose-50 hover:text-rose-600 transition" title="Hapus Jadwal">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
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
                        Klik tombol di bawah untuk mendaftarkan jadwal Study Case atau Wawancara.
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

<!-- ================= MODAL EDIT JADWAL ================= -->
<div id="edit-jadwal-modal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-slate-950/60 backdrop-blur-sm p-3 sm:p-4 overflow-y-auto">
    <div class="w-full max-w-lg rounded-3xl bg-white shadow-2xl border border-slate-100 overflow-hidden">
        <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4 bg-slate-50/60">
            <h3 class="text-base font-bold text-brand-navy">Edit Jadwal Seleksi</h3>
            <button type="button" id="close-edit-jadwal-modal" class="rounded-xl p-1.5 text-slate-400 hover:bg-slate-100">✕</button>
        </div>
        <form id="edit-jadwal-form" method="POST" class="p-5 space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Tahapan Seleksi</label>
                <input type="text" id="edit-sesi-nama" name="NamaSesi" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm font-medium text-slate-800" required>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Tanggal</label>
                    <input type="date" id="edit-sesi-tanggal" name="TanggalMulai" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm font-medium text-slate-800" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Jam Mulai</label>
                    <input type="time" id="edit-sesi-jam" name="Jam" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm font-medium text-slate-800" required>
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Lokasi / Ruangan</label>
                <input type="text" id="edit-sesi-lokasi" name="Lokasi" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm font-medium text-slate-800">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Keterangan</label>
                <input type="text" id="edit-sesi-keterangan" name="keterangan" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm font-medium text-slate-800">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Status Ketersediaan</label>
                <select id="edit-sesi-status" name="status" class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm font-medium text-slate-800">
                    <option value="available">Tersedia (Available)</option>
                    <option value="closed">Ditutup (Closed)</option>
                    <option value="cancelled">Dibatalkan (Cancelled)</option>
                </select>
            </div>
            <div class="flex justify-end gap-2 pt-3 border-t border-slate-100">
                <button type="button" id="cancel-edit-jadwal-modal" class="px-4 py-2 text-xs font-semibold text-slate-600 rounded-xl border border-slate-200 hover:bg-slate-50">Batal</button>
                <button type="submit" class="px-5 py-2 text-xs font-semibold text-white bg-brand-blue rounded-xl hover:bg-blue-800">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<!-- ================= MODAL LIHAT PESERTA (pop up) ================= -->
<div id="peserta-jadwal-modal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-slate-950/60 backdrop-blur-sm p-3 sm:p-4 overflow-y-auto">
    <div class="w-full max-w-2xl max-h-[90vh] flex flex-col rounded-3xl bg-white shadow-2xl border border-slate-100 overflow-hidden">
        <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4 bg-slate-50/80">
            <div>
                <h3 class="text-base font-bold text-brand-navy">Daftar Peserta Memilih Jadwal</h3>
                <p id="peserta-modal-subtitle" class="text-xs text-slate-500 mt-0.5">-</p>
            </div>
            <button type="button" id="close-peserta-modal" class="rounded-xl p-1.5 text-slate-400 hover:bg-slate-100">✕</button>
        </div>
        <div class="p-5 overflow-y-auto flex-1">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="border-b border-slate-200 bg-slate-50 text-slate-500 uppercase tracking-wider text-[10px]">
                        <tr>
                            <th class="py-2.5 px-3 rounded-l-lg">No</th>
                            <th class="py-2.5 px-3">Nama & NPM</th>
                            <th class="py-2.5 px-3">Prodi</th>
                            <th class="py-2.5 px-3">Divisi</th>
                            <th class="py-2.5 px-3">Divisi 2</th>
                            <th class="py-2.5 px-3 rounded-r-lg">Waktu Memilih</th>
                        </tr>
                    </thead>
                    <tbody id="peserta-modal-tbody" class="divide-y divide-slate-100">
                        <!-- Populated by JS -->
                    </tbody>
                </table>
            </div>
            <div id="peserta-modal-empty" class="hidden py-8 text-center text-xs text-slate-400">
                Belum ada peserta yang memilih jadwal ini.
            </div>
        </div>
        <div class="p-4 border-t border-slate-100 bg-slate-50/50 flex items-center justify-between gap-3">
            <button type="button" id="btn-export-excel-peserta"
                class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-xl hover:bg-emerald-100 transition disabled:opacity-40 disabled:cursor-not-allowed"
                title="Export daftar peserta ke file Excel">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Export Excel
            </button>
            <button type="button" id="btn-close-peserta-modal-bottom" class="px-5 py-2 text-xs font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50">Tutup</button>
        </div>
    </div>
</div>

@include('modals.form-jadwal')

<!-- SheetJS CDN untuk Export Excel -->
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // ── Edit Jadwal Modal ──────────────────────────────────────────────────
    const editModal = document.getElementById('edit-jadwal-modal');
    const editForm = document.getElementById('edit-jadwal-form');
    const editNama = document.getElementById('edit-sesi-nama');
    const editTanggal = document.getElementById('edit-sesi-tanggal');
    const editJam = document.getElementById('edit-sesi-jam');
    const editLokasi = document.getElementById('edit-sesi-lokasi');
    const editKeterangan = document.getElementById('edit-sesi-keterangan');
    const editStatus = document.getElementById('edit-sesi-status');

    document.querySelectorAll('.btn-edit-jadwal').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.sesiId;
            editForm.action = `/admin/jadwal/${id}`;
            editNama.value = btn.dataset.sesiNama || '';
            editTanggal.value = btn.dataset.sesiTanggal || '';
            editJam.value = btn.dataset.sesiJam || '';
            editLokasi.value = btn.dataset.sesiLokasi || '';
            editKeterangan.value = btn.dataset.sesiKeterangan || '';
            editStatus.value = btn.dataset.sesiStatus || 'available';

            editModal.classList.remove('hidden');
            editModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        });
    });

    const closeEdit = () => {
        editModal.classList.add('hidden');
        editModal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    };

    document.getElementById('close-edit-jadwal-modal')?.addEventListener('click', closeEdit);
    document.getElementById('cancel-edit-jadwal-modal')?.addEventListener('click', closeEdit);

    // ── Lihat Peserta Modal ────────────────────────────────────────────────
    const pesertaModal = document.getElementById('peserta-jadwal-modal');
    const subtitle = document.getElementById('peserta-modal-subtitle');
    const tbody = document.getElementById('peserta-modal-tbody');
    const emptyState = document.getElementById('peserta-modal-empty');
    const btnExport = document.getElementById('btn-export-excel-peserta');

    // Simpan data peserta aktif untuk keperluan export
    let currentPesertaData = [];
    let currentSesiTitle = '';

    document.querySelectorAll('.btn-lihat-peserta').forEach(btn => {
        btn.addEventListener('click', () => {
            currentSesiTitle = btn.dataset.sesiTitle || 'Peserta Jadwal';
            subtitle.textContent = currentSesiTitle;
            currentPesertaData = JSON.parse(btn.dataset.peserta || '[]');
            tbody.innerHTML = '';

            if (currentPesertaData.length === 0) {
                emptyState.classList.remove('hidden');
                if (btnExport) btnExport.disabled = true;
            } else {
                emptyState.classList.add('hidden');
                if (btnExport) btnExport.disabled = false;
                currentPesertaData.forEach((item, index) => {
                    const row = document.createElement('tr');
                    row.className = 'hover:bg-blue-50/30 transition';
                    row.innerHTML = `
                        <td class="py-3 px-3 text-slate-400 font-semibold">${index + 1}</td>
                        <td class="py-3 px-3">
                            <p class="font-bold text-brand-navy">${item.nama}</p>
                            <p class="text-[11px] text-slate-400">NPM: ${item.npm}</p>
                        </td>
                        <td class="py-3 px-3 text-slate-700">${item.prodi}</td>
                        <td class="py-3 px-3">
                            <span class="inline-flex px-2 py-0.5 rounded text-[11px] font-semibold bg-blue-50 text-brand-blue border border-blue-100">${item.divisi}</span>
                                
                        </td>
                        <td class="py-3 px-3">
                            <span class="inline-flex px-2 py-0.5 rounded text-[11px] font-semibold bg-blue-50 text-brand-blue border border-blue-100">${item.divisi2}</span>
                                
                        </td>
                        <td class="py-3 px-3 text-slate-500">${item.selected_at}</td>
                    `;
                    tbody.appendChild(row);
                });
            }

            pesertaModal.classList.remove('hidden');
            pesertaModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        });
    });

    const closePeserta = () => {
        pesertaModal.classList.add('hidden');
        pesertaModal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    };

    document.getElementById('close-peserta-modal')?.addEventListener('click', closePeserta);
    document.getElementById('btn-close-peserta-modal-bottom')?.addEventListener('click', closePeserta);

    // ── Export Excel ───────────────────────────────────────────────────────
    if (btnExport) {
        btnExport.addEventListener('click', () => {
            if (!currentPesertaData || currentPesertaData.length === 0) return;

            // Bangun data array untuk SheetJS
            const header = ['No', 'Nama', 'NPM', 'Program Studi', 'Divisi 1', 'Divisi 2', 'Waktu Memilih'];
            const rows = currentPesertaData.map((item, i) => [
                i + 1,
                item.nama,
                item.npm,
                item.prodi,
                item.divisi,
                item.divisi2,
                item.selected_at,
            ]);

            const worksheetData = [header, ...rows];
            const ws = XLSX.utils.aoa_to_sheet(worksheetData);

            // Style lebar kolom agar rapi
            ws['!cols'] = [
                { wch: 5 },   // No
                { wch: 30 },  // Nama
                { wch: 14 },  // NPM
                { wch: 28 },  // Prodi
                { wch: 22 },  // Divisi 1
                { wch: 22 },  // Divisi 2
                { wch: 22 },  // Waktu
            ];

            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Peserta Jadwal');

            // Nama file: sanitasi judul sesi
            const safeTitle = currentSesiTitle.replace(/[^a-zA-Z0-9\s\-_]/g, '').trim().replace(/\s+/g, '_');
            const filename = `Peserta_${safeTitle || 'Jadwal'}_${new Date().toISOString().slice(0, 10)}.xlsx`;

            XLSX.writeFile(wb, filename);
        });
    }


    // ESC to close any modal
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeEdit();
            closePeserta();
        }
    });
});
</script>
@endsection
