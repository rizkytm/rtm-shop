<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class CartTest extends TestCase
{
    public $token = '3|ZZojHtejrUKMIgXwbqyCllW1dOlgBW9fdGAKD2rK';
    
    public function test_get_cart()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token,
        ])->get('/api/cart');

        $response->assertStatus(200)
                 ->assertJsonStructure(
                    [
                        'success',
                        'message',
                        'data' => [
                            '*' => [
                                'id',
                                'user_id',
                                'product_id',
                                'name',
                                'price',
                                'quantity',
                                'created_at',
                                'updated_at',
                            ],
                        ],
                    ]
                );
    }

    public function test_add_to_cart()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token,
        ])->post('/api/cart', [
            'product_id' => 1,
            'quantity' => 2,
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(
                    [
                        'success',
                        'message',
                        'data' => [
                            '*' => [
                                'id',
                                'user_id',
                                'product_id',
                                'name',
                                'price',
                                'quantity',
                                'created_at',
                                'updated_at',
                            ],
                        ],
                    ]
                );
    }

    public function test_remove_item_from_cart()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token,
        ])->post('/api/cart/remove', [
            'product_id' => 1,
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(
                    [
                        'success',
                        'message',
                        'data' => [
                            '*' => [
                                'id',
                                'user_id',
                                'product_id',
                                'name',
                                'price',
                                'quantity',
                                'created_at',
                                'updated_at',
                            ],
                        ],
                    ]
                );
    }

    public function test_clear_cart()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token,
        ])->post('/api/cart/clear', []);

        $response->assertStatus(200)
                 ->assertJsonStructure(
                    [
                        'success',
                        'message',
                        'data' => [],
                    ]
                );
    }
}
