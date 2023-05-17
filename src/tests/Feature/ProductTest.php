<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tenant;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
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

    public function testAll()
    {
        $response = $this->getJson("/api/v1/products?company={$this->tenant->uuid}", $this->header);
        $response->assertStatus(200);
    }

    public function testSingle()
    {
        $product = Product::first();
        $response = $this->getJson("/api/v1/products/{$product->uuid}?company={$this->tenant->uuid}", $this->header);
        $response->assertStatus(200);
    }
}
