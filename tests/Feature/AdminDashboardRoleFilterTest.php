<?php

namespace Tests\Feature;

use App\Models\Pendaftaran;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminDashboardRoleFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_secretary_dashboard_only_shows_secretary_division_applications(): void
    {
        $secretary = $this->createUser('Sekretaris');

        $sekretarisCandidate = $this->createCandidate('Rina Sekretaris', 'rina@sekretaris.test', 'Sekretaris');
        $bendaharaCandidate = $this->createCandidate('Budi Bendahara', 'budi@bendahara.test', 'Bendahara');

        $this->actingAs($secretary);

        $response = $this->get(route('admin.home'));

        $response->assertOk();
        $response->assertSeeText('Rina Sekretaris');
        $response->assertDontSeeText('Budi Bendahara');
    }

    private function createUser(string $role): User
    {
        return User::create([
            'Nama' => ucfirst($role),
            'Npm' => 900000 + rand(1, 999),
            'TempatLahir' => 'Bandung',
            'TanggalLahir' => '2000-01-01',
            'NoTlp' => '08123456789',
            'Email' => strtolower($role) . '@example.com',
            'Password' => Hash::make('password'),
            'Angkatan' => 2024,
            'Role' => $role,
        ]);
    }

    private function createCandidate(string $nama, string $email, string $divisi): User
    {
        $user = User::create([
            'Nama' => $nama,
            'Npm' => rand(100000, 999999),
            'TempatLahir' => 'Jakarta',
            'TanggalLahir' => '2001-02-03',
            'NoTlp' => '08111111111',
            'Email' => $email,
            'Password' => Hash::make('password'),
            'Angkatan' => 2024,
            'Role' => 'user',
        ]);

        Pendaftaran::create([
            'UserId' => $user->UserId,
            'Divisi' => $divisi,
            'Divisi2' => 'Public Relation',
            'StatusBerkas' => 'Lolos',
            'StatusAkhir' => 'Lolos',
        ]);

        return $user;
    }
}
