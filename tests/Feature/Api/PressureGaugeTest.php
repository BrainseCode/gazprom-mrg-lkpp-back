<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PressureGauge;

use App\Models\MeasuringComplex;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PressureGaugeTest extends TestCase
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
    public function it_gets_pressure_gauges_list(): void
    {
        $pressureGauges = PressureGauge::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.pressure-gauges.index'));

        $response->assertOk()->assertSee($pressureGauges[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_pressure_gauge(): void
    {
        $data = PressureGauge::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.pressure-gauges.store'), $data);

        $this->assertDatabaseHas('pressure_gauges', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.pressure-gauges.update', $pressureGauge),
            $data
        );

        $data['id'] = $pressureGauge->id;

        $this->assertDatabaseHas('pressure_gauges', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_pressure_gauge(): void
    {
        $pressureGauge = PressureGauge::factory()->create();

        $response = $this->deleteJson(
            route('api.pressure-gauges.destroy', $pressureGauge)
        );

        $this->assertSoftDeleted($pressureGauge);

        $response->assertNoContent();
    }
}
