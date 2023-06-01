<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Contract;

use App\Models\RequestApprovalUnevenness;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractTest extends TestCase
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
    public function it_gets_contracts_list(): void
    {
        $contracts = Contract::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.contracts.index'));

        $response->assertOk()->assertSee($contracts[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_contract(): void
    {
        $data = Contract::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.contracts.store'), $data);

        $this->assertDatabaseHas('contracts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_contract(): void
    {
        $contract = Contract::factory()->create();

        $user = User::factory()->create();
        $requestApprovalUnevenness = RequestApprovalUnevenness::factory()->create();

        $data = [
            'number' => $this->faker->randomNumber(),
            'name' => $this->faker->text(255),
            'reporting_hour' => $this->faker->time(),
            'registration_date' => $this->faker->date(),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'arrears' => $this->faker->randomNumber(0),
            'user_id' => $user->id,
            'request_approval_unevenness_id' => $requestApprovalUnevenness->id,
        ];

        $response = $this->putJson(
            route('api.contracts.update', $contract),
            $data
        );

        $data['id'] = $contract->id;

        $this->assertDatabaseHas('contracts', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_contract(): void
    {
        $contract = Contract::factory()->create();

        $response = $this->deleteJson(
            route('api.contracts.destroy', $contract)
        );

        $this->assertSoftDeleted($contract);

        $response->assertNoContent();
    }
}
