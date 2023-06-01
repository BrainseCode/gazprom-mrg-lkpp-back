<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ConnectionPoint;

use App\Models\Contract;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConnectionPointTest extends TestCase
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
    public function it_gets_connection_points_list(): void
    {
        $connectionPoints = ConnectionPoint::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.connection-points.index'));

        $response->assertOk()->assertSee($connectionPoints[0]->address);
    }

    /**
     * @test
     */
    public function it_stores_the_connection_point(): void
    {
        $data = ConnectionPoint::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.connection-points.store'),
            $data
        );

        $this->assertDatabaseHas('connection_points', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_connection_point(): void
    {
        $connectionPoint = ConnectionPoint::factory()->create();

        $contract = Contract::factory()->create();

        $data = [
            'address' => $this->faker->address(),
            'contract_id' => $contract->id,
        ];

        $response = $this->putJson(
            route('api.connection-points.update', $connectionPoint),
            $data
        );

        $data['id'] = $connectionPoint->id;

        $this->assertDatabaseHas('connection_points', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_connection_point(): void
    {
        $connectionPoint = ConnectionPoint::factory()->create();

        $response = $this->deleteJson(
            route('api.connection-points.destroy', $connectionPoint)
        );

        $this->assertSoftDeleted($connectionPoint);

        $response->assertNoContent();
    }
}
