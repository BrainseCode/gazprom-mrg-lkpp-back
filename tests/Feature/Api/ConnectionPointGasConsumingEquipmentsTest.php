<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ConnectionPoint;
use App\Models\GasConsumingEquipment;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConnectionPointGasConsumingEquipmentsTest extends TestCase
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
    public function it_gets_connection_point_gas_consuming_equipments(): void
    {
        $connectionPoint = ConnectionPoint::factory()->create();
        $gasConsumingEquipments = GasConsumingEquipment::factory()
            ->count(2)
            ->create([
                'connection_point_id' => $connectionPoint->id,
            ]);

        $response = $this->getJson(
            route(
                'api.connection-points.gas-consuming-equipments.index',
                $connectionPoint
            )
        );

        $response->assertOk()->assertSee($gasConsumingEquipments[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_connection_point_gas_consuming_equipments(): void
    {
        $connectionPoint = ConnectionPoint::factory()->create();
        $data = GasConsumingEquipment::factory()
            ->make([
                'connection_point_id' => $connectionPoint->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.connection-points.gas-consuming-equipments.store',
                $connectionPoint
            ),
            $data
        );

        $this->assertDatabaseHas('gas_consuming_equipments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $gasConsumingEquipment = GasConsumingEquipment::latest('id')->first();

        $this->assertEquals(
            $connectionPoint->id,
            $gasConsumingEquipment->connection_point_id
        );
    }
}
