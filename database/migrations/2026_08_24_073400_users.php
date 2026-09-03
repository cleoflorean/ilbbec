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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('UserId');
            $table->unsignedInteger('ProdiId')->nullable();
            $table->string('Nama', 100);
            $table->integer('Npm');
            $table->string('TempatLahir', 50);
            $table->date('TanggalLahir');
            $table->string('NoTlp', 15);
            $table->string('Email', 50)->unique();
            $table->string('Password', 255);
            $table->integer('Angkatan');
            $table->string('Role', 15);
            $table->timestamps();

            $table->foreign('ProdiId')->references('ProdiId')->on('prodi')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
