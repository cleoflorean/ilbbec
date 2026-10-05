<!-- MODAL DETAIL PESERTA -->
<div id="detail-peserta" class="hidden fixed inset-0 z-50 bg-slate-900/40 backdrop-blur-sm flex items-end sm:items-center justify-center p-0 sm:p-6" role="dialog" aria-modal="true">
    <div class="relative w-full sm:max-w-2xl max-h-[92vh] overflow-y-auto bg-white rounded-t-3xl sm:rounded-3xl shadow-2xl">

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

            <!--  REFLEKSI KARAKTER & EMOSI (INSIDE OUT)  -->
            <div class="rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                <div class="px-4 py-3 bg-slate-50/80 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="flex items-center -space-x-1">
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-400 ring-1 ring-white" title="Joy"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-red-500 ring-1 ring-white" title="Anger"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-blue-500 ring-1 ring-white" title="Sadness"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 ring-1 ring-white" title="Disgust"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-purple-500 ring-1 ring-white" title="Fear"></span>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-brand-navy">Refleksi Karakter & Emosi</h3>
                            <p class="text-[10px] text-slate-400">Pertanyaan Inside Out untuk bahan penilaian</p>
                        </div>
                    </div>
                    <span class="text-[10px] font-semibold text-brand-blue bg-blue-50 border border-blue-100 px-2.5 py-0.5 rounded-full">
                        Inside Out
                    </span>
                </div>

                <!-- Konten Jawaban Refleksi -->
                <div id="detail-refleksi-content" class="p-4 space-y-4">
                    <!-- Pertanyaan 1 -->
                    <div class="rounded-xl border border-slate-200/80 bg-slate-50/40 p-3.5 space-y-2.5">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                            <span class="text-xs font-bold text-brand-navy flex items-center gap-1.5">
                                <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-brand-blue/10 text-brand-blue font-bold text-[10px]">1</span>
                                Dinamika Kerja Tim & Emosi Dominan
                            </span>
                            <div id="detail-refleksi-q1-badge"></div>
                        </div>
                        <p class="text-[11px] text-slate-500 italic bg-white/70 rounded-lg p-2 border border-slate-100 leading-relaxed">
                            "If you were one of the emotion characters in Inside Out, which emotion do you feel most often when you’re working with a team, and what usually brings it out?"
                        </p>
                        <div class="rounded-lg bg-white p-3 border border-slate-200 text-xs text-slate-700">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Alasan & Penjelasan:</p>
                            <div id="detail-refleksi-q1-alasan" class="text-slate-800 font-normal leading-relaxed whitespace-pre-line">-</div>
                        </div>
                    </div>

                    <!-- Pertanyaan 2 -->
                    <div class="rounded-xl border border-slate-200/80 bg-slate-50/40 p-3.5 space-y-2.5">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                            <span class="text-xs font-bold text-brand-navy flex items-center gap-1.5">
                                <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-brand-blue/10 text-brand-blue font-bold text-[10px]">2</span>
                                Respon Terhadap Tantangan / Perbedaan
                            </span>
                            <div id="detail-refleksi-q2-badge"></div>
                        </div>
                        <p class="text-[11px] text-slate-500 italic bg-white/70 rounded-lg p-2 border border-slate-100 leading-relaxed">
                            "If you were one of the emotion characters in Inside Out, when challenges or disagreements happen in your team, which emotion tends to take over—and what helps you handle it?"
                        </p>
                        <div class="rounded-lg bg-white p-3 border border-slate-200 text-xs text-slate-700">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Alasan & Penjelasan:</p>
                            <div id="detail-refleksi-q2-alasan" class="text-slate-800 font-normal leading-relaxed whitespace-pre-line">-</div>
                        </div>
                    </div>

                    <!-- Pertanyaan 3 -->
                    <div class="rounded-xl border border-slate-200/80 bg-slate-50/40 p-3.5 space-y-2.5">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                            <span class="text-xs font-bold text-brand-navy flex items-center gap-1.5">
                                <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-brand-blue/10 text-brand-blue font-bold text-[10px]">3</span>
                                Adaptasi Terhadap Hal Baru & Tidak Dikenal
                            </span>
                            <div id="detail-refleksi-q3-badge"></div>
                        </div>
                        <p class="text-[11px] text-slate-500 italic bg-white/70 rounded-lg p-2 border border-slate-100 leading-relaxed">
                            "If you were one of the emotion characters in Inside Out, when you’re facing something new or unfamiliar, which emotion usually speaks the loudest inside you?"
                        </p>
                        <div class="rounded-lg bg-white p-3 border border-slate-200 text-xs text-slate-700">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Alasan & Penjelasan:</p>
                            <div id="detail-refleksi-q3-alasan" class="text-slate-800 font-normal leading-relaxed whitespace-pre-line">-</div>
                        </div>
                    </div>
                </div>

                <!-- State Kosong jika belum ada data refleksi -->
                <div id="detail-refleksi-empty" class="p-6 text-center hidden">
                    <div class="w-10 h-10 mx-auto mb-2 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <p class="text-xs font-semibold text-slate-600">Belum ada jawaban refleksi Inside Out</p>
                    <p class="text-[11px] text-slate-400 mt-0.5">Kandidat ini belum mengisi kuesioner refleksi emosi.</p>
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
                    <a id="detail-foto" href="#" target="_blank" class="inline-flex items-center gap-2 rounded-xl bg-blue-50 border border-blue-100 px-3 py-2 text-xs font-semibold text-brand-blue hover:bg-blue-100 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Lihat Foto
                    </a>
                    <a id="detail-portofolio" href="#" target="_blank" class="inline-flex items-center gap-2 rounded-xl bg-blue-50 border border-blue-100 px-3 py-2 text-xs font-semibold text-brand-blue hover:bg-blue-100 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Lihat Portofolio
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