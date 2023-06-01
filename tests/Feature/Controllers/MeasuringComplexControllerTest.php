<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\MeasuringComplex;

use App\Models\ConnectionPoint;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MeasuringComplexControllerTest extends TestCase
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
    public function it_displays_index_view_with_measuring_complexes(): void
    {
        $measuringComplexes = MeasuringComplex::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('measuring-complexes.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.measuring_complexes.index')
            ->assertViewHas('measuringComplexes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_measuring_complex(): void
    {
        $response = $this->get(route('measuring-complexes.create'));

        $response->assertOk()->assertViewIs('app.measuring_complexes.create');
    }

    /**
     * @test
     */
    public function it_stores_the_measuring_complex(): void
    {
        $data = MeasuringComplex::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('measuring-complexes.store'), $data);

        $this->assertDatabaseHas('measuring_complexes', $data);

        $measuringComplex = MeasuringComplex::latest('id')->first();

        $response->assertRedirect(
            route('measuring-complexes.edit', $measuringComplex)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_measuring_complex(): void
    {
        $measuringComplex = MeasuringComplex::factory()->create();

        $response = $this->get(
            route('measuring-complexes.show', $measuringComplex)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.measuring_complexes.show')
            ->assertViewHas('measuringComplex');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_measuring_complex(): void
    {
        $measuringComplex = MeasuringComplex::factory()->create();

        $response = $this->get(
            route('measuring-complexes.edit', $measuringComplex)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.measuring_complexes.edit')
            ->assertViewHas('measuringComplex');
    }

    /**
     * @test
     */
    public function it_updates_the_measuring_complex(): void
    {
        $measuringComplex = MeasuringComplex::factory()->create();

        $connectionPoint = ConnectionPoint::factory()->create();

        $data = [
            'number' => $this->faker->randomNumber(),
            'connection_point_id' => $connectionPoint->id,
        ];

        $response = $this->put(
            route('measuring-complexes.update', $measuringComplex),
            $data
        );

        $data['id'] = $measuringComplex->id;

        $this->assertDatabaseHas('measuring_complexes', $data);

        $response->assertRedirect(
            route('measuring-complexes.edit', $measuringComplex)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_measuring_complex(): void
    {
        $measuringComplex = MeasuringComplex::factory()->create();

        $response = $this->delete(
            route('measuring-complexes.destroy', $measuringComplex)
        );

        $response->assertRedirect(route('measuring-complexes.index'));

        $this->assertSoftDeleted($measuringComplex);
    }
}
