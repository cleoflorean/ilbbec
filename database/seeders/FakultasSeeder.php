<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fakultas')->insert([
            ['FakultasId' => 1, 'NamaFakultas' => 'School of Information Technology', 'created_at' => now(), 'updated_at' => now()],
            ['FakultasId' => 2, 'NamaFakultas' => 'School of Business and Management', 'created_at' => now(), 'updated_at' => now()],
            ['FakultasId' => 3, 'NamaFakultas' => 'School of Logistics and Transport', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
