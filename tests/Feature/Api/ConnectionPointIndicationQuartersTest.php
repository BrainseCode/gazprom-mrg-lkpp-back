<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ConnectionPoint;
use App\Models\IndicationQuarter;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConnectionPointIndicationQuartersTest extends TestCase
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
    public function it_gets_connection_point_indication_quarters(): void
    {
        $connectionPoint = ConnectionPoint::factory()->create();
        $indicationQuarters = IndicationQuarter::factory()
            ->count(2)
            ->create([
                'connection_point_id' => $connectionPoint->id,
            ]);

        $response = $this->getJson(
            route(
                'api.connection-points.indication-quarters.index',
                $connectionPoint
            )
        );

        $response->assertOk()->assertSee($indicationQuarters[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_connection_point_indication_quarters(): void
    {
        $connectionPoint = ConnectionPoint::factory()->create();
        $data = IndicationQuarter::factory()
            ->make([
                'connection_point_id' => $connectionPoint->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.connection-points.indication-quarters.store',
                $connectionPoint
            ),
            $data
        );

        $this->assertDatabaseHas('indication_quarters', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $indicationQuarter = IndicationQuarter::latest('id')->first();

        $this->assertEquals(
            $connectionPoint->id,
            $indicationQuarter->connection_point_id
        );
    }
}
