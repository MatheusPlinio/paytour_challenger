<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_register_a_user()
    {
        $payload = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->postJson(route('api.register'), $payload);

        $response->assertCreated()
            ->assertJsonStructure(['user', 'token']);

        $this->assertDatabaseHas('users', ['email' => 'johndoe@example.com']);
    }

    /** @test */
    public function it_can_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password')
        ]);

        $payload = [
            'email' => $user->email,
            'password' => 'password',
        ];

        $response = $this->postJson(route('api.login'), $payload);

        $response->assertOk()
            ->assertJsonStructure(['user', 'token']);
    }

    /** @test */
    public function it_cannot_login_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password')
        ]);

        $payload = [
            'email' => $user->email,
            'password' => 'wrong-password',
        ];

        $response = $this->postJson(route('api.login'), $payload);

        $response->assertUnauthorized()
            ->assertJson(['message' => 'Credenciais inválidas']);
    }

    /** @test */
    public function it_can_get_authenticated_user_with_me_route()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->getJson(route('me'));

        $response->assertOk()
            ->assertJson(['id' => $user->id, 'email' => $user->email]);
    }

    /** @test */
    public function it_can_logout_authenticated_user()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->postJson(route('api.logout'));

        $response->assertOk()
            ->assertJson(['message' => 'Logout realizado com sucesso']);
    }
}
