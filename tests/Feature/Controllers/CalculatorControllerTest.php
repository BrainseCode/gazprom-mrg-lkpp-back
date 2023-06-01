<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Calculator;

use App\Models\MeasuringComplex;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CalculatorControllerTest extends TestCase
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
    public function it_displays_index_view_with_calculators(): void
    {
        $calculators = Calculator::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('calculators.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.calculators.index')
            ->assertViewHas('calculators');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_calculator(): void
    {
        $response = $this->get(route('calculators.create'));

        $response->assertOk()->assertViewIs('app.calculators.create');
    }

    /**
     * @test
     */
    public function it_stores_the_calculator(): void
    {
        $data = Calculator::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('calculators.store'), $data);

        $this->assertDatabaseHas('calculators', $data);

        $calculator = Calculator::latest('id')->first();

        $response->assertRedirect(route('calculators.edit', $calculator));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_calculator(): void
    {
        $calculator = Calculator::factory()->create();

        $response = $this->get(route('calculators.show', $calculator));

        $response
            ->assertOk()
            ->assertViewIs('app.calculators.show')
            ->assertViewHas('calculator');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_calculator(): void
    {
        $calculator = Calculator::factory()->create();

        $response = $this->get(route('calculators.edit', $calculator));

        $response
            ->assertOk()
            ->assertViewIs('app.calculators.edit')
            ->assertViewHas('calculator');
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

        $response = $this->put(route('calculators.update', $calculator), $data);

        $data['id'] = $calculator->id;

        $this->assertDatabaseHas('calculators', $data);

        $response->assertRedirect(route('calculators.edit', $calculator));
    }

    /**
     * @test
     */
    public function it_deletes_the_calculator(): void
    {
        $calculator = Calculator::factory()->create();

        $response = $this->delete(route('calculators.destroy', $calculator));

        $response->assertRedirect(route('calculators.index'));

        $this->assertSoftDeleted($calculator);
    }
}
