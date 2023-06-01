<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Indication;

use App\Models\ConnectionPoint;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndicationTest extends TestCase
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
    public function it_gets_indications_list(): void
    {
        $indications = Indication::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.indications.index'));

        $response->assertOk()->assertSee($indications[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_indication(): void
    {
        $data = Indication::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.indications.store'), $data);

        $this->assertDatabaseHas('indications', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_indication(): void
    {
        $indication = Indication::factory()->create();

        $connectionPoint = ConnectionPoint::factory()->create();

        $data = [
            'date' => $this->faker->date(),
            'volume' => $this->faker->randomNumber(2),
            'plan' => $this->faker->randomNumber(2),
            'connection_point_id' => $connectionPoint->id,
        ];

        $response = $this->putJson(
            route('api.indications.update', $indication),
            $data
        );

        $data['id'] = $indication->id;

        $this->assertDatabaseHas('indications', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_indication(): void
    {
        $indication = Indication::factory()->create();

        $response = $this->deleteJson(
            route('api.indications.destroy', $indication)
        );

        $this->assertSoftDeleted($indication);

        $response->assertNoContent();
    }
}
