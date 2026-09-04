<div id="pendaftaran-modal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-slate-950/60 p-4" role="dialog" aria-modal="true" aria-labelledby="pendaftaran-modal-title" hidden>
    <div class="w-full max-w-lg max-h-[90vh] overflow-y-auto rounded-2xl bg-white shadow-2xl">
        <div class="flex items-center justify-between border-b border-slate-200 p-5">
            <h2 class="text-lg font-bold text-slate-900" id="pendaftaran-modal-title">Form Pendaftaran</h2>
            <button type="button" data-modal-close="pendaftaran-modal" class="rounded-lg p-2 text-2xl leading-none text-slate-400 hover:bg-slate-100 hover:text-slate-700" aria-label="Tutup form pendaftaran">&times;</button>
        </div>
        <div class="p-5">
            <form id="pendaftaran-form" action="{{ route('pendaftaran.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="UserId" value="{{Auth::id()}}">
                    <div class="mb-3">
                            <label for="pendaftaran-nama" class="mb-1 block text-sm font-medium text-slate-700">Nama</label>
                            {{-- Atribut 'disabled' ditambahkan & 'name' dihapus agar TIDAK TERKIRIM saat POST --}}
                            <input 
                                id="pendaftaran-nama" 
                                type="text" 
                                value="{{ Auth::user()->name ?? $user->Nama }}" 
                                class="w-full rounded-lg border border-slate-300 bg-slate-100 px-3 py-2 text-slate-500 cursor-not-allowed" 
                                disabled
                            >
                            <small class="text-xs text-slate-400">*Nama terisi otomatis berdasarkan akun Anda</small>
                    </div>                                                  
                            <div class="mb-3">
                                <label for="pendaftaran-nip" class="mb-1 block text-sm font-medium text-slate-700">NPM</label>
                                <input 
                                    id="pendaftaran-npm" 
                                    type="text" 
                                    value="{{ Auth::user()->name ?? $user->Npm }}" 
                                    class="w-full rounded-lg border border-slate-300 bg-slate-100 px-3 py-2 text-slate-500 cursor-not-allowed" 
                                    disabled
                                >
                            </div>
                            <div class="mb-3">
                                <label for="pendaftaran-role" class="mb-1 block text-sm font-medium text-slate-700">Divisi</label>
                                <select name="Divisi" id="pendaftaran-role" class="w-full rounded-lg border border-slate-300 px-3 py-2" required>
                                    <option value="Bendahara">Bendahara</option>
                                    <option value="Sekretaris">Sekretaris</option>
                                    <option value="Human Resources">Human Resources</option>
                                    <option value="Public Relation">Public Relation</option>
                                    <option value="Curiculum">Curiculum</option>
                                    <option value="Media & Information">Media & Information</option>
                                </select>
                            </div>
                                 <div class="mb-3">
                                    <label for="pendaftaran-cv" class="mb-1 block text-sm font-medium text-slate-700">Upload CV (PDF)</label>
                                    <input type="file" name="BerkasCV" id="pendaftaran-cv" class="w-full rounded-lg border border-slate-300 px-3 py-2" accept="application/pdf" required>
                                </div>
                                 <div class="mb-3">
                                    <label for="pendaftaran-portofolio" class="mb-1 block text-sm font-medium text-slate-700">Upload Portofolio Opsional (PDF)</label>
                                    <input type="file" name="Portofolio" id="pendaftaran-portofolio" class="w-full rounded-lg border border-slate-300 px-3 py-2" accept="application/pdf">
                                </div>
                                {{-- <input type="hidden" name="Status" value="Aktif"> --}}
                            <button type="submit" class="rounded-lg bg-blue-700 px-4 py-2 font-semibold text-white hover:bg-blue-800">Kirim Pendaftaran</button>
            </form>
        </div>
    </div>
</div>

<script>
    (() => {
        let lastTrigger;

        const setModalState = (modal, isOpen) => {
            modal.hidden = !isOpen;
            modal.classList.toggle('hidden', !isOpen);
            modal.classList.toggle('flex', isOpen);
            document.body.classList.toggle('overflow-hidden', isOpen);
        };

        document.addEventListener('click', (event) => {
            const openButton = event.target.closest('[data-modal-open]');
            const closeButton = event.target.closest('[data-modal-close]');
            const modal = openButton
                ? document.getElementById(openButton.dataset.modalOpen)
                : closeButton
                    ? document.getElementById(closeButton.dataset.modalClose)
                    : null;

            if (!modal) return;

            if (openButton) {
                lastTrigger = openButton;
                setModalState(modal, true);
                modal.querySelector('input, select, textarea, button')?.focus();
            } else {
                setModalState(modal, false);
                lastTrigger?.focus();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key !== 'Escape') return;
            document.querySelectorAll('[role="dialog"]:not([hidden])').forEach((modal) => {
                setModalState(modal, false);
                lastTrigger?.focus();
            });
        });
    })();
</script>