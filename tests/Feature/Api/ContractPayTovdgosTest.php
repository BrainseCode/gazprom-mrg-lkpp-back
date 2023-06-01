<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Contract;
use App\Models\PayTovdgo;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractPayTovdgosTest extends TestCase
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
    public function it_gets_contract_pay_tovdgos(): void
    {
        $contract = Contract::factory()->create();
        $payTovdgos = PayTovdgo::factory()
            ->count(2)
            ->create([
                'contract_id' => $contract->id,
            ]);

        $response = $this->getJson(
            route('api.contracts.pay-tovdgos.index', $contract)
        );

        $response->assertOk()->assertSee($payTovdgos[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_contract_pay_tovdgos(): void
    {
        $contract = Contract::factory()->create();
        $data = PayTovdgo::factory()
            ->make([
                'contract_id' => $contract->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.contracts.pay-tovdgos.store', $contract),
            $data
        );

        $this->assertDatabaseHas('pay_tovdgos', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $payTovdgo = PayTovdgo::latest('id')->first();

        $this->assertEquals($contract->id, $payTovdgo->contract_id);
    }
}
