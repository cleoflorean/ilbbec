@extends('layouts.app-admin')

@section('title', 'Kelola Peserta | ILBBEC Admin')

@section('content')

<div class="min-h-screen bg-slate-50/60 pb-16">
    <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-10">

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

        <!-- ================= HEADER ================= -->
        <div class="mb-8 pb-6 border-b border-slate-200/70">
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-brand-navy">
                Kelola Peserta
            </h1>
            <p class="mt-1.5 text-sm text-slate-500">
                Kelola dan tinjau data calon anggota yang mengikuti proses seleksi.
            </p>
        </div>

        <!-- ================= CONTAINER ================= -->
        <section class="rounded-3xl border border-slate-200/80 bg-white p-5 sm:p-7 shadow-sm">

            <!-- HEADER SECTION -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 mb-6">
                <div>
                    <h2 class="text-lg font-bold text-brand-navy">
                        Daftar Kandidat Peserta
                    </h2>
                    <p class="text-xs text-slate-400 mt-1">
                        Data calon anggota yang terdaftar dalam sistem seleksi.
                    </p>
                </div>

                <!-- SEARCH & FILTER -->
                <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                    <!-- Search -->
                    <div class="relative w-full sm:w-64">
                        <input
                            type="text"
                            id="peserta-search"
                            placeholder="Cari nama atau NPM..."
                            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 pl-9 pr-4 py-2.5 text-xs text-slate-700 transition focus:border-brand-blue focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-100">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </span>
                    </div>

                    <!-- Filter Divisi -->
                  
                </div>
            </div>

            <!-- DESKTOP TABLE -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full text-left text-sm" id="table-peserta">
                    <thead class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400 bg-slate-50/60">
                        <tr>
                            <th class="py-3 px-4 font-semibold rounded-l-xl">No</th>
                            <th class="py-3 px-4 font-semibold">Kandidat</th>
                            <th class="py-3 px-4 font-semibold">Prodi</th>
                            <th class="py-3 px-4 font-semibold">Divisi</th>
                            <th class="py-3 px-4 font-semibold">Status Terkini</th>
                            <th class="py-3 px-4 font-semibold">Status Akhir</th>
                            <th class="py-3 px-4 font-semibold text-center rounded-r-xl">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse($pendaftaran as $index => $item)
                            <tr class="hover:bg-blue-50/30 transition-colors peserta-item"
                                data-name="{{ strtolower($item->user?->Nama ?? '') }}"
                                data-npm="{{ strtolower($item->user?->Npm ?? '') }}"
                                data-divisi="{{ $item->Divisi }}"
                                data-divisi2="{{ $item->Divisi2 }}"
                                data-detail-id="{{ $item->PendaftaranId }}"
                                data-tahap-aktif="{{ $item->tahapAktif ?? '' }}"
                                data-detail-name="{{ $item->user?->Nama ?? '-' }}"
                                data-detail-npm="{{ $item->user?->Npm ?? '-' }}"
                                data-detail-phone="{{ $item->user?->NoTlp ?? '' }}"
                                data-detail-prodi="{{ $item->user?->prodi?->NamaProdi ?? '-' }}"
                                data-detail-angkatan="{{ $item->user?->Angkatan ?? '-' }}"
                                data-detail-divisi="{{ $item->Divisi ?? '-' }}"
                                data-detail-divisi2="{{ $item->Divisi2 ?? '-' }}"
                                data-detail-status-terkini="{{ $item->statusTerkini ?? 'Seleksi Berkas' }}"
                                data-detail-status-akhir="{{ $item->StatusAkhir ?? 'Dalam Proses' }}"
                                data-status-berkas="{{ $item->StatusBerkas ?? '' }}"
                                data-status-case="{{ $item->study_case?->StatusKasus ?? $item->study_case?->StatusCase ?? '' }}"
                                data-status-wawancara="{{ $item->wawancara?->StatusWawancara ?? '' }}"
                                data-detail-date="{{ $item->created_at ? $item->created_at->format('d M Y, H:i') : '-' }}"
                                data-detail-cv="{{ $item->BerkasCV ? Storage::url($item->BerkasCV) : '' }}" >
                                <!-- No -->
                                <td class="py-4 px-4 text-xs font-semibold text-slate-400">{{ $index + 1 }}</td>
                                <!-- Kandidat -->
                                <td class="py-4 px-4">
                                    <p class="font-bold text-brand-navy">{{ $item->user?->Nama ?? 'Nama Belum Diisi' }}</p>
                                    <p class="text-xs text-slate-400 mt-0.5">NPM: {{ $item->user?->Npm ?? '-' }}</p>
                                </td>
                                <!-- Prodi -->
                                <td class="py-4 px-4">
                                    <p class="text-xs font-medium text-slate-700">{{ $item->user?->prodi?->NamaProdi ?? '-' }}</p>
                                </td>
                                <!-- DIVISI -->
                                <td class="py-4 px-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-blue-50 text-brand-blue border border-blue-100">{{ $item->Divisi }}</span>
                                </td>
                                <!-- STATUS TERKINI -->
                                <td class="py-4 px-4">
                                    @if($item->statusTerkini === 'Seleksi Berkas')
                                        <span class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2.5 py-1 text-xs font-semibold text-brand-blue border border-blue-200">
                                            <span class="h-1.5 w-1.5 rounded-full bg-brand-blue"></span>
                                            Seleksi Berkas
                                        </span>
                                    @elseif($item->statusTerkini === 'Study Case') 
                                        <span class="inline-flex items-center gap-1 rounded-full bg-purple-50 px-2.5 py-1 text-xs font-semibold text-purple-700 border border-purple-200">
                                            <span class="h-1.5 w-1.5 rounded-full bg-purple-500"></span>
                                            Study Case
                                        </span>
                                    @elseif($item->statusTerkini === 'Wawancara') 
                                        <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700 border border-amber-200">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                            Wawancara
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700 border border-emerald-200">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Menunggu Pengumuman
                                        </span>
                                    @endif
                                </td>
                                <!-- STATUS AKHIR -->
                                <td class="py-4 px-4">
                                    @if($item->StatusAkhir === 'Lolos')
                                        <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700">
                                            Lolos Seleksi
                                        </span>
                                    @elseif(in_array($item->StatusAkhir, ['Tidak Lolos', 'Gagal']))
                                        <span class="inline-flex items-center rounded-full bg-rose-50 px-2.5 py-1 text-xs font-bold text-rose-700">
                                            Tidak Lolos
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400 font-medium">
                                            {{ $item->StatusAkhir ?? 'Dalam Proses' }}
                                        </span>
                                    @endif
                                </td>
                                <!-- AKSI -->
                                <td class="py-4 px-4 text-center">
                                    <button data-modal-open="detail-peserta" type="button" class="btn-detail inline-flex items-center justify-center w-9 h-9 rounded-xl border border-slate-200 text-brand-blue hover:bg-blue-50 transition" title="Lihat detail peserta">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400">
                                    Belum ada kandidat peserta yang mendaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- MOBILE / TABLET CARD -->
            <div class="lg:hidden space-y-3">
                @forelse($pendaftaran as $index => $item)
                    <div class="peserta-item-mobile rounded-2xl border border-slate-200 bg-white p-4 hover:border-blue-200 hover:bg-blue-50/20 transition cursor-pointer"
                        data-name="{{ strtolower($item->user?->Nama ?? '') }}"
                        data-npm="{{ strtolower($item->user?->Npm ?? '') }}"
                        data-divisi="{{ $item->Divisi ?? '-' }}"
                        data-divisi2="{{ $item->Divisi2 ?? '-' }}"
                        data-detail-id="{{ $item->PendaftaranId }}"
                        data-tahap-aktif="{{ $item->tahapAktif ?? '' }}"
                        data-detail-name="{{ $item->user?->Nama ?? '-' }}"
                        data-detail-npm="{{ $item->user?->Npm ?? '-' }}"
                        data-detail-phone="{{ $item->user?->NoTlp ?? '' }}"
                        data-detail-prodi="{{ $item->user?->prodi?->NamaProdi ?? '-' }}"
                        data-detail-angkatan="{{ $item->user?->Angkatan ?? '-' }}"
                        data-detail-divisi2="{{ $item->Divisi2 ?? '-' }}"
                        data-detail-status-terkini="{{ $item->statusTerkini ?? 'Seleksi Berkas' }}"
                        data-detail-status-akhir="{{ $item->StatusAkhir ?? 'Dalam Proses' }}"
                        data-status-berkas="{{ $item->StatusBerkas ?? '' }}"
                        data-status-case="{{ $item->study_case?->StatusKasus ?? $item->study_case?->StatusCase ?? '' }}"
                        data-status-wawancara="{{ $item->wawancara?->StatusWawancara ?? '' }}"
                        data-detail-date="{{ $item->created_at ? $item->created_at->format('d M Y, H:i') : '-' }}"
                        data-detail-cv="{{ $item->BerkasCV ? Storage::url($item->BerkasCV) : '' }}">
                        <!-- TOP CARD -->
                        <div class="flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-10 h-10 shrink-0 rounded-full bg-blue-50 flex items-center justify-center text-brand-blue font-bold text-sm">
                                    {{ strtoupper(substr($item->user?->Nama ?? 'P', 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="font-bold text-brand-navy truncate">{{ $item->user?->Nama ?? 'Nama Belum Diisi' }}</p>
                                    <p class="text-[11px] text-slate-400">NPM: {{ $item->user?->Npm ?? '-' }}</p>
                                </div>
                            </div>

                            <!-- Arrow -->
                            <div class="w-8 h-8 shrink-0 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- DIVISI -->
                        <div class="mt-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-blue-50 text-brand-blue border border-blue-100">
                                {{ $item->Divisi ?? '-' }}
                            </span>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-blue-50 text-brand-blue border border-blue-100">
                                {{ $item->Divisi2 ?? '-' }}
                            </span>
                        </div>

                        <!-- INFO UTAMA -->
                        <div class="grid grid-cols-2 gap-3 mt-4 pt-3 border-t border-slate-100">
                            <div>
                                <p class="text-[10px] uppercase tracking-wide text-slate-400">Prodi</p>
                                <p class="text-xs font-medium text-slate-700 mt-1">{{ $item->user?->prodi?->NamaProdi ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase tracking-wide text-slate-400">Status Berkas</p>
                                <div class="mt-1">
                                    @if($item->StatusBerkas === 'Lolos')
                                        <span class="text-[11px] font-semibold text-emerald-600">● Lolos</span>
                                    @elseif(in_array($item->StatusBerkas, ['Gagal', 'Tidak Lolos']))
                                        <span class="text-[11px] font-semibold text-rose-600">● Tidak Lolos</span>
                                    @else
                                        <span class="text-[11px] font-semibold text-amber-600">● {{ $item->StatusBerkas ?? 'Menunggu' }}</span>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <p class="text-[10px] uppercase tracking-wide text-slate-400">Status Akhir</p>
                                <p class="text-xs font-medium mt-1">
                                    @if($item->StatusAkhir === 'Lolos')
                                        <span class="text-emerald-600 font-bold">Lolos Seleksi</span>
                                    @elseif(in_array($item->StatusAkhir, ['Tidak Lolos', 'Gagal']))
                                        <span class="text-rose-600 font-bold">Tidak Lolos</span>
                                    @else
                                        <span class="text-slate-400">{{ $item->StatusAkhir ?? 'Dalam Proses' }}</span>
                                    @endif
                                </p>
                            </div>

                            <div>
                                <p class="text-[10px] uppercase tracking-wide text-slate-400">Tanggal Daftar</p>
                                <p class="text-xs text-slate-600 mt-1">
                                    {{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-12 text-center text-slate-400 text-sm">
                        Belum ada kandidat peserta yang mendaftar.
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</div>

<!-- MODAL DETAIL -->
@include('modals.detail-peserta')

<!-- JAVASCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('peserta-search');
    const divisiFilter = document.getElementById('divisi-filter');
    const desktopItems = document.querySelectorAll('.peserta-item');
    const mobileItems = document.querySelectorAll('.peserta-item-mobile');

    // FILTER PESERTA
    function filterPeserta() {
        const query = searchInput.value.toLowerCase().trim();
        const divisi = divisiFilter.value;
        [...desktopItems, ...mobileItems].forEach(item => {
            const name = item.dataset.name || '';
            const npm = item.dataset.npm || '';
            const itemDivisi = item.dataset.divisi || '';
            const matchSearch = name.includes(query) || npm.includes(query);
            const matchDivisi = !divisi || itemDivisi === divisi;
            item.style.display = matchSearch && matchDivisi ? '' : 'none';
        });
    }
    searchInput?.addEventListener('input', filterPeserta);
    divisiFilter?.addEventListener('change', filterPeserta);
    
    // MODAL DETAIL ELEMENTS
    const modal = document.getElementById('detail-peserta');
    const modalName = document.getElementById('detail-name');
    const modalNpm = document.getElementById('detail-npm');
    const modalWhatsapp = document.getElementById('detail-whatsapp');
    const modalProdi = document.getElementById('detail-prodi');
    const modalAngkatan = document.getElementById('detail-angkatan');
    const modalDivisi = document.getElementById('detail-divisi');
    const modalDivisi2 = document.getElementById('detail-divisi2');
    const modalStatusTerkini = document.getElementById('detail-status-terkini');
    const modalStatusAkhir = document.getElementById('detail-status-akhir');
    const modalStatusBerkas = document.getElementById('detail-status-berkas');
    const modalStatusCase = document.getElementById('detail-status-case');
    const modalStatusWawancara = document.getElementById('detail-status-wawancara');
    const modalTanggal = document.getElementById('detail-tanggal');
    const modalCv = document.getElementById('detail-cv');

    // STATUS MODAL ELEMENTS
    const statusModal = document.getElementById('status-seleksi-modal');
    const statusPeserta = document.getElementById('status-seleksi-peserta');
    const statusTahap = document.getElementById('status-seleksi-tahap');
    const statusTahapInput = document.getElementById('status-seleksi-tahap-input');
    const statusForm = document.getElementById('status-seleksi-form');

    function formatStatus(status) {
        status = (status || '').toLowerCase().trim();
        if (status === 'lolos') {
            return 'Lolos';
        }
        if (status === 'tidak_lolos' || status === 'tidak lolos' || status === 'gagal') {
            return 'Tidak Lolos';
        }
        return 'Belum Diproses';
    }

    function openDetail(element) {
        window.currentPesertaId = element.dataset.detailId;
        window.currentPesertaNama = element.dataset.detailName;
        window.currentTahap = element.dataset.tahapAktif;

        modalName.textContent = element.dataset.detailName || '-';
        modalNpm.textContent = 'NPM: ' + (element.dataset.detailNpm || '-');

        const phone = (element.dataset.detailPhone || '').replace(/\D/g, '');
        if (phone) {
            const whatsappPhone = phone.startsWith('0') ? '62' + phone.slice(1) : phone;
            modalWhatsapp.textContent = element.dataset.detailPhone;
            modalWhatsapp.href = `https://wa.me/${whatsappPhone}?=text=Halo`;
            modalWhatsapp.classList.remove('hidden');
        } else {
            modalWhatsapp.classList.add('hidden');
        }

        modalProdi.textContent = element.dataset.detailProdi || '-';
        modalAngkatan.textContent = element.dataset.detailAngkatan || '-';
        modalDivisi.textContent = element.dataset.detailDivisi || '-';
        modalDivisi2.textContent = element.dataset.detailDivisi2 || '-';
        modalStatusTerkini.textContent = element.dataset.detailStatusTerkini || 'Seleksi Berkas';
        modalStatusAkhir.textContent = element.dataset.detailStatusAkhir || 'Dalam Proses';
        
        const statusBerkas = element.dataset.statusBerkas || '';
        const statusCase = element.dataset.statusCase || '';
        const statusWawancara = element.dataset.statusWawancara || '';

        modalStatusBerkas.textContent = formatStatus(statusBerkas);
        modalStatusCase.textContent = formatStatus(statusCase);
        modalStatusWawancara.textContent = formatStatus(statusWawancara);
        modalTanggal.textContent = element.dataset.detailDate || '-';

        // CV
        if (element.dataset.detailCv) {
            modalCv.href = element.dataset.detailCv;
            modalCv.classList.remove('hidden');
        } else {
            modalCv.classList.add('hidden');
        }
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
    
    function openStatusModal() {
        const pesertaId = window.currentPesertaId;
        const tahap = window.currentTahap;
        const nama = window.currentPesertaNama;
        if (!pesertaId || !tahap) {
            alert('Tahapan seleksi untuk peserta ini sudah selesai atau belum ditentukan.');
            return;
        }
        statusPeserta.textContent = nama || '-';
        let namaTahap = '-';
        if (tahap === 'berkas') {
            namaTahap = 'Seleksi Berkas';
        } else if (tahap === 'study_case') {
            namaTahap = 'Study Case';
        } else if (tahap === 'wawancara') {
            namaTahap = 'Wawancara';
        }
        statusTahap.textContent = namaTahap;
        statusTahapInput.value = tahap;
        statusForm.action = `/admin/peserta/${pesertaId}/status`;
        
        statusModal.classList.remove('hidden');
        statusModal.classList.add('flex');
    }

    function closeDetail() {
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    function closeStatusModal() {
        statusModal.classList.add('hidden');
        statusModal.classList.remove('flex');
    }

    // DESKTOP BUTTON
    document.querySelectorAll('.btn-detail').forEach(button => {
        button.addEventListener('click', (event) => {
            event.stopPropagation();
            const item = button.closest('.peserta-item');
            openDetail(item);
        });
    });

    // MOBILE CARD
    document.querySelectorAll('.peserta-item-mobile').forEach(card => {
        card.addEventListener('click', () => {
            openDetail(card);
        });
    });

    // STATUS MODAL TRIGGERS
    document.getElementById('open-status-modal')?.addEventListener('click', openStatusModal);
    document.getElementById('close-status-modal')?.addEventListener('click', closeStatusModal);
    document.getElementById('cancel-status-modal')?.addEventListener('click', closeStatusModal);

    // CLOSE DETAIL MODAL
    document.getElementById('close-detail-modal')?.addEventListener('click', closeDetail);
    document.getElementById('close-detail-button')?.addEventListener('click', closeDetail);

    // CLICK BACKDROP
    modal?.addEventListener('click', (event) => {
        if (event.target === modal) {
            closeDetail();
        }
    });

    statusModal?.addEventListener('click', (event) => {
        if (event.target === statusModal) {
            closeStatusModal();
        }
    });

    // ESC KEY
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            if (!statusModal.classList.contains('hidden')) {
                closeStatusModal();
            } else if (!modal.classList.contains('hidden')) {
                closeDetail();
            }
        }
    });
});
</script>

@endsection