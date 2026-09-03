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
        Schema::create('study_case', function (Blueprint $table) {
            $table->increments('CaseId');
            $table->unsignedInteger('PendaftaranId');
            $table->unsignedInteger('SesiId')->nullable();
            $table->string('Lokasi', 10)->nullable();
            $table->string('Kelompok', 15)->nullable();
            $table->integer('NilaiKasus')->nullable();
            $table->text('Catatan')->nullable();
            $table->string('StatusKasus', 10)->nullable();
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
        Schema::dropIfExists('study_case');
    }
};
