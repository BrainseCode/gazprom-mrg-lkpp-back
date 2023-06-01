<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Indication;
use App\Models\IndicationSource;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndicationIndicationSourcesTest extends TestCase
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
    public function it_gets_indication_indication_sources(): void
    {
        $indication = Indication::factory()->create();
        $indicationSource = IndicationSource::factory()->create();

        $indication->indicationSources()->attach($indicationSource);

        $response = $this->getJson(
            route('api.indications.indication-sources.index', $indication)
        );

        $response->assertOk()->assertSee($indicationSource->name);
    }

    /**
     * @test
     */
    public function it_can_attach_indication_sources_to_indication(): void
    {
        $indication = Indication::factory()->create();
        $indicationSource = IndicationSource::factory()->create();

        $response = $this->postJson(
            route('api.indications.indication-sources.store', [
                $indication,
                $indicationSource,
            ])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $indication
                ->indicationSources()
                ->where('indication_sources.id', $indicationSource->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_indication_sources_from_indication(): void
    {
        $indication = Indication::factory()->create();
        $indicationSource = IndicationSource::factory()->create();

        $response = $this->deleteJson(
            route('api.indications.indication-sources.store', [
                $indication,
                $indicationSource,
            ])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $indication
                ->indicationSources()
                ->where('indication_sources.id', $indicationSource->id)
                ->exists()
        );
    }
}
