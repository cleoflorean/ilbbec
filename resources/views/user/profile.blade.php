@extends('layouts.app-user')

@section('content')
<main class="bg-slate-50 py-10 px-4 sm:px-6 lg:px-8 font-sans">
  <div class="max-w-4xl mx-auto space-y-6">
    
    <!-- 1. Header Card (Foto, Nama, Status) -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6 sm:p-8">
      <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
        
        <!-- Avatar / Foto Profil -->
        <div class="relative">
          <img 
            alt="Foto Profil" 
            class="w-28 h-28 sm:w-32 sm:h-32 rounded-full object-cover border-4 border-blue-50 shadow-md"
          />
        </div>

        <!-- Informasi Utama & Tombol Aksi -->
        <div x-data="{ openEditModal: false }" class="flex-1 text-center sm:text-left space-y-3">
          <div>
            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2 mb-1">
              <h1 class="text-2xl font-bold text-slate-800">{{ $user->Nama }}</h1>
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200">
                Mahasiswa Aktif
              </span>
            </div>
            <p class="text-slate-500 font-medium">NPM: {{ $user->Npm }}</p>
          </div>

          <!-- Tombol Aksi -->
          <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3 pt-2">
            <button @click="openEditModal = true" type="button" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition shadow-sm">
              <svg class="w-4 h-4" fill="none" stroke="currentColor"p viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z"></path></svg>
              Edit Profil
            </button>
          </div>
        </div>
        @include('modals.edit-profile')
      </div>
    </div>

    <!-- 2. Detail Data Diri (Grid Cards) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      
      <!-- Kartu Informasi Kontak & Akademik -->
      <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6 space-y-4">
        <h2 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-3 flex items-center gap-2">
          <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
          Informasi Pribadi
        </h2>

        <div class="space-y-3 text-sm">
          <div class="flex justify-between items-center py-1">
            <span class="text-slate-500">Email</span>
            <span class="font-medium text-slate-800">{{ $user->Email }}</span>
          </div>
          <div class="flex justify-between items-center py-1 border-t border-slate-50">
            <span class="text-slate-500">Nomor HP / WhatsApp</span>
            <span class="font-medium text-slate-800">{{ $user->NoTlp }}</span>
          </div>
          <div class="flex justify-between items-center py-1 border-t border-slate-50">
            <span class="text-slate-500">Tanggal Lahir</span>
            <span class="font-medium text-slate-800">{{ $user->TanggalLahir->format('d F Y') }}</span>
          </div>
        </div>
      </div>

      <!-- Kartu Organisasi & Akademik -->
      <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6 space-y-4">
        <h2 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-3 flex items-center gap-2">
          <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h5m-5 0V12m0 8V8"></path></svg>
          Akademik & Organisasi
        </h2>

        <div class="space-y-3 text-sm">
          <div class="flex justify-between items-center py-1 border-t border-slate-50">
            <span class="text-slate-500">Program Studi</span>
            <span class="font-medium text-slate-800">{{ $user->prodi->NamaProdi ?? '-' }}</span>
          </div>
          <div class="flex justify-between items-center py-1 border-t border-slate-50">
            <span class="text-slate-500">Divisi Pilihan</span>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold bg-emerald-50 text-emerald-700">{{ $pendaftaran->Divisi ?? '-' }}</span>
          </div>
          <div class="flex justify-between items-center py-1 border-t border-slate-50">
            <span class="text-slate-500">Tahap Rekrutmen</span>
            <span class="text-xs font-semibold text-emerald-600 flex   items-center gap-1">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ $tahapAktif['nama'] }}
            </span>
          </div>
        </div>
      </div>

    </div>

  </div>
</main>
@endsection