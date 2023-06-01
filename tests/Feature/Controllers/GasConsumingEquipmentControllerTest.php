<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\GasConsumingEquipment;

use App\Models\ConnectionPoint;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GasConsumingEquipmentControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_gas_consuming_equipments(): void
    {
        $gasConsumingEquipments = GasConsumingEquipment::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('gas-consuming-equipments.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.gas_consuming_equipments.index')
            ->assertViewHas('gasConsumingEquipments');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_gas_consuming_equipment(): void
    {
        $response = $this->get(route('gas-consuming-equipments.create'));

        $response
            ->assertOk()
            ->assertViewIs('app.gas_consuming_equipments.create');
    }

    /**
     * @test
     */
    public function it_stores_the_gas_consuming_equipment(): void
    {
        $data = GasConsumingEquipment::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('gas-consuming-equipments.store'), $data);

        $this->assertDatabaseHas('gas_consuming_equipments', $data);

        $gasConsumingEquipment = GasConsumingEquipment::latest('id')->first();

        $response->assertRedirect(
            route('gas-consuming-equipments.edit', $gasConsumingEquipment)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_gas_consuming_equipment(): void
    {
        $gasConsumingEquipment = GasConsumingEquipment::factory()->create();

        $response = $this->get(
            route('gas-consuming-equipments.show', $gasConsumingEquipment)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.gas_consuming_equipments.show')
            ->assertViewHas('gasConsumingEquipment');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_gas_consuming_equipment(): void
    {
        $gasConsumingEquipment = GasConsumingEquipment::factory()->create();

        $response = $this->get(
            route('gas-consuming-equipments.edit', $gasConsumingEquipment)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.gas_consuming_equipments.edit')
            ->assertViewHas('gasConsumingEquipment');
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

        $response = $this->put(
            route('gas-consuming-equipments.update', $gasConsumingEquipment),
            $data
        );

        $data['id'] = $gasConsumingEquipment->id;

        $this->assertDatabaseHas('gas_consuming_equipments', $data);

        $response->assertRedirect(
            route('gas-consuming-equipments.edit', $gasConsumingEquipment)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_gas_consuming_equipment(): void
    {
        $gasConsumingEquipment = GasConsumingEquipment::factory()->create();

        $response = $this->delete(
            route('gas-consuming-equipments.destroy', $gasConsumingEquipment)
        );

        $response->assertRedirect(route('gas-consuming-equipments.index'));

        $this->assertSoftDeleted($gasConsumingEquipment);
    }
}
