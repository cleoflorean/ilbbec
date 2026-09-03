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
        Schema::create('jadwal_sesi', function (Blueprint $table) {
            $table->increments('SesiId');
            $table->string('TanggalSesi', 20);
            $table->time('WaktuMulai');
            $table->string('Lokasi', 10);
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
