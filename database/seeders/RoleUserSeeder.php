<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accounts = [
            [
                'Nama' => 'Admin ILBBEC',
                'Npm' => 100001,
                'Email' => 'admin@ilbbec.test',
                'Password' => 'admin123',
                'Role' => 'admin',
                'TempatLahir' => 'Bandung',
                'TanggalLahir' => '2000-01-01',
                'NoTlp' => '08111111111',
                'Angkatan' => 2024,
                'Gender' => 'Laki laki',
            ],
            [
                'Nama' => 'Sekretaris ILBBEC',
                'Npm' => 100002,
                'Email' => 'sekretaris@ilbbec.test',
                'Password' => 'sekretaris123',
                'Role' => 'Sekretaris',
                'TempatLahir' => 'Jakarta',
                'TanggalLahir' => '2000-02-02',
                'NoTlp' => '08222222222',
                'Angkatan' => 2024,
                'Gender' => 'Perempuan',
            ],
            [
                'Nama' => 'Bendahara ILBBEC',
                'Npm' => 100003,
                'Email' => 'bendahara@ilbbec.test',
                'Password' => 'bendahara123',
                'Role' => 'Bendahara',
                'TempatLahir' => 'Bandung',
                'TanggalLahir' => '2000-03-03',
                'NoTlp' => '08333333333',
                'Angkatan' => 2024,
                'Gender' => 'Laki laki',
            ],
            [
                'Nama' => 'HR ILBBEC',
                'Npm' => 100004,
                'Email' => 'hr@ilbbec.test',
                'Password' => 'hr123',
                'Role' => 'HR',
                'TempatLahir' => 'Surabaya',
                'TanggalLahir' => '2000-04-04',
                'NoTlp' => '08444444444',
                'Angkatan' => 2024,
                'Gender' => 'Perempuan',
            ],
            [
                'Nama' => 'CC ILBBEC',
                'Npm' => 100005,
                'Email' => 'cc@ilbbec.test',
                'Password' => 'cc123',
                'Role' => 'CC',
                'TempatLahir' => 'Yogyakarta',
                'TanggalLahir' => '2000-05-05',
                'NoTlp' => '08555555555',
                'Angkatan' => 2024,
                'Gender' => 'Laki laki',
            ],
            [
                'Nama' => 'PR ILBBEC',
                'Npm' => 100006,
                'Email' => 'pr@ilbbec.test',
                'Password' => 'pr123',
                'Role' => 'PR',
                'TempatLahir' => 'Semarang',
                'TanggalLahir' => '2000-06-06',
                'NoTlp' => '08666666666',
                'Angkatan' => 2024,
                'Gender' => 'Perempuan',
            ],
            [
                'Nama' => 'Medinfo ILBBEC',
                'Npm' => 100007,
                'Email' => 'medinfo@ilbbec.test',
                'Password' => 'medinfo123',
                'Role' => 'Medinfo',
                'TempatLahir' => 'Bogor',
                'TanggalLahir' => '2000-07-07',
                'NoTlp' => '08777777777',
                'Angkatan' => 2024,
                'Gender' => 'Laki laki',
            ],
            [
                'Nama' => 'User ILBBEC',
                'Npm' => 100008,
                'Email' => 'user@ilbbec.test',
                'Password' => 'user123',
                'Role' => 'user',
                'TempatLahir' => 'Depok',
                'TanggalLahir' => '2000-08-08',
                'NoTlp' => '08888888888',
                'Angkatan' => 2024,
                'Gender' => 'Perempuan',
            ],
        ];

        foreach ($accounts as $account) {
            User::firstOrCreate(
                ['Email' => strtolower($account['Email'])],
                [
                    'ProdiId' => null,
                    'Nama' => $account['Nama'],
                    'Npm' => $account['Npm'],
                    'TempatLahir' => $account['TempatLahir'],
                    'TanggalLahir' => $account['TanggalLahir'],
                    'NoTlp' => $account['NoTlp'],
                    'Email' => strtolower($account['Email']),
                    'Password' => Hash::make($account['Password']),
                    'Angkatan' => $account['Angkatan'],
                    'Role' => $account['Role'],
                    'Gender' => $account['Gender'],
                ]
            );
        }
    }
}
