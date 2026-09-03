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
        Schema::create('prodi', function (Blueprint $table) {
            $table->increments('ProdiId');
            $table->unsignedInteger('FakultasId')->nullable();
            $table->string('NamaProdi', 40);
            $table->timestamps();

            $table->foreign('FakultasId')->references('FakultasId')->on('fakultas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodi');
    }
};
