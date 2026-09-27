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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->increments('PendaftaranId');
            $table->unsignedInteger('UserId');
            $table->string('Divisi', 50);
            $table->string('Divisi2', 50);
            $table->string('BerkasCV', 255)->nullable();
            $table->string('Portofolio', 255)->nullable();
            $table->string('StatusBerkas', 10);
            $table->string('StatusAkhir', 10);
            $table->timestamps();

            $table->foreign('UserId')->references('UserId')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
