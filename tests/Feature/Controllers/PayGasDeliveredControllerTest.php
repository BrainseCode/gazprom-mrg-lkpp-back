<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\PayGasDelivered;

use App\Models\Contract;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PayGasDeliveredControllerTest extends TestCase
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
    public function it_displays_index_view_with_pay_gas_delivereds(): void
    {
        $payGasDelivereds = PayGasDelivered::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('pay-gas-delivereds.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.pay_gas_delivereds.index')
            ->assertViewHas('payGasDelivereds');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_pay_gas_delivered(): void
    {
        $response = $this->get(route('pay-gas-delivereds.create'));

        $response->assertOk()->assertViewIs('app.pay_gas_delivereds.create');
    }

    /**
     * @test
     */
    public function it_stores_the_pay_gas_delivered(): void
    {
        $data = PayGasDelivered::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('pay-gas-delivereds.store'), $data);

        $this->assertDatabaseHas('pay_gas_delivereds', $data);

        $payGasDelivered = PayGasDelivered::latest('id')->first();

        $response->assertRedirect(
            route('pay-gas-delivereds.edit', $payGasDelivered)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_pay_gas_delivered(): void
    {
        $payGasDelivered = PayGasDelivered::factory()->create();

        $response = $this->get(
            route('pay-gas-delivereds.show', $payGasDelivered)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.pay_gas_delivereds.show')
            ->assertViewHas('payGasDelivered');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_pay_gas_delivered(): void
    {
        $payGasDelivered = PayGasDelivered::factory()->create();

        $response = $this->get(
            route('pay-gas-delivereds.edit', $payGasDelivered)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.pay_gas_delivereds.edit')
            ->assertViewHas('payGasDelivered');
    }

    /**
     * @test
     */
    public function it_updates_the_pay_gas_delivered(): void
    {
        $payGasDelivered = PayGasDelivered::factory()->create();

        $contract = Contract::factory()->create();

        $data = [
            'date' => $this->faker->date(),
            'summ' => $this->faker->randomNumber(2),
            'status_pay' => $this->faker->boolean(),
            'contract_id' => $contract->id,
        ];

        $response = $this->put(
            route('pay-gas-delivereds.update', $payGasDelivered),
            $data
        );

        $data['id'] = $payGasDelivered->id;

        $this->assertDatabaseHas('pay_gas_delivereds', $data);

        $response->assertRedirect(
            route('pay-gas-delivereds.edit', $payGasDelivered)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_pay_gas_delivered(): void
    {
        $payGasDelivered = PayGasDelivered::factory()->create();

        $response = $this->delete(
            route('pay-gas-delivereds.destroy', $payGasDelivered)
        );

        $response->assertRedirect(route('pay-gas-delivereds.index'));

        $this->assertSoftDeleted($payGasDelivered);
    }
}
