<!-- MODAL DETAIL PESERTA -->

<div
    id="detail-peserta-modal"
    class="hidden fixed inset-0 z-50 bg-slate-900/40 backdrop-blur-sm
    flex items-end sm:items-center justify-center p-0 sm:p-6"
>

    <div
        class="relative w-full sm:max-w-xl
        max-h-[92vh] overflow-y-auto
        bg-white
        rounded-t-3xl sm:rounded-3xl
        shadow-2xl"
    >

        <!--  HEADER  -->

        <div class="sticky top-0 z-10
            bg-white
            border-b border-slate-100
            px-5 sm:px-6 py-4
            flex items-center justify-between">

            <div>

                <h2 class="text-lg font-bold text-brand-navy">
                    Detail Peserta
                </h2>

                <p class="text-xs text-slate-400 mt-0.5">
                    Informasi lengkap calon anggota
                </p>

            </div>


            <!-- Close -->
            <button
                type="button"
                id="close-detail-modal"
                class="w-9 h-9 rounded-xl
                border border-slate-200
                flex items-center justify-center
                text-slate-500
                hover:bg-slate-50
                transition"
            >

                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />

                </svg>

            </button>

        </div>


        <!--  CONTENT  -->

        <div class="p-5 sm:p-6 space-y-5">


            <!--  PROFILE  -->

            <div class="flex items-center gap-4">
                <div class="min-w-0">
                    <h3
                        id="detail-name"
                        class="font-bold text-brand-navy text-base"
                    >
                        -
                    </h3>

                    <p
                        id="detail-npm"
                        class="text-xs text-slate-400 mt-1"
                    >
                        NPM: -
                    </p>

                </div>

            </div>


            <!--  INFORMASI AKADEMIK  -->

            <div
                class="rounded-2xl
                border border-slate-200
                overflow-hidden"
            >

                <div
                    class="px-4 py-3
                    bg-slate-50/70
                    border-b border-slate-100"
                >

                    <h3 class="text-sm font-bold text-brand-navy">
                        Informasi Akademik
                    </h3>

                </div>


                <div class="p-4 space-y-3">

                    <div class="flex justify-between gap-4">

                        <span class="text-xs text-slate-400">
                            Program Studi
                        </span>

                        <span
                            id="detail-prodi"
                            class="text-xs font-medium
                            text-slate-700 text-right"
                        >
                            -
                        </span>

                    </div>


                    <div class="flex justify-between gap-4">

                        <span class="text-xs text-slate-400">
                            Angkatan
                        </span>

                        <span
                            id="detail-angkatan"
                            class="text-xs font-medium
                            text-slate-700"
                        >
                            -
                        </span>

                    </div>

                </div>

            </div>


            <!--  INFORMASI PENDAFTARAN  -->

            <div
                class="rounded-2xl
                border border-slate-200
                overflow-hidden"
            >

                <div
                    class="px-4 py-3
                    bg-slate-50/70
                    border-b border-slate-100"
                >

                    <h3 class="text-sm font-bold text-brand-navy">
                        Informasi Pendaftaran
                    </h3>

                </div>


                <div class="p-4 space-y-4">


                    <!-- Divisi -->

                    <div>

                        <p class="text-[11px] text-slate-400 mb-1">
                            Divisi Pilihan
                        </p>

                        <span
                            id="detail-divisi"
                            class="inline-flex
                            px-2.5 py-1
                            rounded-lg
                            bg-blue-50
                            border border-blue-100
                            text-xs font-semibold
                            text-brand-blue"
                        >
                            -
                        </span>

                    </div>


                    <!-- Status Berkas -->

                    <div>

                        <p class="text-[11px] text-slate-400 mb-1">
                            Status Terkini
                        </p>

                        <span
                            id="detail-status-terkini"
                            class="inline-flex
                            px-2.5 py-1
                            rounded-full
                            bg-amber-50
                            text-xs font-semibold
                            text-amber-700"
                        >
                            Selesai
                        </span>

                    </div>


                    <!-- Status Akhir -->

                    <div>

                        <p class="text-[11px] text-slate-400 mb-1">
                            Status Akhir
                        </p>

                        <span
                            id="detail-status-akhir"
                            class="text-xs font-semibold
                            text-slate-600"
                        >
                            Dalam Proses
                        </span>

                    </div>


                    <!-- Tanggal -->

                    <div>

                        <p class="text-[11px] text-slate-400 mb-1">
                            Tanggal Pendaftaran
                        </p>

                        <p
                            id="detail-tanggal"
                            class="text-xs font-medium
                            text-slate-700"
                        >
                            -
                        </p>

                    </div>

                </div>

            </div>


            <!--  CV  -->

            <div
                class="rounded-2xl
                border border-slate-200
                p-4"
            >

                <div class="flex items-center justify-between gap-4">

                    <div>

                        <p class="text-sm font-bold text-brand-navy">
                            Dokumen CV
                        </p>

                        <p class="text-[11px] text-slate-400 mt-1">
                            Dokumen yang diunggah oleh peserta.
                        </p>
                    </div>
                    <a id="detail-cv" href="#" target="_blank" class="inline-flex items-center gap-2 rounded-xl bg-blue-50 border border-blue-100 px-3 py-2 text-xs font-semibold text-brand-blue hover:bg-blue-100 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg> Lihat CV
                    </a>

                </div>

            </div>

        </div>


        <!--  FOOTER  -->

        <div
            class="sticky bottom-0
            bg-white
            border-t border-slate-100
            px-5 sm:px-6 py-4"
        >

            <button
                type="button"
                id="close-detail-button"
                class="w-full
                rounded-xl
                bg-brand-blue
                hover:bg-blue-700
                text-white
                py-2.5
                text-sm font-semibold
                transition"
            >

                Tutup

            </button>

        </div>

    </div>

</div>