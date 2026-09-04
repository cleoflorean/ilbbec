<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('prodi')->insert([
            [
                'FakultasId' => 1,
                'NamaProdi'  => 'Teknik Informatika',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'FakultasId' => 1,
                'NamaProdi'  => 'Sistem Informasi',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'FakultasId' => 2,
                'NamaProdi'  => 'Manajemen',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}