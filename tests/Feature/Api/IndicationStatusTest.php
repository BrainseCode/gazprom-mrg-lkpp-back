<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\IndicationStatus;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndicationStatusTest extends TestCase
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
    public function it_gets_indication_statuses_list(): void
    {
        $indicationStatuses = IndicationStatus::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.indication-statuses.index'));

        $response->assertOk()->assertSee($indicationStatuses[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_indication_status(): void
    {
        $data = IndicationStatus::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.indication-statuses.store'),
            $data
        );

        $this->assertDatabaseHas('indication_statuses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_indication_status(): void
    {
        $indicationStatus = IndicationStatus::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(
            route('api.indication-statuses.update', $indicationStatus),
            $data
        );

        $data['id'] = $indicationStatus->id;

        $this->assertDatabaseHas('indication_statuses', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_indication_status(): void
    {
        $indicationStatus = IndicationStatus::factory()->create();

        $response = $this->deleteJson(
            route('api.indication-statuses.destroy', $indicationStatus)
        );

        $this->assertSoftDeleted($indicationStatus);

        $response->assertNoContent();
    }
}
