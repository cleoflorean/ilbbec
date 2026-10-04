<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Skema tabel relasi untuk menampung jawaban kuesioner Inside Out refleksi calon anggota.
     */
    public function up(): void
    {
        Schema::create('pendaftaran_refleksi', function (Blueprint $table) {
            $table->increments('RefleksiId');
            $table->unsignedInteger('PendaftaranId');

            // Pertanyaan 1: Emosi saat bekerja dalam tim & pemicunya
            $table->enum('Pertanyaan1_Emosi', ['Joy', 'Anger', 'Sadness', 'Disgust', 'Fear']);
            $table->text('Pertanyaan1_Alasan');

            // Pertanyaan 2: Emosi saat menghadapi perbedaan/tantangan & cara mengatasi
            $table->enum('Pertanyaan2_Emosi', ['Joy', 'Anger', 'Sadness', 'Disgust', 'Fear']);
            $table->text('Pertanyaan2_Alasan');

            // Pertanyaan 3: Emosi saat menghadapi hal baru/asing
            $table->enum('Pertanyaan3_Emosi', ['Joy', 'Anger', 'Sadness', 'Disgust', 'Fear']);
            $table->text('Pertanyaan3_Alasan');

            $table->timestamps();

            // Relasi One-to-One dengan tabel pendaftaran (Cascade on delete)
            $table->foreign('PendaftaranId')
                  ->references('PendaftaranId')
                  ->on('pendaftaran')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_refleksi');
    }
};
