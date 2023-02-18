<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Feature\AuthTest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderTest extends TestCase
{
    public $token = '';

    public function auth_login()
    {
        $auth = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/login', [
            'email' => 'test.user@test.com',
            'password' => '123456',
        ])->decodeResponseJson();

        $this->token = $auth['data']['token'];
    }
    
    public function test_get_all_orders()
    {
        $this->auth_login();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token,
        ])->get('/api/order');

        $response->assertStatus(200)
                 ->assertJsonStructure(
                    [
                        'success',
                        'message',
                        'data' => [
                            '*' => [
                                'id',
                                'user_id',
                                'invoice_code',
                                'grand_total',
                                'address',
                                'payment_status',
                                'created_at',
                                'updated_at',
                                'details' => [
                                    '*' => [
                                        'id',
                                        'user_id',
                                        'product_id',
                                        'invoice_code',
                                        'name',
                                        'quantity',
                                        'price',
                                        'total_price',
                                        'created_at',
                                        'updated_at',
                                    ]
                                ]
                            ],
                        ],
                    ]
                );
    }

    public function test_checkout()
    {
        $this->auth_login();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token,
        ])->post('/api/checkout', [
            'address' => 'Jakarta Barat, DKI Jakarta, 11470',
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(
                    [
                        'success',
                        'message',
                        'data' => [
                            'id',
                            'user_id',
                            'invoice_code',
                            'grand_total',
                            'address',
                            'payment_status',
                            'created_at',
                            'updated_at',
                        ],
                    ]
                );
    }
}
