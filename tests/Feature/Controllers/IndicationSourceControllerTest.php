<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\IndicationSource;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndicationSourceControllerTest extends TestCase
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
    public function it_displays_index_view_with_indication_sources(): void
    {
        $indicationSources = IndicationSource::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('indication-sources.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.indication_sources.index')
            ->assertViewHas('indicationSources');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_indication_source(): void
    {
        $response = $this->get(route('indication-sources.create'));

        $response->assertOk()->assertViewIs('app.indication_sources.create');
    }

    /**
     * @test
     */
    public function it_stores_the_indication_source(): void
    {
        $data = IndicationSource::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('indication-sources.store'), $data);

        $this->assertDatabaseHas('indication_sources', $data);

        $indicationSource = IndicationSource::latest('id')->first();

        $response->assertRedirect(
            route('indication-sources.edit', $indicationSource)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_indication_source(): void
    {
        $indicationSource = IndicationSource::factory()->create();

        $response = $this->get(
            route('indication-sources.show', $indicationSource)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.indication_sources.show')
            ->assertViewHas('indicationSource');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_indication_source(): void
    {
        $indicationSource = IndicationSource::factory()->create();

        $response = $this->get(
            route('indication-sources.edit', $indicationSource)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.indication_sources.edit')
            ->assertViewHas('indicationSource');
    }

    /**
     * @test
     */
    public function it_updates_the_indication_source(): void
    {
        $indicationSource = IndicationSource::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->put(
            route('indication-sources.update', $indicationSource),
            $data
        );

        $data['id'] = $indicationSource->id;

        $this->assertDatabaseHas('indication_sources', $data);

        $response->assertRedirect(
            route('indication-sources.edit', $indicationSource)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_indication_source(): void
    {
        $indicationSource = IndicationSource::factory()->create();

        $response = $this->delete(
            route('indication-sources.destroy', $indicationSource)
        );

        $response->assertRedirect(route('indication-sources.index'));

        $this->assertSoftDeleted($indicationSource);
    }
}
