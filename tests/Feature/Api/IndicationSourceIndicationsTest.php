<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Indication;
use App\Models\IndicationSource;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndicationSourceIndicationsTest extends TestCase
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
    public function it_gets_indication_source_indications(): void
    {
        $indicationSource = IndicationSource::factory()->create();
        $indication = Indication::factory()->create();

        $indicationSource->indications()->attach($indication);

        $response = $this->getJson(
            route('api.indication-sources.indications.index', $indicationSource)
        );

        $response->assertOk()->assertSee($indication->date);
    }

    /**
     * @test
     */
    public function it_can_attach_indications_to_indication_source(): void
    {
        $indicationSource = IndicationSource::factory()->create();
        $indication = Indication::factory()->create();

        $response = $this->postJson(
            route('api.indication-sources.indications.store', [
                $indicationSource,
                $indication,
            ])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $indicationSource
                ->indications()
                ->where('indications.id', $indication->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_indications_from_indication_source(): void
    {
        $indicationSource = IndicationSource::factory()->create();
        $indication = Indication::factory()->create();

        $response = $this->deleteJson(
            route('api.indication-sources.indications.store', [
                $indicationSource,
                $indication,
            ])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $indicationSource
                ->indications()
                ->where('indications.id', $indication->id)
                ->exists()
        );
    }
}
