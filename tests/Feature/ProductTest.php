<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    public function test_get_valid_products(): void
    {

        // Category::factory()->create([
        //     'CategoryName' => 'testcategory',
        //     'CategoryId' => 1
        // ]);
        $categories =\App\Models\Category::factory()->create([
            'CategoryName' => 'testcategory',
            'CategoryId' => 1
        ]);
        Product::factory()->create([
            'ProductNumber' => 1,
            'ProductName' => 'testproduct',
            'ProductDescription' => 'testproductdescription',
            'RetailPrice' => 1000,
            'QuantityOnHand' => 10,
            'CategoryID' => $categories->CategoryId,
            'Image' => 'testimage.jpg',
        ]);
        $response = $this->getJson('/api/products');
        $response->assertStatus(200);
        // dd($response[0]);
        $response->assertJson([
            [
                'ProductNumber' => 1,
                'ProductName' => 'testproduct',
                'ProductDescription' => 'testproductdescription',
                'RetailPrice' => 1000,
                'QuantityOnHand' => 10,
                'CategoryID' => 1,
                'Image' => 'testimage.jpg',
            ]
        ]);
    }
}
