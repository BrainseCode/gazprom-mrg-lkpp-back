<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Thermometer;

use App\Models\MeasuringComplex;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThermometerTest extends TestCase
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
    public function it_gets_thermometers_list(): void
    {
        $thermometers = Thermometer::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.thermometers.index'));

        $response->assertOk()->assertSee($thermometers[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_thermometer(): void
    {
        $data = Thermometer::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.thermometers.store'), $data);

        $this->assertDatabaseHas('thermometers', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.thermometers.update', $thermometer),
            $data
        );

        $data['id'] = $thermometer->id;

        $this->assertDatabaseHas('thermometers', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_thermometer(): void
    {
        $thermometer = Thermometer::factory()->create();

        $response = $this->deleteJson(
            route('api.thermometers.destroy', $thermometer)
        );

        $this->assertSoftDeleted($thermometer);

        $response->assertNoContent();
    }
}
