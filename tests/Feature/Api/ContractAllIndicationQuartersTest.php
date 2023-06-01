<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Contract;
use App\Models\AllIndicationQuarter;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractAllIndicationQuartersTest extends TestCase
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
    public function it_gets_contract_all_indication_quarters(): void
    {
        $contract = Contract::factory()->create();
        $allIndicationQuarters = AllIndicationQuarter::factory()
            ->count(2)
            ->create([
                'contract_id' => $contract->id,
            ]);

        $response = $this->getJson(
            route('api.contracts.all-indication-quarters.index', $contract)
        );

        $response->assertOk()->assertSee($allIndicationQuarters[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_contract_all_indication_quarters(): void
    {
        $contract = Contract::factory()->create();
        $data = AllIndicationQuarter::factory()
            ->make([
                'contract_id' => $contract->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.contracts.all-indication-quarters.store', $contract),
            $data
        );

        $this->assertDatabaseHas('all_indication_quarters', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $allIndicationQuarter = AllIndicationQuarter::latest('id')->first();

        $this->assertEquals($contract->id, $allIndicationQuarter->contract_id);
    }
}
