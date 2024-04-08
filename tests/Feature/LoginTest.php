<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{

    use RefreshDatabase;
    public function test_user_login_with_valid_data(): void
    {
        $email =    'test@test.com';
        $password = '12345678';

        $user = \App\Models\User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        // dd($user);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => $password
        ]);

        // dd($response);

        $response->assertStatus(200);
        $response->assertJson(["user" => [
            'email' => $email,
        ]
        ]);

        $response->assertJsonStructure(['token']);
    }

    public function test_invalid_user_cannot_login_(): void
    {
        $email =    'non_existing_user@test.com';
        $password = '12345678';

        $response = $this->postJson('/api/login', [
            'email' => $email,
            'password' => $password
        ]);

        $response->assertStatus(401);
    }
}
