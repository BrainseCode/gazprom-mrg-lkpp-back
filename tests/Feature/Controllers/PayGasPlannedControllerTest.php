<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\PayGasPlanned;

use App\Models\Contract;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PayGasPlannedControllerTest extends TestCase
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
    public function it_displays_index_view_with_pay_gas_planneds(): void
    {
        $payGasPlanneds = PayGasPlanned::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('pay-gas-planneds.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.pay_gas_planneds.index')
            ->assertViewHas('payGasPlanneds');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_pay_gas_planned(): void
    {
        $response = $this->get(route('pay-gas-planneds.create'));

        $response->assertOk()->assertViewIs('app.pay_gas_planneds.create');
    }

    /**
     * @test
     */
    public function it_stores_the_pay_gas_planned(): void
    {
        $data = PayGasPlanned::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('pay-gas-planneds.store'), $data);

        $this->assertDatabaseHas('pay_gas_planneds', $data);

        $payGasPlanned = PayGasPlanned::latest('id')->first();

        $response->assertRedirect(
            route('pay-gas-planneds.edit', $payGasPlanned)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_pay_gas_planned(): void
    {
        $payGasPlanned = PayGasPlanned::factory()->create();

        $response = $this->get(route('pay-gas-planneds.show', $payGasPlanned));

        $response
            ->assertOk()
            ->assertViewIs('app.pay_gas_planneds.show')
            ->assertViewHas('payGasPlanned');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_pay_gas_planned(): void
    {
        $payGasPlanned = PayGasPlanned::factory()->create();

        $response = $this->get(route('pay-gas-planneds.edit', $payGasPlanned));

        $response
            ->assertOk()
            ->assertViewIs('app.pay_gas_planneds.edit')
            ->assertViewHas('payGasPlanned');
    }

    /**
     * @test
     */
    public function it_updates_the_pay_gas_planned(): void
    {
        $payGasPlanned = PayGasPlanned::factory()->create();

        $contract = Contract::factory()->create();

        $data = [
            'date' => $this->faker->date(),
            'Percent' => $this->faker->randomNumber(2),
            'summ' => $this->faker->randomNumber(2),
            'status_pay' => $this->faker->boolean(),
            'contract_id' => $contract->id,
        ];

        $response = $this->put(
            route('pay-gas-planneds.update', $payGasPlanned),
            $data
        );

        $data['id'] = $payGasPlanned->id;

        $this->assertDatabaseHas('pay_gas_planneds', $data);

        $response->assertRedirect(
            route('pay-gas-planneds.edit', $payGasPlanned)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_pay_gas_planned(): void
    {
        $payGasPlanned = PayGasPlanned::factory()->create();

        $response = $this->delete(
            route('pay-gas-planneds.destroy', $payGasPlanned)
        );

        $response->assertRedirect(route('pay-gas-planneds.index'));

        $this->assertSoftDeleted($payGasPlanned);
    }
}
