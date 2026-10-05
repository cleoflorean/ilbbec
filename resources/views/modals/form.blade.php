<div id="pendaftaran-modal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-slate-950/60 p-3 sm:p-4 overflow-y-auto" role="dialog" aria-modal="true" aria-labelledby="pendaftaran-modal-title" hidden>
    <div class="w-full max-w-xl sm:max-w-2xl max-h-[90vh] flex flex-col rounded-2xl bg-white shadow-2xl overflow-hidden">
        <!-- Modal Header (Sticky) -->
        <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4 flex-shrink-0 bg-white">
            <div>
                <h2 class="text-lg font-bold text-slate-900" id="pendaftaran-modal-title">Form Pendaftaran</h2>
                <p class="text-xs text-slate-400 mt-0.5">Lengkapi data diri dan refleksi calon anggota</p>
            </div>
            <button type="button" data-modal-close="pendaftaran-modal" class="rounded-lg p-2 text-2xl leading-none text-slate-400 hover:bg-slate-100 hover:text-slate-700 transition" aria-label="Tutup form pendaftaran">&times;</button>
        </div>

        <!-- Modal Body (Scrollable) -->
        <div class="px-5 py-4 sm:py-5 overflow-y-auto">
            <form id="pendaftaran-form" action="{{ route('pendaftaran.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="UserId" value="{{ Auth::id() }}">

                {{-- Input: Nama --}}
                <div class="mb-3">
                    <label for="pendaftaran-nama" class="mb-1 block text-sm font-medium text-slate-700">Nama</label>
                    <input 
                        id="pendaftaran-nama" 
                        type="text" 
                        value="{{ Auth::user()->Nama ?? Auth::user()->name ?? ($user->Nama ?? '') }}" 
                        class="w-full rounded-lg border border-slate-300 bg-slate-100 px-3 py-2 text-slate-500 cursor-not-allowed" 
                        disabled
                    >
                    <small class="text-xs text-slate-400">*Nama terisi otomatis berdasarkan akun Anda</small>
                </div>                                                  

                {{-- Input: NPM --}}
                <div class="mb-3">
                    <label for="pendaftaran-npm" class="mb-1 block text-sm font-medium text-slate-700">NPM</label>
                    <input 
                        id="pendaftaran-npm" 
                        type="text" 
                        value="{{ Auth::user()->Npm ?? ($user->Npm ?? '') }}" 
                        class="w-full rounded-lg border border-slate-300 bg-slate-100 px-3 py-2 text-slate-500 cursor-not-allowed" 
                        disabled
                    >
                </div>

                {{-- SECTION: Inside Out Emotion Questionnaire --}}
                <div class="my-5 pt-4 border-t border-slate-200">
                    <div class="flex items-center justify-between gap-2 mb-3.5">
                        <div class="flex items-center gap-2">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-amber-50 via-rose-50 to-purple-50 text-slate-800 border border-slate-200/80 shadow-xs">
                                <span class="inline-flex gap-1">
                                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                                </span>
                                Inside Out Reflection
                            </span>
                        </div>
                        <span class="text-[11px] text-slate-400 font-medium">Pilih 1 Emosi & Berikan Alasan</span>
                    </div>

                    {{-- Pertanyaan 1 --}}
                    <div class="mb-4 rounded-xl border border-slate-200 bg-slate-50/70 p-3.5 sm:p-4 transition hover:border-slate-300">
                        <label class="mb-2.5 block text-xs sm:text-sm font-semibold text-slate-800 leading-relaxed">
                            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-brand-blue/10 text-brand-blue font-bold text-[11px] mr-1.5 align-middle">1</span>
                            If you were one of the emotion characters in Inside Out, which emotion do you feel most often when you’re working with a team, and what usually brings it out?
                            <span class="text-red-500">*</span>
                        </label>

                        <p class="text-[11px] font-medium text-slate-500 mb-2">Pilih karakter emosi yang paling dominan:</p>
                        
                        {{-- 5 Emotion Options --}}
                        <div class="grid grid-cols-2 sm:grid-cols-5 gap-2 mb-3">
                            {{-- Joy (Kuning) --}}
                            <label class="relative flex items-center justify-center sm:justify-start gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-2 text-xs font-medium text-slate-700 cursor-pointer transition-all hover:border-amber-400 hover:bg-amber-50/40 has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50 has-[:checked]:text-amber-950 has-[:checked]:ring-2 has-[:checked]:ring-amber-300/60 shadow-xs select-none">
                                <input type="radio" name="Pertanyaan1_Emosi" value="Joy" class="w-3.5 h-3.5 text-amber-500 border-slate-300 focus:ring-amber-400 accent-amber-500 cursor-pointer" required>
                                <span class="h-2.5 w-2.5 flex-shrink-0 rounded-full bg-amber-400 ring-2 ring-amber-200"></span>
                                <span class="font-semibold">Joy</span>
                            </label>

                            {{-- Anger (Merah) --}}
                            <label class="relative flex items-center justify-center sm:justify-start gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-2 text-xs font-medium text-slate-700 cursor-pointer transition-all hover:border-red-400 hover:bg-red-50/40 has-[:checked]:border-red-500 has-[:checked]:bg-red-50 has-[:checked]:text-red-950 has-[:checked]:ring-2 has-[:checked]:ring-red-300/60 shadow-xs select-none">
                                <input type="radio" name="Pertanyaan1_Emosi" value="Anger" class="w-3.5 h-3.5 text-red-500 border-slate-300 focus:ring-red-400 accent-red-500 cursor-pointer">
                                <span class="h-2.5 w-2.5 flex-shrink-0 rounded-full bg-red-500 ring-2 ring-red-200"></span>
                                <span class="font-semibold">Anger</span>
                            </label>

                            {{-- Sadness (Biru) --}}
                            <label class="relative flex items-center justify-center sm:justify-start gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-2 text-xs font-medium text-slate-700 cursor-pointer transition-all hover:border-blue-400 hover:bg-blue-50/40 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50 has-[:checked]:text-blue-950 has-[:checked]:ring-2 has-[:checked]:ring-blue-300/60 shadow-xs select-none">
                                <input type="radio" name="Pertanyaan1_Emosi" value="Sadness" class="w-3.5 h-3.5 text-blue-500 border-slate-300 focus:ring-blue-400 accent-blue-500 cursor-pointer">
                                <span class="h-2.5 w-2.5 flex-shrink-0 rounded-full bg-blue-500 ring-2 ring-blue-200"></span>
                                <span class="font-semibold">Sadness</span>
                            </label>

                            {{-- Disgust (Hijau) --}}
                            <label class="relative flex items-center justify-center sm:justify-start gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-2 text-xs font-medium text-slate-700 cursor-pointer transition-all hover:border-emerald-400 hover:bg-emerald-50/40 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50 has-[:checked]:text-emerald-950 has-[:checked]:ring-2 has-[:checked]:ring-emerald-300/60 shadow-xs select-none">
                                <input type="radio" name="Pertanyaan1_Emosi" value="Disgust" class="w-3.5 h-3.5 text-emerald-500 border-slate-300 focus:ring-emerald-400 accent-emerald-500 cursor-pointer">
                                <span class="h-2.5 w-2.5 flex-shrink-0 rounded-full bg-emerald-500 ring-2 ring-emerald-200"></span>
                                <span class="font-semibold">Disgust</span>
                            </label>

                            {{-- Fear (Ungu) --}}
                            <label class="relative flex items-center justify-center sm:justify-start gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-2 text-xs font-medium text-slate-700 cursor-pointer transition-all hover:border-purple-400 hover:bg-purple-50/40 has-[:checked]:border-purple-500 has-[:checked]:bg-purple-50 has-[:checked]:text-purple-950 has-[:checked]:ring-2 has-[:checked]:ring-purple-300/60 shadow-xs select-none col-span-2 sm:col-span-1">
                                <input type="radio" name="Pertanyaan1_Emosi" value="Fear" class="w-3.5 h-3.5 text-purple-500 border-slate-300 focus:ring-purple-400 accent-purple-500 cursor-pointer">
                                <span class="h-2.5 w-2.5 flex-shrink-0 rounded-full bg-purple-500 ring-2 ring-purple-200"></span>
                                <span class="font-semibold">Fear</span>
                            </label>
                        </div>

                        {{-- Textarea Alasan --}}
                        <div>
                            <label for="pendaftaran-alasan-1" class="mb-1 block text-xs font-medium text-slate-600">
                                Alasan & Penjelasan <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                id="pendaftaran-alasan-1" 
                                name="Pertanyaan1_Alasan" 
                                rows="2" 
                                class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-xs sm:text-sm text-slate-700 placeholder-slate-400 focus:border-brand-blue focus:outline-none focus:ring-1 focus:ring-brand-blue transition resize-none" 
                                placeholder="Ceritakan alasan memilih emosi ini dan apa yang biasanya memicunya saat bekerja dalam tim..."
                                required
                            ></textarea>
                        </div>
                    </div>

                    {{-- Pertanyaan 2 --}}
                    <div class="mb-4 rounded-xl border border-slate-200 bg-slate-50/70 p-3.5 sm:p-4 transition hover:border-slate-300">
                        <label class="mb-2.5 block text-xs sm:text-sm font-semibold text-slate-800 leading-relaxed">
                            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-brand-blue/10 text-brand-blue font-bold text-[11px] mr-1.5 align-middle">2</span>
                            If you were one of the emotion characters in Inside Out, when challenges or disagreements happen in your team, which emotion tends to take over—and what helps you handle it?
                            <span class="text-red-500">*</span>
                        </label>

                        <p class="text-[11px] font-medium text-slate-500 mb-2">Pilih karakter emosi yang paling dominan:</p>
                        
                        {{-- 5 Emotion Options --}}
                        <div class="grid grid-cols-2 sm:grid-cols-5 gap-2 mb-3">
                            {{-- Joy (Kuning) --}}
                            <label class="relative flex items-center justify-center sm:justify-start gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-2 text-xs font-medium text-slate-700 cursor-pointer transition-all hover:border-amber-400 hover:bg-amber-50/40 has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50 has-[:checked]:text-amber-950 has-[:checked]:ring-2 has-[:checked]:ring-amber-300/60 shadow-xs select-none">
                                <input type="radio" name="Pertanyaan2_Emosi" value="Joy" class="w-3.5 h-3.5 text-amber-500 border-slate-300 focus:ring-amber-400 accent-amber-500 cursor-pointer" required>
                                <span class="h-2.5 w-2.5 flex-shrink-0 rounded-full bg-amber-400 ring-2 ring-amber-200"></span>
                                <span class="font-semibold">Joy</span>
                            </label>

                            {{-- Anger (Merah) --}}
                            <label class="relative flex items-center justify-center sm:justify-start gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-2 text-xs font-medium text-slate-700 cursor-pointer transition-all hover:border-red-400 hover:bg-red-50/40 has-[:checked]:border-red-500 has-[:checked]:bg-red-50 has-[:checked]:text-red-950 has-[:checked]:ring-2 has-[:checked]:ring-red-300/60 shadow-xs select-none">
                                <input type="radio" name="Pertanyaan2_Emosi" value="Anger" class="w-3.5 h-3.5 text-red-500 border-slate-300 focus:ring-red-400 accent-red-500 cursor-pointer">
                                <span class="h-2.5 w-2.5 flex-shrink-0 rounded-full bg-red-500 ring-2 ring-red-200"></span>
                                <span class="font-semibold">Anger</span>
                            </label>

                            {{-- Sadness (Biru) --}}
                            <label class="relative flex items-center justify-center sm:justify-start gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-2 text-xs font-medium text-slate-700 cursor-pointer transition-all hover:border-blue-400 hover:bg-blue-50/40 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50 has-[:checked]:text-blue-950 has-[:checked]:ring-2 has-[:checked]:ring-blue-300/60 shadow-xs select-none">
                                <input type="radio" name="Pertanyaan2_Emosi" value="Sadness" class="w-3.5 h-3.5 text-blue-500 border-slate-300 focus:ring-blue-400 accent-blue-500 cursor-pointer">
                                <span class="h-2.5 w-2.5 flex-shrink-0 rounded-full bg-blue-500 ring-2 ring-blue-200"></span>
                                <span class="font-semibold">Sadness</span>
                            </label>

                            {{-- Disgust (Hijau) --}}
                            <label class="relative flex items-center justify-center sm:justify-start gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-2 text-xs font-medium text-slate-700 cursor-pointer transition-all hover:border-emerald-400 hover:bg-emerald-50/40 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50 has-[:checked]:text-emerald-950 has-[:checked]:ring-2 has-[:checked]:ring-emerald-300/60 shadow-xs select-none">
                                <input type="radio" name="Pertanyaan2_Emosi" value="Disgust" class="w-3.5 h-3.5 text-emerald-500 border-slate-300 focus:ring-emerald-400 accent-emerald-500 cursor-pointer">
                                <span class="h-2.5 w-2.5 flex-shrink-0 rounded-full bg-emerald-500 ring-2 ring-emerald-200"></span>
                                <span class="font-semibold">Disgust</span>
                            </label>

                            {{-- Fear (Ungu) --}}
                            <label class="relative flex items-center justify-center sm:justify-start gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-2 text-xs font-medium text-slate-700 cursor-pointer transition-all hover:border-purple-400 hover:bg-purple-50/40 has-[:checked]:border-purple-500 has-[:checked]:bg-purple-50 has-[:checked]:text-purple-950 has-[:checked]:ring-2 has-[:checked]:ring-purple-300/60 shadow-xs select-none col-span-2 sm:col-span-1">
                                <input type="radio" name="Pertanyaan2_Emosi" value="Fear" class="w-3.5 h-3.5 text-purple-500 border-slate-300 focus:ring-purple-400 accent-purple-500 cursor-pointer">
                                <span class="h-2.5 w-2.5 flex-shrink-0 rounded-full bg-purple-500 ring-2 ring-purple-200"></span>
                                <span class="font-semibold">Fear</span>
                            </label>
                        </div>

                        {{-- Textarea Alasan --}}
                        <div>
                            <label for="pendaftaran-alasan-2" class="mb-1 block text-xs font-medium text-slate-600">
                                Alasan & Penjelasan <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                id="pendaftaran-alasan-2" 
                                name="Pertanyaan2_Alasan" 
                                rows="2" 
                                class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-xs sm:text-sm text-slate-700 placeholder-slate-400 focus:border-brand-blue focus:outline-none focus:ring-1 focus:ring-brand-blue transition resize-none" 
                                placeholder="Ceritakan mengapa emosi ini muncul saat tantangan/perbedaan pendapat dan apa yang membantumu mengatasinya..."
                                required
                            ></textarea>
                        </div>
                    </div>

                    {{-- Pertanyaan 3 --}}
                    <div class="mb-4 rounded-xl border border-slate-200 bg-slate-50/70 p-3.5 sm:p-4 transition hover:border-slate-300">
                        <label class="mb-2.5 block text-xs sm:text-sm font-semibold text-slate-800 leading-relaxed">
                            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-brand-blue/10 text-brand-blue font-bold text-[11px] mr-1.5 align-middle">3</span>
                            If you were one of the emotion characters in Inside Out, when you’re facing something new or unfamiliar, which emotion usually speaks the loudest inside you?
                            <span class="text-red-500">*</span>
                        </label>

                        <p class="text-[11px] font-medium text-slate-500 mb-2">Pilih karakter emosi yang paling dominan:</p>
                        
                        {{-- 5 Emotion Options --}}
                        <div class="grid grid-cols-2 sm:grid-cols-5 gap-2 mb-3">
                            {{-- Joy (Kuning) --}}
                            <label class="relative flex items-center justify-center sm:justify-start gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-2 text-xs font-medium text-slate-700 cursor-pointer transition-all hover:border-amber-400 hover:bg-amber-50/40 has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50 has-[:checked]:text-amber-950 has-[:checked]:ring-2 has-[:checked]:ring-amber-300/60 shadow-xs select-none">
                                <input type="radio" name="Pertanyaan3_Emosi" value="Joy" class="w-3.5 h-3.5 text-amber-500 border-slate-300 focus:ring-amber-400 accent-amber-500 cursor-pointer" required>
                                <span class="h-2.5 w-2.5 flex-shrink-0 rounded-full bg-amber-400 ring-2 ring-amber-200"></span>
                                <span class="font-semibold">Joy</span>
                            </label>

                            {{-- Anger (Merah) --}}
                            <label class="relative flex items-center justify-center sm:justify-start gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-2 text-xs font-medium text-slate-700 cursor-pointer transition-all hover:border-red-400 hover:bg-red-50/40 has-[:checked]:border-red-500 has-[:checked]:bg-red-50 has-[:checked]:text-red-950 has-[:checked]:ring-2 has-[:checked]:ring-red-300/60 shadow-xs select-none">
                                <input type="radio" name="Pertanyaan3_Emosi" value="Anger" class="w-3.5 h-3.5 text-red-500 border-slate-300 focus:ring-red-400 accent-red-500 cursor-pointer">
                                <span class="h-2.5 w-2.5 flex-shrink-0 rounded-full bg-red-500 ring-2 ring-red-200"></span>
                                <span class="font-semibold">Anger</span>
                            </label>

                            {{-- Sadness (Biru) --}}
                            <label class="relative flex items-center justify-center sm:justify-start gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-2 text-xs font-medium text-slate-700 cursor-pointer transition-all hover:border-blue-400 hover:bg-blue-50/40 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50 has-[:checked]:text-blue-950 has-[:checked]:ring-2 has-[:checked]:ring-blue-300/60 shadow-xs select-none">
                                <input type="radio" name="Pertanyaan3_Emosi" value="Sadness" class="w-3.5 h-3.5 text-blue-500 border-slate-300 focus:ring-blue-400 accent-blue-500 cursor-pointer">
                                <span class="h-2.5 w-2.5 flex-shrink-0 rounded-full bg-blue-500 ring-2 ring-blue-200"></span>
                                <span class="font-semibold">Sadness</span>
                            </label>

                            {{-- Disgust (Hijau) --}}
                            <label class="relative flex items-center justify-center sm:justify-start gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-2 text-xs font-medium text-slate-700 cursor-pointer transition-all hover:border-emerald-400 hover:bg-emerald-50/40 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50 has-[:checked]:text-emerald-950 has-[:checked]:ring-2 has-[:checked]:ring-emerald-300/60 shadow-xs select-none">
                                <input type="radio" name="Pertanyaan3_Emosi" value="Disgust" class="w-3.5 h-3.5 text-emerald-500 border-slate-300 focus:ring-emerald-400 accent-emerald-500 cursor-pointer">
                                <span class="h-2.5 w-2.5 flex-shrink-0 rounded-full bg-emerald-500 ring-2 ring-emerald-200"></span>
                                <span class="font-semibold">Disgust</span>
                            </label>

                            {{-- Fear (Ungu) --}}
                            <label class="relative flex items-center justify-center sm:justify-start gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-2 text-xs font-medium text-slate-700 cursor-pointer transition-all hover:border-purple-400 hover:bg-purple-50/40 has-[:checked]:border-purple-500 has-[:checked]:bg-purple-50 has-[:checked]:text-purple-950 has-[:checked]:ring-2 has-[:checked]:ring-purple-300/60 shadow-xs select-none col-span-2 sm:col-span-1">
                                <input type="radio" name="Pertanyaan3_Emosi" value="Fear" class="w-3.5 h-3.5 text-purple-500 border-slate-300 focus:ring-purple-400 accent-purple-500 cursor-pointer">
                                <span class="h-2.5 w-2.5 flex-shrink-0 rounded-full bg-purple-500 ring-2 ring-purple-200"></span>
                                <span class="font-semibold">Fear</span>
                            </label>
                        </div>

                        {{-- Textarea Alasan --}}
                        <div>
                            <label for="pendaftaran-alasan-3" class="mb-1 block text-xs font-medium text-slate-600">
                                Alasan & Penjelasan <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                id="pendaftaran-alasan-3" 
                                name="Pertanyaan3_Alasan" 
                                rows="2" 
                                class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-xs sm:text-sm text-slate-700 placeholder-slate-400 focus:border-brand-blue focus:outline-none focus:ring-1 focus:ring-brand-blue transition resize-none" 
                                placeholder="Ceritakan mengapa emosi tersebut paling bersuara saat menghadapi situasi atau hal yang baru..."
                                required
                            ></textarea>
                        </div>
                    </div>
                </div>
                
                {{-- Input: Divisi 1 --}}
                <div class="mb-3">
                    <label for="pendaftaran-divisi-1" class="mb-1 block text-sm font-medium text-slate-700">Divisi Pilihan 1 <span class="text-red-500">*</span></label>
                    <select name="Divisi" id="pendaftaran-divisi-1" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 focus:border-brand-blue focus:outline-none focus:ring-1 focus:ring-brand-blue transition" required>
                        <option value="" disabled selected>-- Pilih Divisi 1 --</option>
                        <option value="Bendahara">Bendahara</option>
                        <option value="Sekretaris">Sekretaris</option>
                        <option value="Human Resources">Human Resources</option>
                        <option value="Public Relation">Public Relation</option>
                        <option value="Curiculum">Curiculum</option>
                        <option value="Media & Information">Media & Information</option>
                    </select>
                </div>

                {{-- Input: Divisi 2 --}}
                <div class="mb-3">
                    <label for="pendaftaran-divisi-2" class="mb-1 block text-sm font-medium text-slate-700">Divisi Pilihan 2 <span class="text-red-500">*</span></label>
                    <select name="Divisi2" id="pendaftaran-divisi-2" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-800 focus:border-brand-blue focus:outline-none focus:ring-1 focus:ring-brand-blue transition" required>
                        <option value="" disabled selected>-- Pilih Divisi 2 --</option>
                        <option value="Bendahara">Bendahara</option>
                        <option value="Sekretaris">Sekretaris</option>
                        <option value="Human Resources">Human Resources</option>
                        <option value="Public Relation">Public Relation</option>
                        <option value="Curiculum">Curiculum</option>
                        <option value="Media & Information">Media & Information</option>
                    </select>
                    <small class="text-xs text-slate-400">Pilihan divisi tidak boleh sama</small>
                </div>

                {{-- Input: Foto --}}
                <div class="mb-3">
                    <label for="pendaftaran-foto" class="mb-1 block text-sm font-medium text-slate-700">Foto Pribadi<span class="text-red-500">*</span></label>
                    <input type="file" name="Foto" id="pendaftaran-foto" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 file:mr-3 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-brand-blue hover:file:bg-blue-100 cursor-pointer" accept="image/*" required>
                    <small class="text-xs text-slate-400">Format JPG/PNG, maksimal 2MB</small>
                </div>

                {{-- Input: CV --}}
                <div class="mb-3">
                    <label for="pendaftaran-cv" class="mb-1 block text-sm font-medium text-slate-700">Upload CV (PDF) <span class="text-red-500">*</span></label>
                    <input type="file" name="BerkasCV" id="pendaftaran-cv" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 file:mr-3 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-brand-blue hover:file:bg-blue-100 cursor-pointer" accept="application/pdf" required>
                    <small class="text-xs text-slate-400">Format PDF, maksimal 2MB</small>
                </div>

                {{-- Input: Portofolio --}}
                <div class="mb-4">
                    <label for="pendaftaran-portofolio" class="mb-1 block text-sm font-medium text-slate-700">Upload Portofolio Opsional (PDF) <small class="text-xs text-slate-400">*Wajib jika memilih divisi Medinfo</small></label>
                    <input type="file" name="Portofolio" id="pendaftaran-portofolio" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 file:mr-3 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-600 hover:file:bg-slate-200 cursor-pointer" accept="application/pdf">
                    <small class="text-xs text-slate-400">Format PDF, maksimal 5MB (opsional)</small>
                </div>

                {{-- Submit Button --}}
                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-3">
                    <button type="button" data-modal-close="pendaftaran-modal" class="w-full sm:w-auto rounded-xl border border-slate-200 px-5 py-2.5 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">Batal</button>
                    <button type="submit" id="pendaftaran-submit-btn" class="w-full sm:w-auto rounded-xl bg-brand-blue px-6 py-2.5 text-xs sm:text-sm font-semibold text-white hover:bg-blue-800 shadow-md transition flex items-center justify-center gap-2 cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed">
                        <span id="pendaftaran-btn-text">Kirim Pendaftaran</span>
                        <span id="pendaftaran-btn-loading" class="hidden items-center gap-2">
                            <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            <span>Mengirim...</span>
                        </span>
                    </button>
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

        // Double submit prevention
        const pendaftaranForm = document.getElementById('pendaftaran-form');
        const submitBtn = document.getElementById('pendaftaran-submit-btn');
        const btnText = document.getElementById('pendaftaran-btn-text');
        const btnLoading = document.getElementById('pendaftaran-btn-loading');

        if (pendaftaranForm && submitBtn) {
            pendaftaranForm.addEventListener('submit', (e) => {
                if (submitBtn.disabled) {
                    e.preventDefault();
                    return;
                }
                submitBtn.disabled = true;
                btnText.classList.add('hidden');
                btnLoading.classList.remove('hidden');
                btnLoading.classList.add('flex');
            });
        }
    })();
</script>