<div id="edit-modal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-slate-950/60 p-3 sm:p-4 overflow-y-auto" role="dialog" aria-modal="true" aria-labelledby="edit-modal-title" hidden>
    <div class="w-full max-w-lg max-h-[90vh] overflow-y-auto rounded-2xl bg-white shadow-2xl">
        <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">
            <h2 class="text-lg font-bold text-slate-900" id="edit-modal-title">Form Edit Profil</h2>
            <button type="button" data-modal-close="edit-modal" class="rounded-lg p-2 text-2xl leading-none text-slate-400 hover:bg-slate-100 hover:text-slate-700" aria-label="Tutup form edit profil">&times;</button>
        </div>
        <div class="px-5 py-4 sm:py-5">
            <form id="edit-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="UserId" value="{{Auth::id()}}">
                <div class="mb-3">
                    <label for="edit-nama" class="mb-1 block text-sm font-medium">Nama</label>
                    <input 
                    id="edit-nama" 
                    type="text" 
                    name="Nama"
                    value="{{old('Nama', $user->Nama) }}" 
                    class="w-full rounded-lg border border-slate-300 bg-100 px-3 py-2"> 
                </div>                                                  
                <div class="mb-3">
                    <label for="edit-npm" class="mb-1 block text-sm font-medium">NPM</label>
                    <input 
                    id="edit-npm" 
                    type="text" 
                    value="{{old('Npm', $user->Npm) }}" 
                    name="Npm"
                    class="w-full rounded-lg border border-slate-300 bg-100 px-3 py-2">
                </div>
                <div class="mb-3">
                    <label for="edit-telepon"class="mb-1 block text-sm font-medium ">No Telepon</label>
                    <input 
                    id="edit-telepon" 
                    type="text" 
                    value="{{old('NoTlp', $user->NoTlp) }}" 
                    name="NoTlp"
                    class="w-full rounded-lg border border-slate-300 bg-100 px-3 py-2">
                </div>
                <div class="mb-3">
                    <label for="edit-lahir" class="mb-1 block text-sm font-medium">Tanggal Lahir</label>
                    <input 
                    id="edit-lahir" 
                    type="date" 
                    value="{{ old('TanggalLahir', \Carbon\Carbon::parse($user->TanggalLahir)->format('Y-m-d')) }}" 
                    name="TanggalLahir"
                    class="w-full rounded-lg border border-slate-300 bg-100 px-3 py-2">
                </div>
                <div class="mb-3">
                    <label for="edit-role" class="mb-1 block text-sm font-medium">Prodi</label>
                    <select name="ProdiId" id="edit-role" class="w-full rounded-lg border px-3 py-2" required>
                        @foreach($prodis as $prodi)
                        <option value="{{ $prodi->ProdiId }}" {{ old('ProdiId', $user->ProdiId) == $prodi->ProdiId ? 'selected' : '' }}>
                            {{ $prodi->NamaProdi }}
                        </option>
                        @endforeach
                    </select>
                </div>

                    {{-- <input type="hidden" name="Status" value="Aktif"> --}}
                <div class="pt-2 flex justify-end">
                    <button type="submit" class="w-full sm:w-auto rounded-xl bg-brand-blue px-6 py-2.5 font-semibold text-white hover:bg-blue-800 shadow-md transition">Simpan Perubahan</button>
                </div>
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