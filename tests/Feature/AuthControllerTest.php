<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123#'),
        ]);
    }

    /** @test */
    public function it_registers_a_user_successfully(): void
    {
        $response = $this->postJson('/api/v1/auth/register', [
            'name' => 'Test User',
            'email' => 'newtest@example.com',
            'password' => 'password123#',
            'password_confirmation' => 'password123#'
        ]);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'id',
            'name',
            'email',
            'created_at'
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'newtest@example.com',
            'name' => 'Test User'
        ]);
    }

    /** @test */
    public function it_logs_in_successfully_with_valid_credentials(): void
    {
        $response = $this->postJson('/api/v1/auth/login', [
            'email' => 'test@example.com',
            'password' => 'password123#',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'access_token',
            'token_type'
        ]);

        $response->assertJsonFragment([
            'message' => 'User has been logged in successfully!',
        ]);

        $responseData = $response->json();
        $this->assertNotEmpty($responseData['access_token']);
    }

    /** @test */
    public function it_fails_to_log_in_with_invalid_credentials(): void
    {
        $response = $this->postJson('/api/v1/auth/login', [
            'email' => 'test@example.com',
            'password' => 'wrongPassword',
        ]);

        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Incorrect data!'
        ]);
    }
}
