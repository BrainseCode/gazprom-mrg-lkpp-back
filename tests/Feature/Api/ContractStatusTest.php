<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ContractStatus;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractStatusTest extends TestCase
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
    public function it_gets_contract_statuses_list(): void
    {
        $contractStatuses = ContractStatus::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.contract-statuses.index'));

        $response->assertOk()->assertSee($contractStatuses[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_contract_status(): void
    {
        $data = ContractStatus::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.contract-statuses.store'),
            $data
        );

        $this->assertDatabaseHas('contract_statuses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_contract_status(): void
    {
        $contractStatus = ContractStatus::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(
            route('api.contract-statuses.update', $contractStatus),
            $data
        );

        $data['id'] = $contractStatus->id;

        $this->assertDatabaseHas('contract_statuses', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_contract_status(): void
    {
        $contractStatus = ContractStatus::factory()->create();

        $response = $this->deleteJson(
            route('api.contract-statuses.destroy', $contractStatus)
        );

        $this->assertSoftDeleted($contractStatus);

        $response->assertNoContent();
    }
}
