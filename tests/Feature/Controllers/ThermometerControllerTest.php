<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Thermometer;

use App\Models\MeasuringComplex;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThermometerControllerTest extends TestCase
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
    public function it_displays_index_view_with_thermometers(): void
    {
        $thermometers = Thermometer::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('thermometers.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.thermometers.index')
            ->assertViewHas('thermometers');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_thermometer(): void
    {
        $response = $this->get(route('thermometers.create'));

        $response->assertOk()->assertViewIs('app.thermometers.create');
    }

    /**
     * @test
     */
    public function it_stores_the_thermometer(): void
    {
        $data = Thermometer::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('thermometers.store'), $data);

        $this->assertDatabaseHas('thermometers', $data);

        $thermometer = Thermometer::latest('id')->first();

        $response->assertRedirect(route('thermometers.edit', $thermometer));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_thermometer(): void
    {
        $thermometer = Thermometer::factory()->create();

        $response = $this->get(route('thermometers.show', $thermometer));

        $response
            ->assertOk()
            ->assertViewIs('app.thermometers.show')
            ->assertViewHas('thermometer');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_thermometer(): void
    {
        $thermometer = Thermometer::factory()->create();

        $response = $this->get(route('thermometers.edit', $thermometer));

        $response
            ->assertOk()
            ->assertViewIs('app.thermometers.edit')
            ->assertViewHas('thermometer');
    }

    /**
     * @test
     */
    public function it_updates_the_thermometer(): void
    {
        $thermometer = Thermometer::factory()->create();

        $measuringComplex = MeasuringComplex::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'number' => $this->faker->randomNumber(),
            'verification_date' => $this->faker->date(),
            'measuring_complex_id' => $measuringComplex->id,
        ];

        $response = $this->put(
            route('thermometers.update', $thermometer),
            $data
        );

        $data['id'] = $thermometer->id;

        $this->assertDatabaseHas('thermometers', $data);

        $response->assertRedirect(route('thermometers.edit', $thermometer));
    }

    /**
     * @test
     */
    public function it_deletes_the_thermometer(): void
    {
        $thermometer = Thermometer::factory()->create();

        $response = $this->delete(route('thermometers.destroy', $thermometer));

        $response->assertRedirect(route('thermometers.index'));

        $this->assertSoftDeleted($thermometer);
    }
}
