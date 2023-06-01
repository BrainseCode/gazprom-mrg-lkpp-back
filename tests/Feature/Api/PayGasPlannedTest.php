<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PayGasPlanned;

use App\Models\Contract;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PayGasPlannedTest extends TestCase
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
    public function it_gets_pay_gas_planneds_list(): void
    {
        $payGasPlanneds = PayGasPlanned::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.pay-gas-planneds.index'));

        $response->assertOk()->assertSee($payGasPlanneds[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_pay_gas_planned(): void
    {
        $data = PayGasPlanned::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.pay-gas-planneds.store'), $data);

        $this->assertDatabaseHas('pay_gas_planneds', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.pay-gas-planneds.update', $payGasPlanned),
            $data
        );

        $data['id'] = $payGasPlanned->id;

        $this->assertDatabaseHas('pay_gas_planneds', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_pay_gas_planned(): void
    {
        $payGasPlanned = PayGasPlanned::factory()->create();

        $response = $this->deleteJson(
            route('api.pay-gas-planneds.destroy', $payGasPlanned)
        );

        $this->assertSoftDeleted($payGasPlanned);

        $response->assertNoContent();
    }
}
