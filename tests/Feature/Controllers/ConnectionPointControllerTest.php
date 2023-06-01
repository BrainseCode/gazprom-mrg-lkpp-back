<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ConnectionPoint;

use App\Models\Contract;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConnectionPointControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_connection_points(): void
    {
        $connectionPoints = ConnectionPoint::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('connection-points.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.connection_points.index')
            ->assertViewHas('connectionPoints');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_connection_point(): void
    {
        $response = $this->get(route('connection-points.create'));

        $response->assertOk()->assertViewIs('app.connection_points.create');
    }

    /**
     * @test
     */
    public function it_stores_the_connection_point(): void
    {
        $data = ConnectionPoint::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('connection-points.store'), $data);

        $this->assertDatabaseHas('connection_points', $data);

        $connectionPoint = ConnectionPoint::latest('id')->first();

        $response->assertRedirect(
            route('connection-points.edit', $connectionPoint)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_connection_point(): void
    {
        $connectionPoint = ConnectionPoint::factory()->create();

        $response = $this->get(
            route('connection-points.show', $connectionPoint)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.connection_points.show')
            ->assertViewHas('connectionPoint');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_connection_point(): void
    {
        $connectionPoint = ConnectionPoint::factory()->create();

        $response = $this->get(
            route('connection-points.edit', $connectionPoint)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.connection_points.edit')
            ->assertViewHas('connectionPoint');
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

        $response = $this->put(
            route('connection-points.update', $connectionPoint),
            $data
        );

        $data['id'] = $connectionPoint->id;

        $this->assertDatabaseHas('connection_points', $data);

        $response->assertRedirect(
            route('connection-points.edit', $connectionPoint)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_connection_point(): void
    {
        $connectionPoint = ConnectionPoint::factory()->create();

        $response = $this->delete(
            route('connection-points.destroy', $connectionPoint)
        );

        $response->assertRedirect(route('connection-points.index'));

        $this->assertSoftDeleted($connectionPoint);
    }
}
