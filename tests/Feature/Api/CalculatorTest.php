<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Calculator;

use App\Models\MeasuringComplex;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CalculatorTest extends TestCase
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
    public function it_gets_calculators_list(): void
    {
        $calculators = Calculator::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.calculators.index'));

        $response->assertOk()->assertSee($calculators[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_calculator(): void
    {
        $data = Calculator::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.calculators.store'), $data);

        $this->assertDatabaseHas('calculators', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_calculator(): void
    {
        $calculator = Calculator::factory()->create();

        $measuringComplex = MeasuringComplex::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'number' => $this->faker->randomNumber(),
            'measuring_complex_id' => $measuringComplex->id,
        ];

        $response = $this->putJson(
            route('api.calculators.update', $calculator),
            $data
        );

        $data['id'] = $calculator->id;

        $this->assertDatabaseHas('calculators', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_calculator(): void
    {
        $calculator = Calculator::factory()->create();

        $response = $this->deleteJson(
            route('api.calculators.destroy', $calculator)
        );

        $this->assertSoftDeleted($calculator);

        $response->assertNoContent();
    }
}
