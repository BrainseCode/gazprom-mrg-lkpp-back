<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PowerUnit;

use App\Models\MeasuringComplex;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PowerUnitTest extends TestCase
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
    public function it_gets_power_units_list(): void
    {
        $powerUnits = PowerUnit::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.power-units.index'));

        $response->assertOk()->assertSee($powerUnits[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_power_unit(): void
    {
        $data = PowerUnit::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.power-units.store'), $data);

        $this->assertDatabaseHas('power_units', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_power_unit(): void
    {
        $powerUnit = PowerUnit::factory()->create();

        $measuringComplex = MeasuringComplex::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'number' => $this->faker->randomNumber(),
            'measuring_complex_id' => $measuringComplex->id,
        ];

        $response = $this->putJson(
            route('api.power-units.update', $powerUnit),
            $data
        );

        $data['id'] = $powerUnit->id;

        $this->assertDatabaseHas('power_units', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_power_unit(): void
    {
        $powerUnit = PowerUnit::factory()->create();

        $response = $this->deleteJson(
            route('api.power-units.destroy', $powerUnit)
        );

        $this->assertSoftDeleted($powerUnit);

        $response->assertNoContent();
    }
}
