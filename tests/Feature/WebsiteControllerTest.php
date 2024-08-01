<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WebsiteControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $token;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create([
            'password' => Hash::make('password123#'),
        ]);

        $this->token = $user->createToken('auth_token')->plainTextToken;
    }

    /** @test */
    public function it_creates_a_website_successfully(): void
    {

        $response = $this->postJson('/api/v1/websites', [
            'url' => 'https://testexample.com',
        ], [
            'Authorization' => 'Bearer ' . $this->token
        ]);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'url',
                    'created_at',
                ]
            ]);

        $this->assertDatabaseHas('websites', [
            'url' => 'https://testexample.com'
        ]);
    }

    /** @test */
    public function it_fails_to_create_a_website_with_invalid_data(): void
    {
        $response = $this->postJson('/api/v1/websites', [
            'url' => 'not-a-valid-url'
        ], [
            'Authorization' => 'Bearer ' . $this->token
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'The url field must be a valid URL.',
                'errors' => [
                    'url' => ['The url field must be a valid URL.']
                ]
            ]);
    }
}
