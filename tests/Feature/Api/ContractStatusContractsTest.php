<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Contract;
use App\Models\ContractStatus;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractStatusContractsTest extends TestCase
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
    public function it_gets_contract_status_contracts(): void
    {
        $contractStatus = ContractStatus::factory()->create();
        $contract = Contract::factory()->create();

        $contractStatus->contracts()->attach($contract);

        $response = $this->getJson(
            route('api.contract-statuses.contracts.index', $contractStatus)
        );

        $response->assertOk()->assertSee($contract->name);
    }

    /**
     * @test
     */
    public function it_can_attach_contracts_to_contract_status(): void
    {
        $contractStatus = ContractStatus::factory()->create();
        $contract = Contract::factory()->create();

        $response = $this->postJson(
            route('api.contract-statuses.contracts.store', [
                $contractStatus,
                $contract,
            ])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $contractStatus
                ->contracts()
                ->where('contracts.id', $contract->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_contracts_from_contract_status(): void
    {
        $contractStatus = ContractStatus::factory()->create();
        $contract = Contract::factory()->create();

        $response = $this->deleteJson(
            route('api.contract-statuses.contracts.store', [
                $contractStatus,
                $contract,
            ])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $contractStatus
                ->contracts()
                ->where('contracts.id', $contract->id)
                ->exists()
        );
    }
}
