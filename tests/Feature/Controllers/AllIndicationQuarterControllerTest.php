<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\AllIndicationQuarter;

use App\Models\Contract;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AllIndicationQuarterControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_indication_quarters(): void
    {
        $allIndicationQuarters = AllIndicationQuarter::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-indication-quarters.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_indication_quarters.index')
            ->assertViewHas('allIndicationQuarters');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_all_indication_quarter(): void
    {
        $response = $this->get(route('all-indication-quarters.create'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_indication_quarters.create');
    }

    /**
     * @test
     */
    public function it_stores_the_all_indication_quarter(): void
    {
        $data = AllIndicationQuarter::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-indication-quarters.store'), $data);

        $this->assertDatabaseHas('all_indication_quarters', $data);

        $allIndicationQuarter = AllIndicationQuarter::latest('id')->first();

        $response->assertRedirect(
            route('all-indication-quarters.edit', $allIndicationQuarter)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_all_indication_quarter(): void
    {
        $allIndicationQuarter = AllIndicationQuarter::factory()->create();

        $response = $this->get(
            route('all-indication-quarters.show', $allIndicationQuarter)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.all_indication_quarters.show')
            ->assertViewHas('allIndicationQuarter');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_all_indication_quarter(): void
    {
        $allIndicationQuarter = AllIndicationQuarter::factory()->create();

        $response = $this->get(
            route('all-indication-quarters.edit', $allIndicationQuarter)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.all_indication_quarters.edit')
            ->assertViewHas('allIndicationQuarter');
    }

    /**
     * @test
     */
    public function it_updates_the_all_indication_quarter(): void
    {
        $allIndicationQuarter = AllIndicationQuarter::factory()->create();

        $contract = Contract::factory()->create();

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
            'contract_id' => $contract->id,
        ];

        $response = $this->put(
            route('all-indication-quarters.update', $allIndicationQuarter),
            $data
        );

        $data['id'] = $allIndicationQuarter->id;

        $this->assertDatabaseHas('all_indication_quarters', $data);

        $response->assertRedirect(
            route('all-indication-quarters.edit', $allIndicationQuarter)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_all_indication_quarter(): void
    {
        $allIndicationQuarter = AllIndicationQuarter::factory()->create();

        $response = $this->delete(
            route('all-indication-quarters.destroy', $allIndicationQuarter)
        );

        $response->assertRedirect(route('all-indication-quarters.index'));

        $this->assertSoftDeleted($allIndicationQuarter);
    }
}
