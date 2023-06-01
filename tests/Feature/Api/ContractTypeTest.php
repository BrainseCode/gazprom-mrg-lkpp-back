<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ContractType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractTypeTest extends TestCase
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
    public function it_gets_contract_types_list(): void
    {
        $contractTypes = ContractType::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.contract-types.index'));

        $response->assertOk()->assertSee($contractTypes[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_contract_type(): void
    {
        $data = ContractType::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.contract-types.store'), $data);

        $this->assertDatabaseHas('contract_types', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_contract_type(): void
    {
        $contractType = ContractType::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(
            route('api.contract-types.update', $contractType),
            $data
        );

        $data['id'] = $contractType->id;

        $this->assertDatabaseHas('contract_types', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_contract_type(): void
    {
        $contractType = ContractType::factory()->create();

        $response = $this->deleteJson(
            route('api.contract-types.destroy', $contractType)
        );

        $this->assertSoftDeleted($contractType);

        $response->assertNoContent();
    }
}
