<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\IndicationQuarter;

use App\Models\ConnectionPoint;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndicationQuarterControllerTest extends TestCase
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
    public function it_displays_index_view_with_indication_quarters(): void
    {
        $indicationQuarters = IndicationQuarter::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('indication-quarters.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.indication_quarters.index')
            ->assertViewHas('indicationQuarters');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_indication_quarter(): void
    {
        $response = $this->get(route('indication-quarters.create'));

        $response->assertOk()->assertViewIs('app.indication_quarters.create');
    }

    /**
     * @test
     */
    public function it_stores_the_indication_quarter(): void
    {
        $data = IndicationQuarter::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('indication-quarters.store'), $data);

        $this->assertDatabaseHas('indication_quarters', $data);

        $indicationQuarter = IndicationQuarter::latest('id')->first();

        $response->assertRedirect(
            route('indication-quarters.edit', $indicationQuarter)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_indication_quarter(): void
    {
        $indicationQuarter = IndicationQuarter::factory()->create();

        $response = $this->get(
            route('indication-quarters.show', $indicationQuarter)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.indication_quarters.show')
            ->assertViewHas('indicationQuarter');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_indication_quarter(): void
    {
        $indicationQuarter = IndicationQuarter::factory()->create();

        $response = $this->get(
            route('indication-quarters.edit', $indicationQuarter)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.indication_quarters.edit')
            ->assertViewHas('indicationQuarter');
    }

    /**
     * @test
     */
    public function it_updates_the_indication_quarter(): void
    {
        $indicationQuarter = IndicationQuarter::factory()->create();

        $connectionPoint = ConnectionPoint::factory()->create();

        $data = [
            'date_year' => $this->faker->year(),
            'year' => $this->faker->randomNumber(2),
            'quarter_1' => $this->faker->randomNumber(2),
            'quarter_2' => $this->faker->randomNumber(2),
            'quarter_3' => $this->faker->randomNumber(2),
            'quarter_4' => $this->faker->randomNumber(2),
            'january' => $this->faker->randomNumber(2),
            'february' => $this->faker->randomNumber(2),
            'march' => $this->faker->randomNumber(2),
            'april' => $this->faker->randomNumber(2),
            'may' => $this->faker->randomNumber(2),
            'june' => $this->faker->randomNumber(2),
            'july' => $this->faker->randomNumber(2),
            'august' => $this->faker->randomNumber(2),
            'september' => $this->faker->randomNumber(2),
            'october' => $this->faker->randomNumber(2),
            'november' => $this->faker->randomNumber(2),
            'december' => $this->faker->randomNumber(2),
            'connection_point_id' => $connectionPoint->id,
        ];

        $response = $this->put(
            route('indication-quarters.update', $indicationQuarter),
            $data
        );

        $data['id'] = $indicationQuarter->id;

        $this->assertDatabaseHas('indication_quarters', $data);

        $response->assertRedirect(
            route('indication-quarters.edit', $indicationQuarter)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_indication_quarter(): void
    {
        $indicationQuarter = IndicationQuarter::factory()->create();

        $response = $this->delete(
            route('indication-quarters.destroy', $indicationQuarter)
        );

        $response->assertRedirect(route('indication-quarters.index'));

        $this->assertSoftDeleted($indicationQuarter);
    }
}
