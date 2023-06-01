<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\GasConsumingEquipment;

use App\Models\ConnectionPoint;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GasConsumingEquipmentTest extends TestCase
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
    public function it_gets_gas_consuming_equipments_list(): void
    {
        $gasConsumingEquipments = GasConsumingEquipment::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.gas-consuming-equipments.index'));

        $response->assertOk()->assertSee($gasConsumingEquipments[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_gas_consuming_equipment(): void
    {
        $data = GasConsumingEquipment::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.gas-consuming-equipments.store'),
            $data
        );

        $this->assertDatabaseHas('gas_consuming_equipments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_gas_consuming_equipment(): void
    {
        $gasConsumingEquipment = GasConsumingEquipment::factory()->create();

        $connectionPoint = ConnectionPoint::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'quantity' => $this->faker->randomNumber(),
            'power' => $this->faker->randomNumber(2),
            'consumption' => $this->faker->randomNumber(2),
            'connection_point_id' => $connectionPoint->id,
        ];

        $response = $this->putJson(
            route(
                'api.gas-consuming-equipments.update',
                $gasConsumingEquipment
            ),
            $data
        );

        $data['id'] = $gasConsumingEquipment->id;

        $this->assertDatabaseHas('gas_consuming_equipments', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_gas_consuming_equipment(): void
    {
        $gasConsumingEquipment = GasConsumingEquipment::factory()->create();

        $response = $this->deleteJson(
            route(
                'api.gas-consuming-equipments.destroy',
                $gasConsumingEquipment
            )
        );

        $this->assertSoftDeleted($gasConsumingEquipment);

        $response->assertNoContent();
    }
}
