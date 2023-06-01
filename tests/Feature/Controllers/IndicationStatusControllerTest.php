<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\IndicationStatus;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndicationStatusControllerTest extends TestCase
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
    public function it_displays_index_view_with_indication_statuses(): void
    {
        $indicationStatuses = IndicationStatus::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('indication-statuses.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.indication_statuses.index')
            ->assertViewHas('indicationStatuses');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_indication_status(): void
    {
        $response = $this->get(route('indication-statuses.create'));

        $response->assertOk()->assertViewIs('app.indication_statuses.create');
    }

    /**
     * @test
     */
    public function it_stores_the_indication_status(): void
    {
        $data = IndicationStatus::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('indication-statuses.store'), $data);

        $this->assertDatabaseHas('indication_statuses', $data);

        $indicationStatus = IndicationStatus::latest('id')->first();

        $response->assertRedirect(
            route('indication-statuses.edit', $indicationStatus)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_indication_status(): void
    {
        $indicationStatus = IndicationStatus::factory()->create();

        $response = $this->get(
            route('indication-statuses.show', $indicationStatus)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.indication_statuses.show')
            ->assertViewHas('indicationStatus');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_indication_status(): void
    {
        $indicationStatus = IndicationStatus::factory()->create();

        $response = $this->get(
            route('indication-statuses.edit', $indicationStatus)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.indication_statuses.edit')
            ->assertViewHas('indicationStatus');
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

        $response = $this->put(
            route('indication-statuses.update', $indicationStatus),
            $data
        );

        $data['id'] = $indicationStatus->id;

        $this->assertDatabaseHas('indication_statuses', $data);

        $response->assertRedirect(
            route('indication-statuses.edit', $indicationStatus)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_indication_status(): void
    {
        $indicationStatus = IndicationStatus::factory()->create();

        $response = $this->delete(
            route('indication-statuses.destroy', $indicationStatus)
        );

        $response->assertRedirect(route('indication-statuses.index'));

        $this->assertSoftDeleted($indicationStatus);
    }
}
