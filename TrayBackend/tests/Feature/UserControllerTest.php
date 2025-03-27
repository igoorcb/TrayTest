<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Mockery;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_complete_profile_returns_success_response()
    {
        $payload = [
            'email' => 'igor@test.com',
            'name' => 'Igor Braz',
            'cpf' => '12345678901',
            'birthdate' => '2000-10-10'
        ];

        $userDb = User::factory()->create([
            'email' => $payload['email'],
        ]);

        $fakeUser = new User($payload);

        $mock = Mockery::mock(UserService::class);
        $mock->shouldReceive('completeProfile')
            ->once()
            ->with($payload)
            ->andReturn($fakeUser);

        $this->app->instance(UserService::class, $mock);

        $response = $this->postJson('/api/complete-profile', $payload);

        $response->assertStatus(200)
                 ->assertJson([
                    'message' => 'Perfil atualizado com sucesso!',
                    'user' => [
                        'email' => 'igor@test.com',
                        'name' => 'Igor Braz',
                        'cpf' => '12345678901',
                        'birthdate' => '2000-10-10'
                    ]
                 ]);
    }
}
