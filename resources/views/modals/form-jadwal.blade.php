<!-- MODAL POPUP: DAFTARKAN TAHAPAN SELEKSI -->
<div id="jadwal-modal" 
    class="fixed inset-0 z-[60] hidden items-center justify-center bg-slate-950/60 backdrop-blur-sm p-3 sm:p-4 overflow-y-auto transition-all" 
    role="dialog" 
    aria-modal="true" 
    aria-labelledby="jadwal-modal-title" 
    hidden>
    
    <div class="w-full max-w-2xl max-h-[92vh] flex flex-col rounded-3xl bg-white shadow-2xl border border-blue-100 overflow-hidden transform transition-all">
        
        <!-- Modal Header (Minimalis, Bersih, Nuansa Biru) -->
        <div class="flex items-center justify-between border-b border-blue-50 bg-gradient-to-r from-blue-50/80 via-white to-white px-4 sm:px-6 py-4 sm:py-5">
            <div class="flex items-center gap-3 sm:gap-3.5">
                <div class="flex h-10 w-10 sm:h-11 sm:w-11 items-center justify-center rounded-2xl bg-brand-blue text-white shadow-md shadow-blue-500/20 shrink-0">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg sm:text-xl font-bold text-brand-navy" id="jadwal-modal-title">Daftarkan Waktu Seleksi</h2>
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
        <div class="overflow-y-auto px-4 sm:px-6 py-4 sm:py-6 space-y-5 sm:space-y-6">
            <form id="form-jadwal-seleksi" action="{{ route('admin.jadwal.store') }}" method="POST">
                @csrf
                
                <!-- 1. Dropdown Nama Seleksi -->
                <div class="mb-5">
                    <label for="jadwal-nama-seleksi" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Nama Tahapan Seleksi <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <select id="jadwal-nama-seleksi" 
                                name="NamaSesi" 
                                class="w-full appearance-none rounded-xl border border-blue-200 bg-white px-4 py-3 text-sm font-medium text-slate-800 shadow-sm transition focus:border-brand-blue focus:outline-none focus:ring-4 focus:ring-blue-100" 
                                required>
                            <option value="" disabled selected>-- Pilih Tahapan Seleksi --</option>
                            <option value="Berkas">Berkas (Seleksi & Verifikasi Berkas)</option>
                            <option value="Study Case">Study Case (Studi Kasus)</option>
                            <option value="Wawancara">Wawancara (Interview)</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-1.5 text-xs text-slate-400">Pilih tahapan seleksi yang ingin dijadwalkan.</p>
                </div>

                <!-- 2. Khusus Berkas: Periode Tanggal Seleksi (Tanggal Mulai & Berakhir) -->
                <div id="container-periode-berkas" class="hidden rounded-2xl border border-amber-200 bg-amber-50/50 p-4 mb-5 transition-all">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="h-4 w-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider text-amber-700">Periode Seleksi Berkas</span>
                    </div>
                    <p class="text-xs text-slate-600 mb-4 leading-relaxed">
                        Tentukan <strong class="text-brand-navy">tanggal mulai</strong> dan <strong class="text-brand-navy">tanggal berakhir</strong> periode seleksi berkas. Calon peserta hanya dapat mengirimkan berkas dalam rentang waktu ini.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="tanggal-mulai-berkas" class="block text-[11px] font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Tanggal Mulai <span class="text-rose-500">*</span>
                            </label>
                            <input type="date"
                                id="tanggal-mulai-berkas"
                                name="TanggalMulai"
                                class="input-berkas-periode w-full rounded-xl border border-amber-200 bg-white px-3.5 py-2.5 text-sm font-medium text-slate-800 shadow-sm transition focus:border-amber-500 focus:outline-none focus:ring-4 focus:ring-amber-100">
                            <p class="mt-1 text-[10px] text-slate-400">Tanggal pembukaan periode seleksi berkas</p>
                        </div>
                        <div>
                            <label for="tanggal-akhir-berkas" class="block text-[11px] font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Tanggal Berakhir <span class="text-rose-500">*</span>
                            </label>
                            <input type="date"
                                id="tanggal-akhir-berkas"
                                name="TanggalBerakhir"
                                class="input-berkas-periode w-full rounded-xl border border-amber-200 bg-white px-3.5 py-2.5 text-sm font-medium text-slate-800 shadow-sm transition focus:border-amber-500 focus:outline-none focus:ring-4 focus:ring-amber-100">
                            <p class="mt-1 text-[10px] text-slate-400">Tanggal penutupan periode seleksi berkas</p>
                        </div>
                    </div>
                    <div id="validasi-tanggal-berkas" class="hidden mt-3 flex items-center gap-2 text-[11px] text-rose-600 font-medium">
                        <svg class="h-3.5 w-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Tanggal berakhir tidak boleh sebelum tanggal mulai.
                    </div>
                </div>

                <!-- 3. Khusus Study Case & Wawancara: Opsi Pembagian Hari -->
                <div id="container-pembagian-hari" class="hidden rounded-2xl border border-blue-100 bg-blue-50/50 p-4 mb-5 transition-all">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="h-4 w-4 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider text-brand-blue">Pembagian Hari Pelaksanaan</span>
                    </div>
                    <p class="text-xs text-slate-600 mb-3.5 leading-relaxed">
                        Khusus <strong class="text-brand-navy">Study Case</strong> dan <strong class="text-brand-navy">Wawancara</strong>, Anda dapat membagi jadwal pelaksanaan ke dalam <strong class="text-brand-blue">2 atau 3 hari</strong> untuk membagi sesi dan kuota peserta.
                    </p>

                    <!-- Pilihan Segmented Radio Buttons -->
                    <div class="grid grid-cols-3 gap-2.5">
                        <label class="cursor-pointer">
                            <input type="radio" name="pembagian_hari" value="1" class="peer sr-only radio-pembagian-hari" checked>
                            <div class="rounded-xl border border-blue-200 bg-white p-2.5 text-center transition-all peer-checked:border-brand-blue peer-checked:bg-brand-blue peer-checked:text-white hover:bg-blue-50/60 shadow-sm">
                                <p class="text-xs font-bold">1 Hari</p>
                                <p class="text-[10px] opacity-80 mt-0.5">Satu Hari Selesai</p>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="pembagian_hari" value="2" class="peer sr-only radio-pembagian-hari">
                            <div class="rounded-xl border border-blue-200 bg-white p-2.5 text-center transition-all peer-checked:border-brand-blue peer-checked:bg-brand-blue peer-checked:text-white hover:bg-blue-50/60 shadow-sm">
                                <p class="text-xs font-bold">2 Hari</p>
                                <p class="text-[10px] opacity-80 mt-0.5">Dibagi 2 Hari</p>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="pembagian_hari" value="3" class="peer sr-only radio-pembagian-hari">
                            <div class="rounded-xl border border-blue-200 bg-white p-2.5 text-center transition-all peer-checked:border-brand-blue peer-checked:bg-brand-blue peer-checked:text-white hover:bg-blue-50/60 shadow-sm">
                                <p class="text-xs font-bold">3 Hari</p>
                                <p class="text-[10px] opacity-80 mt-0.5">Dibagi 3 Hari</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- 3. Form Input Jadwal (Tanggal, Jam, Lokasi/Ruangan) -->
                
                <!-- MODE 1 HARI (Default atau Berkas) --> // form
                <div id="mode-single-day" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="jadwal-tanggal" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Tanggal Pelaksanaan <span class="text-rose-500">*</span>
                            </label>
                            <input type="date" 
                                id="jadwal-tanggal" 
                                name="TanggalMulai"
                                class="input-single w-full rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-sm font-medium text-slate-800 shadow-sm transition focus:border-brand-blue focus:outline-none focus:ring-4 focus:ring-blue-100"
                                required>
                        </div>
                        <div>
                            <label for="jadwal-tanggal" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Tanggal Berakhir <span class="text-rose-500">*</span>
                            </label>
                            <input type="date" 
                                id="jadwal-tanggal" 
                                name="TanggalSelesai" 
                                class="input-single w-full rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-sm font-medium text-slate-800 shadow-sm transition focus:border-brand-blue focus:outline-none focus:ring-4 focus:ring-blue-100"
                                required>
                        </div>
                        <div>
                            <label for="jadwal-jam" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Jam / Waktu Mulai <span class="text-rose-500">*</span>
                            </label>
                            <input type="time" 
                                id="jadwal-jam" 
                                name="Jam" 
                                class="input-single w-full rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-sm font-medium text-slate-800 shadow-sm transition focus:border-brand-blue focus:outline-none focus:ring-4 focus:ring-blue-100"
                                required>
                        </div>
                    </div>
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
                                placeholder="Contoh: Gedung Rektorat Lt. 3 / Ruang 301 / Zoom Meeting" 
                                class="w-full rounded-xl border border-slate-200 bg-white pl-10 pr-3.5 py-2.5 text-sm font-medium text-slate-800 shadow-sm transition focus:border-brand-blue focus:outline-none focus:ring-4 focus:ring-blue-100">
                        </div>
                    </div>
                </div>

                <!-- MODE MULTI-HARI (2 Hari atau 3 Hari) -->
                <div id="mode-multi-day" class="hidden space-y-4">
                    <!-- Hari 1 -->
                    <div class="rounded-2xl border border-blue-100 bg-white p-4 shadow-sm">
                        <div class="flex items-center justify-between mb-3 border-b border-slate-100 pb-2">
                            <span class="inline-flex items-center gap-1.5 text-xs font-bold text-brand-blue uppercase tracking-wider">
                                <span class="h-2 w-2 rounded-full bg-brand-blue"></span>
                                Hari Ke-1
                            </span>
                            <span class="text-[11px] font-medium text-slate-400">Sesi 1</span>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-3">
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1">Tanggal Hari 1 <span class="text-rose-500">*</span></label>
                                <input type="date" name="hari[0][tanggal]" class="input-multi-1 w-full rounded-lg border border-slate-200 px-3 py-2 text-xs focus:border-brand-blue focus:outline-none focus:ring-2 focus:ring-blue-100">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1">Jam Hari 1 <span class="text-rose-500">*</span></label>
                                <input type="time" name="hari[0][jam]" class="input-multi-1 w-full rounded-lg border border-slate-200 px-3 py-2 text-xs focus:border-brand-blue focus:outline-none focus:ring-2 focus:ring-blue-100">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-600 mb-1">Lokasi / Ruangan Hari 1</label>
                            <input type="text" name="hari[0][lokasi]" placeholder="Contoh: Ruang 301 / Lab Komputer" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-xs focus:border-brand-blue focus:outline-none focus:ring-2 focus:ring-blue-100">
                        </div>
                    </div>

                    <!-- Hari 2 -->
                    <div class="rounded-2xl border border-blue-100 bg-white p-4 shadow-sm">
                        <div class="flex items-center justify-between mb-3 border-b border-slate-100 pb-2">
                            <span class="inline-flex items-center gap-1.5 text-xs font-bold text-brand-blue uppercase tracking-wider">
                                <span class="h-2 w-2 rounded-full bg-brand-blue"></span>
                                Hari Ke-2
                            </span>
                            <span class="text-[11px] font-medium text-slate-400">Sesi 2</span>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-3">
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1">Tanggal Hari 2 <span class="text-rose-500">*</span></label>
                                <input type="date" name="hari[1][tanggal]" class="input-multi-2 w-full rounded-lg border border-slate-200 px-3 py-2 text-xs focus:border-brand-blue focus:outline-none focus:ring-2 focus:ring-blue-100">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1">Jam Hari 2 <span class="text-rose-500">*</span></label>
                                <input type="time" name="hari[1][jam]" class="input-multi-2 w-full rounded-lg border border-slate-200 px-3 py-2 text-xs focus:border-brand-blue focus:outline-none focus:ring-2 focus:ring-blue-100">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-600 mb-1">Lokasi / Ruangan Hari 2</label>
                            <input type="text" name="hari[1][lokasi]" placeholder="Contoh: Ruang 302 / Lab Komputer" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-xs focus:border-brand-blue focus:outline-none focus:ring-2 focus:ring-blue-100">
                        </div>
                    </div>

                    <!-- Hari 3 (Muncul bila pilih 3 Hari) -->
                    <div id="card-hari-3" class="hidden rounded-2xl border border-blue-100 bg-white p-4 shadow-sm">
                        <div class="flex items-center justify-between mb-3 border-b border-slate-100 pb-2">
                            <span class="inline-flex items-center gap-1.5 text-xs font-bold text-brand-blue uppercase tracking-wider">
                                <span class="h-2 w-2 rounded-full bg-brand-blue"></span>
                                Hari Ke-3
                            </span>
                            <span class="text-[11px] font-medium text-slate-400">Sesi 3</span>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-3">
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1">Tanggal Hari 3 <span class="text-rose-500">*</span></label>
                                <input type="date" name="hari[2][tanggal]" class="input-multi-3 w-full rounded-lg border border-slate-200 px-3 py-2 text-xs focus:border-brand-blue focus:outline-none focus:ring-2 focus:ring-blue-100">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1">Jam Hari 3 <span class="text-rose-500">*</span></label>
                                <input type="time" name="hari[2][jam]" class="input-multi-3 w-full rounded-lg border border-slate-200 px-3 py-2 text-xs focus:border-brand-blue focus:outline-none focus:ring-2 focus:ring-blue-100">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-600 mb-1">Lokasi / Ruangan Hari 3</label>
                            <input type="text" name="hari[2][lokasi]" placeholder="Contoh: Ruang 303 / Lab Komputer" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-xs focus:border-brand-blue focus:outline-none focus:ring-2 focus:ring-blue-100">
                        </div>
                    </div>
                </div>

                <!-- 4. Toggle Keaktifan Sesi -->
                <div class="mt-5 rounded-2xl border border-blue-100/80 bg-blue-50/40 p-4 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-800">Status Sesi Langsung Aktif</p>
                        <p class="text-[11px] text-slate-500 mt-0.5">Sesi aktif akan otomatis muncul pada linimasa peserta saat periode H-3 dibuka.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer ml-4">
                        <input type="checkbox" name="IsActive" value="1" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-blue"></div>
                    </label>
                </div>

                <!-- Modal Footer Actions -->
                <div class="mt-6 flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-2.5 sm:gap-3 border-t border-slate-100 pt-4 sm:pt-5">
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
        const containerPembagian = document.getElementById('container-pembagian-hari');
        // const containerPeriodeBerkas = document.getElementById('container-periode-berkas');
        const modeSingle = document.getElementById('mode-single-day');
        const modeMulti = document.getElementById('mode-multi-day');
        const cardHari3 = document.getElementById('card-hari-3');
        const radioHariList = document.querySelectorAll('.radio-pembagian-hari');
        const tanggalMulai = document.getElementById('tanggal-mulai-berkas');
        const tanggalAkhir = document.getElementById('tanggal-akhir-berkas');
        const validasiTanggal = document.getElementById('validasi-tanggal-berkas');

        const inputSingleList = document.querySelectorAll('.input-single');
        const inputMulti1List = document.querySelectorAll('.input-multi-1');
        const inputMulti2List = document.querySelectorAll('.input-multi-2');
        const inputMulti3List = document.querySelectorAll('.input-multi-3');
        const inputBerkasPeriode = document.querySelectorAll('.input-berkas-periode');

        // Fungsi memperbarui validasi input & tampilan mode hari
        const updateDayMode = (days) => {
            if (days === '1') {
                modeSingle.classList.remove('hidden');
                modeMulti.classList.add('hidden');
                cardHari3.classList.add('hidden');

                inputSingleList.forEach(input => input.required = true);
                inputMulti1List.forEach(input => input.required = false);
                inputMulti2List.forEach(input => input.required = false);
                inputMulti3List.forEach(input => input.required = false);
            } else if (days === '2') {
                modeSingle.classList.add('hidden');
                modeMulti.classList.remove('hidden');
                cardHari3.classList.add('hidden');

                inputSingleList.forEach(input => input.required = false);
                inputMulti1List.forEach(input => input.required = true);
                inputMulti2List.forEach(input => input.required = true);
                inputMulti3List.forEach(input => input.required = false);
            } else if (days === '3') {
                modeSingle.classList.add('hidden');
                modeMulti.classList.remove('hidden');
                cardHari3.classList.remove('hidden');

                inputSingleList.forEach(input => input.required = false);
                inputMulti1List.forEach(input => input.required = true);
                inputMulti2List.forEach(input => input.required = true);
                inputMulti3List.forEach(input => input.required = true);
            }
        };

        // Fungsi mengatur tampilan berdasarkan pilihan dropdown
        const handleSelectChange = () => {
            const val = selectTahap.value;

            if (val === 'Berkas') {
                // Tampilkan blok periode tanggal berkas
                containerPeriodeBerkas.classList.remove('hidden');
                // Sembunyikan pembagian hari (tidak relevan untuk Berkas)
                containerPembagian.classList.add('hidden');
                // Reset radio ke 1 hari, tampilkan mode single
                const radio1 = document.querySelector('.radio-pembagian-hari[value="1"]');
                if (radio1) radio1.checked = true;
                updateDayMode('1');
                // Aktifkan required untuk periode berkas, nonaktifkan single day
                inputBerkasPeriode.forEach(input => input.required = true);
                inputSingleList.forEach(input => input.required = false);
            } else if (val === 'Study Case' || val === 'Wawancara') {
                // Sembunyikan blok periode berkas
                containerPeriodeBerkas.classList.add('hidden');
                inputBerkasPeriode.forEach(input => {
                    input.required = false;
                    input.value = '';
                });
                if (validasiTanggal) validasiTanggal.classList.add('hidden');
                // Tampilkan pembagian hari
                containerPembagian.classList.remove('hidden');
                const checkedRadio = document.querySelector('.radio-pembagian-hari:checked');
                updateDayMode(checkedRadio ? checkedRadio.value : '1');
            } else {
                // Belum memilih: sembunyikan semua tambahan
                containerPeriodeBerkas.classList.add('hidden');
                containerPembagian.classList.add('hidden');
                inputBerkasPeriode.forEach(input => {
                    input.required = false;
                    input.value = '';
                });
            }
        };

        // Validasi tanggal berakhir >= tanggal mulai
        const validateTanggalBerkas = () => {
            if (!tanggalMulai || !tanggalAkhir || !validasiTanggal) return true;
            if (tanggalMulai.value && tanggalAkhir.value) {
                const mulai = new Date(tanggalMulai.value);
                const akhir = new Date(tanggalAkhir.value);
                if (akhir < mulai) {
                    validasiTanggal.classList.remove('hidden');
                    tanggalAkhir.classList.add('border-rose-400', 'ring-rose-100');
                    tanggalAkhir.classList.remove('border-amber-200');
                    return false;
                } else {
                    validasiTanggal.classList.add('hidden');
                    tanggalAkhir.classList.remove('border-rose-400', 'ring-rose-100');
                    tanggalAkhir.classList.add('border-amber-200');
                    return true;
                }
            }
            validasiTanggal.classList.add('hidden');
            return true;
        };

        // Event listener dropdown
        if (selectTahap) {
            selectTahap.addEventListener('change', handleSelectChange);
        }

        // Event listener radio pembagian hari
        radioHariList.forEach(radio => {
            radio.addEventListener('change', (e) => {
                updateDayMode(e.target.value);
            });
        });

        // Event listener validasi tanggal berkas
        if (tanggalMulai) {
            tanggalMulai.addEventListener('change', () => {
                // Jika tanggal akhir sudah diisi, set min date
                if (tanggalAkhir) tanggalAkhir.min = tanggalMulai.value;
                validateTanggalBerkas();
            });
        }
        if (tanggalAkhir) {
            tanggalAkhir.addEventListener('change', validateTanggalBerkas);
        }

        // Cegah submit jika validasi tanggal gagal
        const form = document.getElementById('form-jadwal-seleksi');
        if (form) {
            form.addEventListener('submit', (e) => {
                if (selectTahap && selectTahap.value === 'Berkas') {
                    if (!validateTanggalBerkas()) {
                        e.preventDefault();
                        tanggalAkhir.focus();
                    }
                }
            });
        }

        // Controller buka / tutup modal
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
