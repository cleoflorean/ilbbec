<!-- MODAL DETAIL PESERTA -->
<div id="detail-peserta" class="hidden fixed inset-0 z-50 bg-slate-900/40 backdrop-blur-sm flex items-end sm:items-center justify-center p-0 sm:p-6" role="dialog" aria-modal="true">
    <div class="relative w-full sm:max-w-xl max-h-[92vh] overflow-y-auto bg-white rounded-t-3xl sm:rounded-3xl shadow-2xl">

        <!--  HEADER  -->
        <div class="sticky top-0 z-10 bg-white border-b border-slate-100 px-5 sm:px-6 py-4 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-brand-navy">Detail Peserta</h2>
                <p class="text-xs text-slate-400 mt-0.5">Informasi lengkap calon anggota</p>
            </div>

            <!-- Close -->
            <button
                type="button"
                id="close-detail-modal"
                class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-50 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!--  CONTENT  -->
        <div class="p-5 sm:p-6 space-y-5">
            <!--  PROFILE  -->
            <div class="flex items-center gap-4">
                <div class="min-w-0">
                    <h3 id="detail-name" class="font-bold text-brand-navy text-base">-</h3>
                    <p id="detail-npm" class="text-xs text-slate-400 mt-1">NPM: -</p>
                    <p  class="text-xs text-slate-400 mt-1"> 
                        Chat WhatsApp :</p>
                    <a href="#" id="detail-whatsapp" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 text-xs font-medium text-brand-blue hover:text-brand-blue/80">
                       
                    </a>
                </div>
            </div>

            <!--  INFORMASI AKADEMIK  -->
            <div class="rounded-2xl border border-slate-200 overflow-hidden">
                <div class="px-4 py-3 bg-slate-50/70 border-b border-slate-100">
                    <h3 class="text-sm font-bold text-brand-navy">Informasi Akademik</h3>
                </div>
                <div class="p-4 space-y-3">
                    <div class="flex justify-between gap-4">
                        <span class="text-xs text-slate-400">Program Studi</span>
                        <span id="detail-prodi" class="text-xs font-medium text-slate-700 text-right">-</span>
                    </div>
                    <div class="flex justify-between gap-4">
                        <span class="text-xs text-slate-400">Angkatan</span>
                        <span id="detail-angkatan" class="text-xs font-medium text-slate-700">-</span>
                    </div>
                </div>
            </div>

            <!--  INFORMASI PENDAFTARAN  -->
            <div class="rounded-2xl border border-slate-200 overflow-hidden">
                <div class="px-4 py-3 bg-slate-50/70 border-b border-slate-100">
                    <h3 class="text-sm font-bold text-brand-navy">Informasi Pendaftaran</h3>
                </div>
                <div class="p-4 space-y-4">
                    <!-- Divisi -->
                    <div>
                        <p class="text-[11px] text-slate-400 mb-1">Divisi Pilihan</p>
                        <span id="detail-divisi" class="inline-flex px-2.5 py-1 rounded-lg bg-blue-50 border border-blue-100 text-xs font-semibold text-brand-blue">-</span>
                        <span id="detail-divisi2" class="inline-flex px-2.5 py-1 rounded-lg bg-blue-50 border border-blue-100 text-xs font-semibold text-brand-blue">-</span>
                    </div>
                    <!-- Tanggal -->
                    <div>
                        <p class="text-[11px] text-slate-400 mb-1">Tanggal Pendaftaran</p>
                        <p id="detail-tanggal" class="text-xs font-medium text-slate-700">-</p>
                    </div>
                </div>
            </div>

            <!-- INFORMASI STATUS & TAHAPAN -->
            <div class="rounded-2xl border border-slate-200 overflow-hidden">
                <div class="px-4 py-3 bg-slate-50/70 border-b border-slate-100">
                    <h3 class="text-sm font-bold text-brand-navy">
                        Informasi Status & Tahapan
                    </h3>
                </div>
                <div class="p-4 space-y-4">

                    <!-- Status Terkini -->
                    <div>
                        <p class="text-[11px] text-slate-400 mb-1">
                            Tahap Aktif Saat Ini
                        </p>
                        <span
                            id="detail-status-terkini"
                            class="inline-flex px-2.5 py-1 rounded-full bg-blue-50 text-xs font-semibold text-brand-blue border border-blue-100"
                        >
                            Seleksi Berkas
                        </span>
                    </div>

                    <!-- PROGRESS TAHAPAN -->
                    <div class="pt-2">
                        <p class="text-[11px] text-slate-400 mb-2">Riwayat Tahapan Seleksi</p>
                        <div class="space-y-2">
                            <!-- Berkas -->
                            <div class="flex items-center justify-between rounded-xl bg-slate-50 px-3 py-2.5">
                                <div class="flex items-center gap-2.5">
                                    <span class="w-7 h-7 rounded-full bg-blue-100/70 flex items-center justify-center text-brand-blue font-bold text-xs">
                                        1
                                    </span>
                                    <span class="text-xs font-medium text-slate-700">Seleksi Berkas</span>
                                </div>
                                <span id='detail-status-berkas' class="text-[11px] font-semibold text-slate-500">Belum diproses</span>
                            </div>

                            <!-- Study Case -->
                            <div class="flex items-center justify-between rounded-xl bg-slate-50 px-3 py-2.5">
                                <div class="flex items-center gap-2.5">
                                    <span class="w-7 h-7 rounded-full bg-blue-100/70 flex items-center justify-center text-brand-blue font-bold text-xs">
                                        2
                                    </span>
                                    <span class="text-xs font-medium text-slate-700">Study Case</span>
                                </div>
                                <span id='detail-status-case' class="text-[11px] font-semibold text-slate-500">Belum diproses</span>
                            </div>

                            <!-- Wawancara -->
                            <div class="flex items-center justify-between rounded-xl bg-slate-50 px-3 py-2.5">
                                <div class="flex items-center gap-2.5">
                                    <span class="w-7 h-7 rounded-full bg-blue-100/70 flex items-center justify-center text-brand-blue font-bold text-xs">
                                        3
                                    </span>
                                    <span class="text-xs font-medium text-slate-700">Wawancara</span>
                                </div>
                                <span id='detail-status-wawancara' class="text-[11px] font-semibold text-slate-500">Belum diproses</span>
                            </div>
                        </div>
                    </div>

                    <!-- Status Akhir -->
                    <div class="pt-2 border-t border-slate-100">
                        <p class="text-[11px] text-slate-400 mb-1">Status Akhir Pendaftaran</p>
                        <span id="detail-status-akhir" class="text-xs font-semibold text-slate-600">Dalam Proses</span>
                    </div>

                    <!-- TOMBOL AKSI KELOLA STATUS -->
                    <button
                        type="button"
                        id="open-status-modal"
                        class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-brand-blue px-4 py-2.5 text-xs font-semibold text-white hover:bg-blue-800 transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" />
                        </svg>
                        Kelola Status Seleksi Tahap Ini
                    </button>
                </div>
            </div>

            <!--  CV  -->
            <div class="rounded-2xl border border-slate-200 p-4">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-bold text-brand-navy">Dokumen CV</p>
                        <p class="text-[11px] text-slate-400 mt-1">Dokumen yang diunggah oleh peserta.</p>
                    </div>
                    <a id="detail-cv" href="#" target="_blank" class="inline-flex items-center gap-2 rounded-xl bg-blue-50 border border-blue-100 px-3 py-2 text-xs font-semibold text-brand-blue hover:bg-blue-100 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Lihat CV
                    </a>
                </div>
            </div>
        </div>

        <!--  FOOTER  -->
        <div class="sticky bottom-0 bg-white border-t border-slate-100 px-5 sm:px-6 py-4">
            <button type="button" id="close-detail-button" class="w-full rounded-xl bg-brand-blue hover:bg-blue-800 text-white py-2.5 text-sm font-semibold transition">Tutup</button>
        </div>
    </div>
