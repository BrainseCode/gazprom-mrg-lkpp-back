<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Meter;

use App\Models\MeasuringComplex;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MeterTest extends TestCase
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
    public function it_gets_meters_list(): void
    {
        $meters = Meter::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.meters.index'));

        $response->assertOk()->assertSee($meters[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_meter(): void
    {
        $data = Meter::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.meters.store'), $data);

        $this->assertDatabaseHas('meters', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(route('api.meters.update', $meter), $data);

        $data['id'] = $meter->id;

        $this->assertDatabaseHas('meters', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_meter(): void
    {
        $meter = Meter::factory()->create();

        $response = $this->deleteJson(route('api.meters.destroy', $meter));

        $this->assertSoftDeleted($meter);

        $response->assertNoContent();
    }
}
