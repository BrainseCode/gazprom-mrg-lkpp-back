<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\UnallocatedByDate;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UnallocatedByDateTest extends TestCase
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
    public function it_gets_unallocated_by_dates_list(): void
    {
        $unallocatedByDates = UnallocatedByDate::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.unallocated-by-dates.index'));

        $response->assertOk()->assertSee($unallocatedByDates[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_unallocated_by_date(): void
    {
        $data = UnallocatedByDate::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.unallocated-by-dates.store'),
            $data
        );

        $this->assertDatabaseHas('unallocated_by_dates', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_unallocated_by_date(): void
    {
        $unallocatedByDate = UnallocatedByDate::factory()->create();

        $data = [
            'date' => $this->faker->date(),
            'gas_volume' => $this->faker->randomNumber(2),
        ];

        $response = $this->putJson(
            route('api.unallocated-by-dates.update', $unallocatedByDate),
            $data
        );

        $data['id'] = $unallocatedByDate->id;

        $this->assertDatabaseHas('unallocated_by_dates', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_unallocated_by_date(): void
    {
        $unallocatedByDate = UnallocatedByDate::factory()->create();

        $response = $this->deleteJson(
            route('api.unallocated-by-dates.destroy', $unallocatedByDate)
        );

        $this->assertSoftDeleted($unallocatedByDate);

        $response->assertNoContent();
    }
}
