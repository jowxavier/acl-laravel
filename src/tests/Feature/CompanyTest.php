<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CompanyTest extends TestCase
{
    use DatabaseTransactions;

    protected $tenant;
    protected $header;

    public function setUp(): void
    {
        parent::setUp();

        $user = User::first();

        $this->header = [
            'Authorization' => "Bearer {$user->createToken(Str::random(10))->plainTextToken}"
        ];
    }

    public function testAll()
    {
        $response = $this->getJson('/api/v1/companies', $this->header);
        $response->assertStatus(200);
    }

    public function testSingle()
    {
        $tenant = Tenant::first();
        $response = $this->getJson("/api/v1/companies/{$tenant->uuid}", $this->header);
        $response->assertStatus(200);
    }
}
