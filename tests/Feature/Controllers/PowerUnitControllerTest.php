<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\PowerUnit;

use App\Models\MeasuringComplex;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PowerUnitControllerTest extends TestCase
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
    public function it_displays_index_view_with_power_units(): void
    {
        $powerUnits = PowerUnit::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('power-units.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.power_units.index')
            ->assertViewHas('powerUnits');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_power_unit(): void
    {
        $response = $this->get(route('power-units.create'));

        $response->assertOk()->assertViewIs('app.power_units.create');
    }

    /**
     * @test
     */
    public function it_stores_the_power_unit(): void
    {
        $data = PowerUnit::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('power-units.store'), $data);

        $this->assertDatabaseHas('power_units', $data);

        $powerUnit = PowerUnit::latest('id')->first();

        $response->assertRedirect(route('power-units.edit', $powerUnit));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_power_unit(): void
    {
        $powerUnit = PowerUnit::factory()->create();

        $response = $this->get(route('power-units.show', $powerUnit));

        $response
            ->assertOk()
            ->assertViewIs('app.power_units.show')
            ->assertViewHas('powerUnit');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_power_unit(): void
    {
        $powerUnit = PowerUnit::factory()->create();

        $response = $this->get(route('power-units.edit', $powerUnit));

        $response
            ->assertOk()
            ->assertViewIs('app.power_units.edit')
            ->assertViewHas('powerUnit');
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

        $response = $this->put(route('power-units.update', $powerUnit), $data);

        $data['id'] = $powerUnit->id;

        $this->assertDatabaseHas('power_units', $data);

        $response->assertRedirect(route('power-units.edit', $powerUnit));
    }

    /**
     * @test
     */
    public function it_deletes_the_power_unit(): void
    {
        $powerUnit = PowerUnit::factory()->create();

        $response = $this->delete(route('power-units.destroy', $powerUnit));

        $response->assertRedirect(route('power-units.index'));

        $this->assertSoftDeleted($powerUnit);
    }
}
