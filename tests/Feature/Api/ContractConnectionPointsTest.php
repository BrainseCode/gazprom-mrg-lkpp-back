<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Contract;
use App\Models\ConnectionPoint;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractConnectionPointsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_contract_connection_points(): void
    {
        $contract = Contract::factory()->create();
        $connectionPoints = ConnectionPoint::factory()
            ->count(2)
            ->create([
                'contract_id' => $contract->id,
            ]);

        $response = $this->getJson(
            route('api.contracts.connection-points.index', $contract)
        );

        $response->assertOk()->assertSee($connectionPoints[0]->address);
    }

    /**
     * @test
     */
    public function it_stores_the_contract_connection_points(): void
    {
        $contract = Contract::factory()->create();
        $data = ConnectionPoint::factory()
            ->make([
                'contract_id' => $contract->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.contracts.connection-points.store', $contract),
            $data
        );

        $this->assertDatabaseHas('connection_points', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $connectionPoint = ConnectionPoint::latest('id')->first();

        $this->assertEquals($contract->id, $connectionPoint->contract_id);
    }
}
