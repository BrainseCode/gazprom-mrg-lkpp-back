<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Contract;
use App\Models\PayTotal;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractPayTotalsTest extends TestCase
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
    public function it_gets_contract_pay_totals(): void
    {
        $contract = Contract::factory()->create();
        $payTotals = PayTotal::factory()
            ->count(2)
            ->create([
                'contract_id' => $contract->id,
            ]);

        $response = $this->getJson(
            route('api.contracts.pay-totals.index', $contract)
        );

        $response->assertOk()->assertSee($payTotals[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_contract_pay_totals(): void
    {
        $contract = Contract::factory()->create();
        $data = PayTotal::factory()
            ->make([
                'contract_id' => $contract->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.contracts.pay-totals.store', $contract),
            $data
        );

        $this->assertDatabaseHas('pay_totals', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $payTotal = PayTotal::latest('id')->first();

        $this->assertEquals($contract->id, $payTotal->contract_id);
    }
}
