<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Contract;
use App\Models\PayGasDelivered;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractPayGasDeliveredsTest extends TestCase
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
    public function it_gets_contract_pay_gas_delivereds(): void
    {
        $contract = Contract::factory()->create();
        $payGasDelivereds = PayGasDelivered::factory()
            ->count(2)
            ->create([
                'contract_id' => $contract->id,
            ]);

        $response = $this->getJson(
            route('api.contracts.pay-gas-delivereds.index', $contract)
        );

        $response->assertOk()->assertSee($payGasDelivereds[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_contract_pay_gas_delivereds(): void
    {
        $contract = Contract::factory()->create();
        $data = PayGasDelivered::factory()
            ->make([
                'contract_id' => $contract->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.contracts.pay-gas-delivereds.store', $contract),
            $data
        );

        $this->assertDatabaseHas('pay_gas_delivereds', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $payGasDelivered = PayGasDelivered::latest('id')->first();

        $this->assertEquals($contract->id, $payGasDelivered->contract_id);
    }
}
