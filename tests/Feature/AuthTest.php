<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    public function test_register_user()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/register', [
            'name' => 'Test User',
            'email' => 'test.user' . date('ymdhis') . '@test.com',
            'password' => '123456',
            'confirm_password' => '123456',
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(
                    [
                        'success',
                        'message',
                        'data' => [
                            'token',
                            'name',
                        ],
                    ]
                );
    }

    public function test_login_user()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/login', [
            'email' => 'test.user@test.com',
            'password' => '123456',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(
                    [
                        'success',
                        'message',
                        'data' => [
                            'token',
                            'name',
                        ],
                    ]
                );
    }
}
