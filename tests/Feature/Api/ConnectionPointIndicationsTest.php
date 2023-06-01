<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Indication;
use App\Models\ConnectionPoint;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConnectionPointIndicationsTest extends TestCase
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
    public function it_gets_connection_point_indications(): void
    {
        $connectionPoint = ConnectionPoint::factory()->create();
        $indications = Indication::factory()
            ->count(2)
            ->create([
                'connection_point_id' => $connectionPoint->id,
            ]);

        $response = $this->getJson(
            route('api.connection-points.indications.index', $connectionPoint)
        );

        $response->assertOk()->assertSee($indications[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_connection_point_indications(): void
    {
        $connectionPoint = ConnectionPoint::factory()->create();
        $data = Indication::factory()
            ->make([
                'connection_point_id' => $connectionPoint->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.connection-points.indications.store', $connectionPoint),
            $data
        );

        $this->assertDatabaseHas('indications', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $indication = Indication::latest('id')->first();

        $this->assertEquals(
            $connectionPoint->id,
            $indication->connection_point_id
        );
    }
}
