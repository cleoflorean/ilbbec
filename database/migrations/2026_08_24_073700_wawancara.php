<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wawancara', function (Blueprint $table) {
            $table->increments('WawancaraId');
            $table->unsignedInteger('PendaftaranId');
            $table->unsignedInteger('SesiId')->nullable();
            $table->dateTime('Jadwal')->nullable();
            $table->string('Lokasi', 10)->nullable();
            $table->integer('NilaiWawancara')->nullable();
            $table->text('Catatan')->nullable();
            $table->string('StatusWawancara', 10)->nullable();
            $table->timestamps();

            $table->foreign('PendaftaranId')->references('PendaftaranId')->on('pendaftaran')->onDelete('cascade');
            $table->foreign('SesiId')->references('SesiId')->on('jadwal_sesi')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wawancara');
    }
};
