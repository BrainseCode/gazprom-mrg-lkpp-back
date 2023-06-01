<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\IndicationSource;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndicationSourceTest extends TestCase
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
    public function it_gets_indication_sources_list(): void
    {
        $indicationSources = IndicationSource::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.indication-sources.index'));

        $response->assertOk()->assertSee($indicationSources[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_indication_source(): void
    {
        $data = IndicationSource::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.indication-sources.store'),
            $data
        );

        $this->assertDatabaseHas('indication_sources', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.indication-sources.update', $indicationSource),
            $data
        );

        $data['id'] = $indicationSource->id;

        $this->assertDatabaseHas('indication_sources', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_indication_source(): void
    {
        $indicationSource = IndicationSource::factory()->create();

        $response = $this->deleteJson(
            route('api.indication-sources.destroy', $indicationSource)
        );

        $this->assertSoftDeleted($indicationSource);

        $response->assertNoContent();
    }
}
