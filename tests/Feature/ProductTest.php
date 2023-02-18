<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductTest extends TestCase
{
    public $token = '3|ZZojHtejrUKMIgXwbqyCllW1dOlgBW9fdGAKD2rK';
    
    public function test_get_all_products()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token,
        ])->get('/api/products');

        $response->assertStatus(200)
                 ->assertJsonStructure(
                    [
                        'success',
                        'message',
                        'data' => [
                            '*' => [
                                'id',
                                'name',
                                'slug',
                                'image',
                                'description',
                                'price',
                                'created_at',
                                'updated_at',
                            ],
                        ],
                    ]
                );
    }

    public function test_get_detail_product()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token,
        ])->get('/api/products/1');

        $response->assertStatus(200)
                 ->assertJsonStructure(
                    [
                        'success',
                        'message',
                        'data' => [
                            'id',
                            'name',
                            'slug',
                            'image',
                            'description',
                            'price',
                            'created_at',
                            'updated_at',
                        ],
                    ]
                );
    }

    public function test_create_product()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token,
        ])->post('/api/products', [
            'name' => 'Test Book',
            'slug' => 'test-book',
            'image' => 'https://cdn.pixabay.com/photo/2015/11/19/21/10/glasses-1052010_960_720.jpg',
            'description' => 'this is a test book',
            'price' => 150000,

        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(
                    [
                        'success',
                        'message',
                        'data' => [
                            'id',
                            'name',
                            'slug',
                            'image',
                            'description',
                            'price',
                            'created_at',
                            'updated_at',
                        ],
                    ]
                );
    }
}
