<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_is_redirected_to_user_dashboard(): void
    {
        $user = $this->createUser('user');

        $response = $this->post(route('login.post'), [
            'Email' => $user->Email,
            'Password' => 'password',
        ]);

        $response->assertRedirectToRoute('user.home');
        $this->assertAuthenticatedAs($user);
    }

    public function test_admin_is_redirected_to_admin_dashboard(): void
    {
        $admin = $this->createUser('admin');

        $response = $this->post(route('login.post'), [
            'Email' => $admin->Email,
            'Password' => 'password',
        ]);

        $response->assertRedirectToRoute('admin.home');
        $this->assertAuthenticatedAs($admin);
    }

    public function test_dashboard_access_is_limited_by_role(): void
    {
        $user = $this->createUser('user');
        $this->actingAs($user);

        $this->get(route('user.home'))->assertOk();
        $this->get(route('admin.home'))->assertForbidden();
    }

    private function createUser(string $role): User
    {
        return User::create([
            'Nama' => ucfirst($role),
            'Npm' => $role === 'admin' ? 100002 : 100001,
            'TempatLahir' => 'Jakarta',
            'TanggalLahir' => '2000-01-01',
            'NoTlp' => '08123456789',
            'Email' => $role . '@example.com',
            'Password' => Hash::make('password'),
            'Angkatan' => 2024,
            'Role' => $role,
        ]);
    }
}
