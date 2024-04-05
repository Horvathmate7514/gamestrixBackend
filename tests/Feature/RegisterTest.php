<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $name =    "Jóska";
        $email =    'aas@gmail.com';
        $adress =   '2676 Cserhátsurány Telep utca 4';
        $phone_number = '+5545555';
        $password = '12345678';

        $response = $this->post('/api/register', [
            'name' => $name,
            'email' => $email,
            'adress' => $adress,
            'phone_number' => $phone_number,
            'password' => $password
        ]);

        $response->assertSimilarJson([ "user" => [
            'name' => $name . "1",
            'email' => $email . "1",
            'adress' => $adress . "1",
            "phone_number" => $phone_number . "1",
            "role" => 0,
            "updated_at" =>  date("yyyy-mm-dd hh:mm:ss"),
            "created_at" =>  date("yyyy-mm-dd hh:mm:ss"),
            "id" => 54
        ],
          "token" => "123|itu1WByTgH9NFB7nyi92wiabZttFETJDqepToCKQcba46335"]);
    }
}
