<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tenant;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
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
        $response = $this->getJson("/api/v1/categories?company={$this->tenant->uuid}", $this->header);
        $response->assertStatus(200);
    }

    public function testSingle()
    {
        $category = Category::first();
        $response = $this->getJson("/api/v1/categories/{$category->uuid}?company={$this->tenant->uuid}", $this->header);
        $response->assertStatus(200);
    }
}
