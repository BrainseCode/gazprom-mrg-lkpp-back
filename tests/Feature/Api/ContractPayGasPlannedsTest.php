<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Contract;
use App\Models\PayGasPlanned;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractPayGasPlannedsTest extends TestCase
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
    public function it_gets_contract_pay_gas_planneds(): void
    {
        $contract = Contract::factory()->create();
        $payGasPlanneds = PayGasPlanned::factory()
            ->count(2)
            ->create([
                'contract_id' => $contract->id,
            ]);

        $response = $this->getJson(
            route('api.contracts.pay-gas-planneds.index', $contract)
        );

        $response->assertOk()->assertSee($payGasPlanneds[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_contract_pay_gas_planneds(): void
    {
        $contract = Contract::factory()->create();
        $data = PayGasPlanned::factory()
            ->make([
                'contract_id' => $contract->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.contracts.pay-gas-planneds.store', $contract),
            $data
        );

        $this->assertDatabaseHas('pay_gas_planneds', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $payGasPlanned = PayGasPlanned::latest('id')->first();

        $this->assertEquals($contract->id, $payGasPlanned->contract_id);
    }
}
