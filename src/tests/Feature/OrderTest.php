<?php

namespace Tests\Feature;

use App\Models\Product;
use Tests\TestCase;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderTest extends TestCase
{
    use DatabaseTransactions;

    protected $tenant;
    protected $header;

    public function setUp(): void
    {
        parent::setUp();

        $user = User::first();
        $this->tenant = Tenant::first();

        $this->header = [
            'Authorization' => "Bearer {$user->createToken(Str::random(10))->plainTextToken}"
        ];
    }

    public function testCreate()
    {
        $payload = [
            'comment' => 'sem cebola',
            'products' => []
        ];

        $products = Product::factory()->count(5)->create();
        $payload['products'] = array_map(function ($product) {
            return [
                'identify' => $product['uuid']->toString(),
                'quantity' => 1
            ];
        }, $products->toArray());

        $response = $this->postJson("/api/v1/orders?company={$this->tenant->uuid}", $payload, $this->header);
        $response->assertStatus(201);
    }
}
