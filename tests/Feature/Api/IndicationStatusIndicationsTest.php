<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Indication;
use App\Models\IndicationStatus;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndicationStatusIndicationsTest extends TestCase
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
    public function it_gets_indication_status_indications(): void
    {
        $indicationStatus = IndicationStatus::factory()->create();
        $indication = Indication::factory()->create();

        $indicationStatus->indications()->attach($indication);

        $response = $this->getJson(
            route(
                'api.indication-statuses.indications.index',
                $indicationStatus
            )
        );

        $response->assertOk()->assertSee($indication->date);
    }

    /**
     * @test
     */
    public function it_can_attach_indications_to_indication_status(): void
    {
        $indicationStatus = IndicationStatus::factory()->create();
        $indication = Indication::factory()->create();

        $response = $this->postJson(
            route('api.indication-statuses.indications.store', [
                $indicationStatus,
                $indication,
            ])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $indicationStatus
                ->indications()
                ->where('indications.id', $indication->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_indications_from_indication_status(): void
    {
        $indicationStatus = IndicationStatus::factory()->create();
        $indication = Indication::factory()->create();

        $response = $this->deleteJson(
            route('api.indication-statuses.indications.store', [
                $indicationStatus,
                $indication,
            ])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $indicationStatus
                ->indications()
                ->where('indications.id', $indication->id)
                ->exists()
        );
    }
}
