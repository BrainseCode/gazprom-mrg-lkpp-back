<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Contract;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserContractsTest extends TestCase
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
    public function it_gets_user_contracts(): void
    {
        $user = User::factory()->create();
        $contracts = Contract::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.contracts.index', $user));

        $response->assertOk()->assertSee($contracts[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_user_contracts(): void
    {
        $user = User::factory()->create();
        $data = Contract::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.contracts.store', $user),
            $data
        );

        $this->assertDatabaseHas('contracts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $contract = Contract::latest('id')->first();

        $this->assertEquals($user->id, $contract->user_id);
    }
}
