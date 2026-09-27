<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwal_sesi', function (Blueprint $table) {
            if (!Schema::hasColumn('jadwal_sesi', 'keterangan')) {
                $table->text('keterangan')->nullable()->after('Lokasi');
            }
            if (!Schema::hasColumn('jadwal_sesi', 'status')) {
                $table->string('status', 20)->default('available')->after('IsActive');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jadwal_sesi', function (Blueprint $table) {
            if (Schema::hasColumn('jadwal_sesi', 'keterangan')) {
                $table->dropColumn('keterangan');
            }
            if (Schema::hasColumn('jadwal_sesi', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
