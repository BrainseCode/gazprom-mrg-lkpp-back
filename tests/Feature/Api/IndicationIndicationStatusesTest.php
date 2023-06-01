<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Indication;
use App\Models\IndicationStatus;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndicationIndicationStatusesTest extends TestCase
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
    public function it_gets_indication_indication_statuses(): void
    {
        $indication = Indication::factory()->create();
        $indicationStatus = IndicationStatus::factory()->create();

        $indication->indicationStatuses()->attach($indicationStatus);

        $response = $this->getJson(
            route('api.indications.indication-statuses.index', $indication)
        );

        $response->assertOk()->assertSee($indicationStatus->name);
    }

    /**
     * @test
     */
    public function it_can_attach_indication_statuses_to_indication(): void
    {
        $indication = Indication::factory()->create();
        $indicationStatus = IndicationStatus::factory()->create();

        $response = $this->postJson(
            route('api.indications.indication-statuses.store', [
                $indication,
                $indicationStatus,
            ])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $indication
                ->indicationStatuses()
                ->where('indication_statuses.id', $indicationStatus->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_indication_statuses_from_indication(): void
    {
        $indication = Indication::factory()->create();
        $indicationStatus = IndicationStatus::factory()->create();

        $response = $this->deleteJson(
            route('api.indications.indication-statuses.store', [
                $indication,
                $indicationStatus,
            ])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $indication
                ->indicationStatuses()
                ->where('indication_statuses.id', $indicationStatus->id)
                ->exists()
        );
    }
}
