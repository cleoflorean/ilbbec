<div x-show="openEditModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm" style="display: none;">
    <div @click.away="openEditModal = false" class="bg-white rounded-2xl p-6 w-full max-w-lg shadow-xl space-y-4 border border-slate-100">
        
        <!-- Header Modal -->
        <div class="flex justify-between items-center border-b border-slate-100 pb-3">
            <h3 class="text-lg font-bold text-slate-800">Edit Profil Pengguna</h3>
            <button @click="openEditModal = false" class="text-slate-400 hover:text-slate-600 text-xl font-bold">&times;</button>
        </div>

        <!-- Form Edit -->
        <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1">Nomor HP / WhatsApp</label>
                <input type="text" name="NoTlP" value="{{ old('NoTlP', $user->NoTlP) }}" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1">Tanggal Lahir</label>
                <input type="date" name="TanggalLahir" value="{{ old('TanggalLahir', $user->TanggalLahir?->format('Y-m-d')) }}" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end gap-2 pt-3 border-t border-slate-100">
                <button type="button" @click="openEditModal = false" class="px-4 py-2 bg-slate-100 text-slate-600 hover:bg-slate-200 rounded-lg text-sm font-medium transition">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white hover:bg-blue-700 rounded-lg text-sm font-medium transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>