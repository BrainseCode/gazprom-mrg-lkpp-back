<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Meter;

use App\Models\MeasuringComplex;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MeterControllerTest extends TestCase
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
    public function it_displays_index_view_with_meters(): void
    {
        $meters = Meter::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('meters.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.meters.index')
            ->assertViewHas('meters');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_meter(): void
    {
        $response = $this->get(route('meters.create'));

        $response->assertOk()->assertViewIs('app.meters.create');
    }

    /**
     * @test
     */
    public function it_stores_the_meter(): void
    {
        $data = Meter::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('meters.store'), $data);

        $this->assertDatabaseHas('meters', $data);

        $meter = Meter::latest('id')->first();

        $response->assertRedirect(route('meters.edit', $meter));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_meter(): void
    {
        $meter = Meter::factory()->create();

        $response = $this->get(route('meters.show', $meter));

        $response
            ->assertOk()
            ->assertViewIs('app.meters.show')
            ->assertViewHas('meter');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_meter(): void
    {
        $meter = Meter::factory()->create();

        $response = $this->get(route('meters.edit', $meter));

        $response
            ->assertOk()
            ->assertViewIs('app.meters.edit')
            ->assertViewHas('meter');
    }

    /**
     * @test
     */
    public function it_updates_the_meter(): void
    {
        $meter = Meter::factory()->create();

        $measuringComplex = MeasuringComplex::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'number' => $this->faker->randomNumber(),
            'type' => $this->faker->word(),
            'verification_date' => $this->faker->date(),
            'measuring_complex_id' => $measuringComplex->id,
        ];

        $response = $this->put(route('meters.update', $meter), $data);

        $data['id'] = $meter->id;

        $this->assertDatabaseHas('meters', $data);

        $response->assertRedirect(route('meters.edit', $meter));
    }

    /**
     * @test
     */
    public function it_deletes_the_meter(): void
    {
        $meter = Meter::factory()->create();

        $response = $this->delete(route('meters.destroy', $meter));

        $response->assertRedirect(route('meters.index'));

        $this->assertSoftDeleted($meter);
    }
}
