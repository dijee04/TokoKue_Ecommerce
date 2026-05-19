<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class KurirAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_redirects_to_kurir_login()
    {
        $response = $this->get('/kurir/dashboard');
        
        $response->assertRedirect(route('kurir.login'));
    }

    public function test_courier_can_view_login_page()
    {
        $response = $this->get('/kurir/login');
        
        $response->assertStatus(200);
        $response->assertViewIs('kurir.auth.login');
    }

    public function test_courier_can_login_with_correct_credentials()
    {
        $courier = User::factory()->create([
            'role' => 'kurir',
            'password' => bcrypt($password = 'password123'),
        ]);

        $response = $this->post('/kurir/login', [
            'email' => $courier->email,
            'password' => $password,
        ]);

        $response->assertRedirect(route('kurir.dashboard'));
        $this->assertAuthenticatedAs($courier);
    }

    public function test_regular_user_cannot_login_as_courier()
    {
        $user = User::factory()->create([
            'role' => 'user',
            'password' => bcrypt($password = 'password123'),
        ]);

        $response = $this->post('/kurir/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_courier_can_logout()
    {
        $courier = User::factory()->create([
            'role' => 'kurir',
        ]);

        $response = $this->actingAs($courier)->post('/kurir/logout');

        $response->assertRedirect(route('kurir.login'));
        $this->assertGuest();
    }
}
