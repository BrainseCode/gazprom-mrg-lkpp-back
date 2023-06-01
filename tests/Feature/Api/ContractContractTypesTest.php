<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Contract;
use App\Models\ContractType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractContractTypesTest extends TestCase
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
    public function it_gets_contract_contract_types(): void
    {
        $contract = Contract::factory()->create();
        $contractType = ContractType::factory()->create();

        $contract->contractTypes()->attach($contractType);

        $response = $this->getJson(
            route('api.contracts.contract-types.index', $contract)
        );

        $response->assertOk()->assertSee($contractType->name);
    }

    /**
     * @test
     */
    public function it_can_attach_contract_types_to_contract(): void
    {
        $contract = Contract::factory()->create();
        $contractType = ContractType::factory()->create();

        $response = $this->postJson(
            route('api.contracts.contract-types.store', [
                $contract,
                $contractType,
            ])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $contract
                ->contractTypes()
                ->where('contract_types.id', $contractType->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_contract_types_from_contract(): void
    {
        $contract = Contract::factory()->create();
        $contractType = ContractType::factory()->create();

        $response = $this->deleteJson(
            route('api.contracts.contract-types.store', [
                $contract,
                $contractType,
            ])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $contract
                ->contractTypes()
                ->where('contract_types.id', $contractType->id)
                ->exists()
        );
    }
}
