<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_registration_success_with_valid_data(): void
    {
        $name =    "Jóska";
        $email =    'aaaa4444aaas@gmail.com';
        $adress =   '2676 Cserhátsurány Telep utca 4';
        $phone_number = '+5544445555';
        $password = '12345678';

        $response = $this->postJson('/api/register', [
            'name' => $name,
            'email' => $email,
            'adress' => $adress,
            'phone_number' => $phone_number,
            'password' => Hash::make($password)
                ]);

        $response->assertStatus(201);
        $response->assertJson([ "user" => [
            'name' => $name,
            'email' => $email,
            'adress' => $adress,
            'phone_number' => $phone_number,
            //  'password' => Hash::make($password)
            ]
        ]);
        $response->assertJsonStructure(['token']);

    }

    public function test_user_registration_fails_without_valid_data(): void
    {
        $response = $this->postJson('/api/register', []);

        $response->assertStatus(422);
    }
}
