<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_sesi', function (Blueprint $table) {
            $table->increments('SesiId');
            $table->string('NamaSesi', 50);
            $table->date('TanggalMulai');
            $table->date('TanggalSelesai');
            $table->time('Jam');
            $table->string('Lokasi', 50)->nullable();
            $table->boolean('IsActive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_sesi');
    }
};
