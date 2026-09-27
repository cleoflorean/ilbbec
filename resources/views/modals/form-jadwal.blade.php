<!-- MODAL POPUP: DAFTARKAN JADWAL SELEKSI -->
<div id="jadwal-modal" 
    class="fixed inset-0 z-[60] hidden items-center justify-center bg-slate-950/60 backdrop-blur-sm p-3 sm:p-4 overflow-y-auto transition-all" 
    role="dialog" 
    aria-modal="true" 
    aria-labelledby="jadwal-modal-title" 
    hidden>
    
    <div class="w-full max-w-xl max-h-[92vh] flex flex-col rounded-3xl bg-white shadow-2xl border border-blue-100 overflow-hidden transform transition-all">
        
        <!-- Modal Header -->
        <div class="flex items-center justify-between border-b border-blue-50 bg-gradient-to-r from-blue-50/80 via-white to-white px-4 sm:px-6 py-4 sm:py-5">
            <div class="flex items-center gap-3 sm:gap-3.5">
                <div class="flex h-10 w-10 sm:h-11 sm:w-11 items-center justify-center rounded-2xl bg-brand-blue text-white shadow-md shadow-blue-500/20 shrink-0">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg sm:text-xl font-bold text-brand-navy" id="jadwal-modal-title">Daftarkan Waktu Seleksi</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Sediakan slot jadwal untuk dipilih oleh calon peserta.</p>
                </div>
            </div>
            <button type="button" 
                    data-modal-close="jadwal-modal" 
                    class="rounded-xl p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-700 transition" 
                    aria-label="Tutup form jadwal">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Modal Body (Form) -->
        <div class="overflow-y-auto px-4 sm:px-6 py-4 sm:py-6">
            <form id="form-jadwal-seleksi" action="{{ route('admin.jadwal.store') }}" method="POST" class="space-y-4">
                @csrf
                
                <!-- 1. Dropdown Nama Seleksi -->
                <div>
                    <label for="jadwal-nama-seleksi" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Tahapan Seleksi <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <select id="jadwal-nama-seleksi" 
                                name="NamaSesi" 
                                class="w-full appearance-none rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-800 shadow-sm transition focus:border-brand-blue focus:outline-none focus:ring-4 focus:ring-blue-100" 
                                required>
                            <option value="" disabled selected>-- Pilih Tahapan Seleksi --</option>
                            <option value="Study Case">Study Case (Studi Kasus)</option>
                            <option value="Wawancara">Wawancara (Interview)</option>
                            <option value="Berkas">Berkas (Periode Pengumpulan Berkas)</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- 2. Form Input Jadwal (Tanggal, Jam) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="jadwal-tanggal" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Tanggal Pelaksanaan <span class="text-rose-500">*</span>
                        </label>
                        <input type="date" 
                            id="jadwal-tanggal" 
                            name="TanggalMulai"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-sm font-medium text-slate-800 shadow-sm transition focus:border-brand-blue focus:outline-none focus:ring-4 focus:ring-blue-100"
                            required>
                    </div>
                    <div>
                        <label for="jadwal-jam" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Jam / Waktu Mulai <span class="text-rose-500">*</span>
                        </label>
                        <input type="time" 
                            id="jadwal-jam" 
                            name="Jam" 
                            class="w-full rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-sm font-medium text-slate-800 shadow-sm transition focus:border-brand-blue focus:outline-none focus:ring-4 focus:ring-blue-100"
                            required>
                    </div>
                </div>

                <!-- Khusus Berkas: Tanggal Berakhir (Optional) -->
                <div id="container-periode-berkas" class="hidden">
                    <label for="tanggal-akhir-berkas" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Tanggal Berakhir Periode Berkas <span class="text-slate-400 font-normal">(Opsional)</span>
                    </label>
                    <input type="date"
                        id="tanggal-akhir-berkas"
                        name="TanggalBerakhir"
                        class="w-full rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-sm font-medium text-slate-800 shadow-sm transition focus:border-brand-blue focus:outline-none focus:ring-4 focus:ring-blue-100">
                </div>

                <!-- Lokasi / Ruangan -->
                <div>
                    <label for="jadwal-lokasi" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Lokasi / Ruangan <span class="text-slate-400 font-normal">(Opsional)</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </span>
                        <input type="text" 
                            id="jadwal-lokasi" 
                            name="Lokasi" 
                            placeholder="Contoh: Ruang 301 / Gedung Rektorat Lt. 3 / Zoom Meeting" 
                            class="w-full rounded-xl border border-slate-200 bg-white pl-10 pr-3.5 py-2.5 text-sm font-medium text-slate-800 shadow-sm transition focus:border-brand-blue focus:outline-none focus:ring-4 focus:ring-blue-100">
                    </div>
                </div>

                <!-- Keterangan Tambahan -->
                <div>
                    <label for="jadwal-keterangan" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Keterangan Tambahan <span class="text-slate-400 font-normal">(Opsional)</span>
                    </label>
                    <input type="text" 
                        id="jadwal-keterangan" 
                        name="keterangan" 
                        placeholder="Contoh: Membawa laptop & alat tulis" 
                        class="w-full rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-sm font-medium text-slate-800 shadow-sm transition focus:border-brand-blue focus:outline-none focus:ring-4 focus:ring-blue-100">
                </div>

                <!-- Status Ketersediaan -->
                <div>
                    <label for="jadwal-status" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Status Jadwal
                    </label>
                    <select id="jadwal-status" 
                            name="status" 
                            class="w-full rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-sm font-medium text-slate-800 shadow-sm transition focus:border-brand-blue focus:outline-none focus:ring-4 focus:ring-blue-100">
                        <option value="available" selected>Tersedia (Dapat Dipilih Peserta)</option>
                        <option value="closed">Ditutup (Tidak Dapat Dipilih Baru)</option>
                        <option value="cancelled">Dibatalkan</option>
                    </select>
                </div>

                <!-- Modal Footer Actions -->
                <div class="mt-6 flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-2.5 sm:gap-3 border-t border-slate-100 pt-4">
                    <button type="button" 
                            data-modal-close="jadwal-modal" 
                            class="w-full sm:w-auto text-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 hover:text-slate-800 transition shadow-sm">
                        Batal
                    </button>
                    <button type="submit" 
                            class="w-full sm:w-auto justify-center inline-flex items-center gap-2 rounded-xl bg-brand-blue px-6 py-2.5 text-sm font-semibold text-white shadow-md shadow-blue-600/20 hover:bg-blue-800 transition">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Jadwal Seleksi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    (() => {
        const modal = document.getElementById('jadwal-modal');
        const selectTahap = document.getElementById('jadwal-nama-seleksi');
        const containerPeriodeBerkas = document.getElementById('container-periode-berkas');

        if (selectTahap && containerPeriodeBerkas) {
            selectTahap.addEventListener('change', () => {
                if (selectTahap.value === 'Berkas') {
                    containerPeriodeBerkas.classList.remove('hidden');
                } else {
                    containerPeriodeBerkas.classList.add('hidden');
                }
            });
        }

        const setModalState = (isOpen) => {
            if (!modal) return;
            modal.hidden = !isOpen;
            modal.classList.toggle('hidden', !isOpen);
            modal.classList.toggle('flex', isOpen);
            document.body.classList.toggle('overflow-hidden', isOpen);
        };

        document.addEventListener('click', (event) => {
            const openBtn = event.target.closest('[data-modal-open="jadwal-modal"]');
            const closeBtn = event.target.closest('[data-modal-close="jadwal-modal"]');

            if (openBtn) {
                event.preventDefault();
                setModalState(true);
            } else if (closeBtn) {
                event.preventDefault();
                setModalState(false);
            } else if (event.target === modal) {
                setModalState(false);
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && modal && !modal.hidden) {
                setModalState(false);
            }
        });
    })();
</script>
