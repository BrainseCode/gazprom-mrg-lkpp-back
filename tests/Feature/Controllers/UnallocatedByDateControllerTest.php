<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\UnallocatedByDate;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UnallocatedByDateControllerTest extends TestCase
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
    public function it_displays_index_view_with_unallocated_by_dates(): void
    {
        $unallocatedByDates = UnallocatedByDate::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('unallocated-by-dates.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.unallocated_by_dates.index')
            ->assertViewHas('unallocatedByDates');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_unallocated_by_date(): void
    {
        $response = $this->get(route('unallocated-by-dates.create'));

        $response->assertOk()->assertViewIs('app.unallocated_by_dates.create');
    }

    /**
     * @test
     */
    public function it_stores_the_unallocated_by_date(): void
    {
        $data = UnallocatedByDate::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('unallocated-by-dates.store'), $data);

        $this->assertDatabaseHas('unallocated_by_dates', $data);

        $unallocatedByDate = UnallocatedByDate::latest('id')->first();

        $response->assertRedirect(
            route('unallocated-by-dates.edit', $unallocatedByDate)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_unallocated_by_date(): void
    {
        $unallocatedByDate = UnallocatedByDate::factory()->create();

        $response = $this->get(
            route('unallocated-by-dates.show', $unallocatedByDate)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.unallocated_by_dates.show')
            ->assertViewHas('unallocatedByDate');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_unallocated_by_date(): void
    {
        $unallocatedByDate = UnallocatedByDate::factory()->create();

        $response = $this->get(
            route('unallocated-by-dates.edit', $unallocatedByDate)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.unallocated_by_dates.edit')
            ->assertViewHas('unallocatedByDate');
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

        $response = $this->put(
            route('unallocated-by-dates.update', $unallocatedByDate),
            $data
        );

        $data['id'] = $unallocatedByDate->id;

        $this->assertDatabaseHas('unallocated_by_dates', $data);

        $response->assertRedirect(
            route('unallocated-by-dates.edit', $unallocatedByDate)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_unallocated_by_date(): void
    {
        $unallocatedByDate = UnallocatedByDate::factory()->create();

        $response = $this->delete(
            route('unallocated-by-dates.destroy', $unallocatedByDate)
        );

        $response->assertRedirect(route('unallocated-by-dates.index'));

        $this->assertSoftDeleted($unallocatedByDate);
    }
}
