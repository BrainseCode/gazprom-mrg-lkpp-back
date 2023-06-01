<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\MeasuringComplex;

use App\Models\ConnectionPoint;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MeasuringComplexTest extends TestCase
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
    public function it_gets_measuring_complexes_list(): void
    {
        $measuringComplexes = MeasuringComplex::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.measuring-complexes.index'));

        $response->assertOk()->assertSee($measuringComplexes[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_measuring_complex(): void
    {
        $data = MeasuringComplex::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.measuring-complexes.store'),
            $data
        );

        $this->assertDatabaseHas('measuring_complexes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.measuring-complexes.update', $measuringComplex),
            $data
        );

        $data['id'] = $measuringComplex->id;

        $this->assertDatabaseHas('measuring_complexes', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_measuring_complex(): void
    {
        $measuringComplex = MeasuringComplex::factory()->create();

        $response = $this->deleteJson(
            route('api.measuring-complexes.destroy', $measuringComplex)
        );

        $this->assertSoftDeleted($measuringComplex);

        $response->assertNoContent();
    }
}
