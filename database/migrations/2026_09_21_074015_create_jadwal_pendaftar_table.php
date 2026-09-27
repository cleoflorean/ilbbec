<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_pendaftar', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('PendaftaranId');
            $table->unsignedInteger('SesiId');
            $table->enum('status', [
                'dipilih',
                'dikonfirmasi',
                'selesai',
                'tidak_hadir',
                'dibatalkan'
            ])->default('dipilih');
            $table->timestamp('selected_at')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamps();

            $table->foreign('PendaftaranId')
                ->references('PendaftaranId')
                ->on('pendaftaran')
                ->cascadeOnDelete();

            $table->foreign('SesiId')
                ->references('SesiId')
                ->on('jadwal_sesi')
                ->cascadeOnDelete();

            /*
             * Satu pendaftar tidak boleh memiliki
             * dua assignment ke jadwal yang sama.
             */
            $table->unique([
                'PendaftaranId',
                'SesiId'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_pendaftar');
    }
};