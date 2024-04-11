<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    public function test_get_valid_categories(): void
    {
        Category::factory()->create([
            'CategoryName' => 'testcategory',
            'CategoryId' => 1

        ]);
        $response = $this->getJson('/api/categories');
        $response->assertStatus(200);
        //dd($response[0]);
        $response->assertJson([
            [
                'CategoryName' => 'testcategory',
                'CategoryId' => 1
            ]
        ]);
    }

    public function test_try_get_categories_with_invalid_root(): void{
        $response = $this->getJson('/api/categoriess', []);
        $response->assertStatus(404);
    }
}
