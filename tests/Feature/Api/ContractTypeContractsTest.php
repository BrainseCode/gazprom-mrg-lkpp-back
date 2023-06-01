<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Contract;
use App\Models\ContractType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractTypeContractsTest extends TestCase
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
    public function it_gets_contract_type_contracts(): void
    {
        $contractType = ContractType::factory()->create();
        $contract = Contract::factory()->create();

        $contractType->contracts()->attach($contract);

        $response = $this->getJson(
            route('api.contract-types.contracts.index', $contractType)
        );

        $response->assertOk()->assertSee($contract->name);
    }

    /**
     * @test
     */
    public function it_can_attach_contracts_to_contract_type(): void
    {
        $contractType = ContractType::factory()->create();
        $contract = Contract::factory()->create();

        $response = $this->postJson(
            route('api.contract-types.contracts.store', [
                $contractType,
                $contract,
            ])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $contractType
                ->contracts()
                ->where('contracts.id', $contract->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_contracts_from_contract_type(): void
    {
        $contractType = ContractType::factory()->create();
        $contract = Contract::factory()->create();

        $response = $this->deleteJson(
            route('api.contract-types.contracts.store', [
                $contractType,
                $contract,
            ])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $contractType
                ->contracts()
                ->where('contracts.id', $contract->id)
                ->exists()
        );
    }
}