</div>

<!-- MODAL KELOLA STATUS SELEKSI -->
<div id="status-seleksi-modal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm px-4">
    <div class="w-full max-w-md rounded-2xl bg-white shadow-2xl overflow-hidden border border-slate-100">
        <!-- Header -->
        <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4 bg-slate-50/70">
            <div>
                <h3 class="text-sm font-bold text-brand-navy">Kelola Status Seleksi</h3>
                <p id="status-seleksi-peserta" class="mt-0.5 text-xs text-slate-400">-</p>
            </div>
            <button type="button" id="close-status-modal" class="flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-50">
                ✕
            </button>
        </div>

        <!-- Isi -->
        <div class="p-5">
            <p class="mb-2 text-xs text-slate-500">Pilih hasil penilaian untuk tahap:</p>
            <div id="status-seleksi-tahap" class="mb-4 rounded-xl bg-blue-50/70 border border-blue-100 px-4 py-3 text-sm font-bold text-brand-navy">-</div>

            <!-- Form -->
            <form id="status-seleksi-form" method="POST">
                @csrf
                <!-- Tahap dikirim ke Controller -->
                <input type="hidden" name="tahap" id="status-seleksi-tahap-input">
                <div class="space-y-3">
                    <!-- Lolos -->
                    <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-slate-200 p-3 hover:bg-emerald-50/50 hover:border-emerald-200 transition">
                        <input type="radio" name="hasil" value="lolos" class="h-4 w-4 text-emerald-600 focus:ring-emerald-500" required>
                        <div>
                            <p class="text-sm font-semibold text-emerald-600">Lolos</p>
                            <p class="text-[11px] text-slate-400">Peserta dapat melanjutkan ke tahap berikutnya.</p>
                        </div>
                    </label>

                    <!-- Tidak Lolos -->
                    <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-slate-200 p-3 hover:bg-rose-50/50 hover:border-rose-200 transition">
                        <input type="radio" name="hasil" value="tidak_lolos" class="h-4 w-4 text-rose-600 focus:ring-rose-500" required>
                        <div>
                            <p class="text-sm font-semibold text-rose-600">Tidak Lolos</p>
                            <p class="text-[11px] text-slate-400">Peserta tidak dapat melanjutkan ke tahap berikutnya.</p>
                        </div>
                    </label>
                </div>

                <!-- Tombol -->
                <div class="mt-5 flex gap-2">
                    <button type="button" id="cancel-status-modal" class="flex-1 rounded-xl border border-slate-200 px-4 py-2.5 text-xs font-semibold text-slate-600 hover:bg-slate-50">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 rounded-xl bg-brand-blue px-4 py-2.5 text-xs font-semibold text-white hover:bg-blue-800 transition">
                        Simpan Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>