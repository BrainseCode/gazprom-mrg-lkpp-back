<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Contract;
use App\Models\ContractStatus;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractContractStatusesTest extends TestCase
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
    public function it_gets_contract_contract_statuses(): void
    {
        $contract = Contract::factory()->create();
        $contractStatus = ContractStatus::factory()->create();

        $contract->contractStatuses()->attach($contractStatus);

        $response = $this->getJson(
            route('api.contracts.contract-statuses.index', $contract)
        );

        $response->assertOk()->assertSee($contractStatus->name);
    }

    /**
     * @test
     */
    public function it_can_attach_contract_statuses_to_contract(): void
    {
        $contract = Contract::factory()->create();
        $contractStatus = ContractStatus::factory()->create();

        $response = $this->postJson(
            route('api.contracts.contract-statuses.store', [
                $contract,
                $contractStatus,
            ])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $contract
                ->contractStatuses()
                ->where('contract_statuses.id', $contractStatus->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_contract_statuses_from_contract(): void
    {
        $contract = Contract::factory()->create();
        $contractStatus = ContractStatus::factory()->create();

        $response = $this->deleteJson(
            route('api.contracts.contract-statuses.store', [
                $contract,
                $contractStatus,
            ])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $contract
                ->contractStatuses()
                ->where('contract_statuses.id', $contractStatus->id)
                ->exists()
        );
    }
}
