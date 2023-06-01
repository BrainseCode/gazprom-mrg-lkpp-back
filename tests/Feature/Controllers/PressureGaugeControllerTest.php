<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\PressureGauge;

use App\Models\MeasuringComplex;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PressureGaugeControllerTest extends TestCase
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
    public function it_displays_index_view_with_pressure_gauges(): void
    {
        $pressureGauges = PressureGauge::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('pressure-gauges.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.pressure_gauges.index')
            ->assertViewHas('pressureGauges');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_pressure_gauge(): void
    {
        $response = $this->get(route('pressure-gauges.create'));

        $response->assertOk()->assertViewIs('app.pressure_gauges.create');
    }

    /**
     * @test
     */
    public function it_stores_the_pressure_gauge(): void
    {
        $data = PressureGauge::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('pressure-gauges.store'), $data);

        $this->assertDatabaseHas('pressure_gauges', $data);

        $pressureGauge = PressureGauge::latest('id')->first();

        $response->assertRedirect(
            route('pressure-gauges.edit', $pressureGauge)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_pressure_gauge(): void
    {
        $pressureGauge = PressureGauge::factory()->create();

        $response = $this->get(route('pressure-gauges.show', $pressureGauge));

        $response
            ->assertOk()
            ->assertViewIs('app.pressure_gauges.show')
            ->assertViewHas('pressureGauge');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_pressure_gauge(): void
    {
        $pressureGauge = PressureGauge::factory()->create();

        $response = $this->get(route('pressure-gauges.edit', $pressureGauge));

        $response
            ->assertOk()
            ->assertViewIs('app.pressure_gauges.edit')
            ->assertViewHas('pressureGauge');
    }

    /**
     * @test
     */
    public function it_updates_the_pressure_gauge(): void
    {
        $pressureGauge = PressureGauge::factory()->create();

        $measuringComplex = MeasuringComplex::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'number' => $this->faker->randomNumber(),
            'verification_date' => $this->faker->date(),
            'measuring_complex_id' => $measuringComplex->id,
        ];

        $response = $this->put(
            route('pressure-gauges.update', $pressureGauge),
            $data
        );

        $data['id'] = $pressureGauge->id;

        $this->assertDatabaseHas('pressure_gauges', $data);

        $response->assertRedirect(
            route('pressure-gauges.edit', $pressureGauge)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_pressure_gauge(): void
    {
        $pressureGauge = PressureGauge::factory()->create();

        $response = $this->delete(
            route('pressure-gauges.destroy', $pressureGauge)
        );

        $response->assertRedirect(route('pressure-gauges.index'));

        $this->assertSoftDeleted($pressureGauge);
    }
}
