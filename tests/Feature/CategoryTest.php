<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CategoryTest extends TestCase
{
//   use RefreshDatabase;
//     public function test_logout(): void
//     {
//         $email =    'test@test.com';
//         $password = '12345678';

//         $user = \App\Models\User::factory()->create([
//             'email' => $email,
//             'password' => Hash::make($password)
//         ]);

//         $response = $this->postJson('/api/login', [
//             'email' => $user->email,
//             'password' => $password
//         ]);

//         $response = $this->json('POST', '/api/logout', [], ['Authorization' => "Bearer ". $response->json('token')]);
//         $response->assertStatus(200);
//     }
}
