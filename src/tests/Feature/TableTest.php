<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TableTest extends TestCase
{
    use DatabaseTransactions;

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
        $response = $this->getJson("/api/v1/tables?company={$this->tenant->uuid}", $this->header);
        $response->assertStatus(200);
    }

    public function testSingle()
    {
        $table = Table::first();
        $response = $this->getJson("/api/v1/tables/{$table->uuid}?company={$this->tenant->uuid}", $this->header);
        $response->assertStatus(200);
    }
}
