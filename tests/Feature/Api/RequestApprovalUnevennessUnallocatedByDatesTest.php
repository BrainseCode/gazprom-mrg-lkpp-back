<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\UnallocatedByDate;
use App\Models\RequestApprovalUnevenness;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RequestApprovalUnevennessUnallocatedByDatesTest extends TestCase
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
    public function it_gets_request_approval_unevenness_unallocated_by_dates(): void
    {
        $requestApprovalUnevenness = RequestApprovalUnevenness::factory()->create();
        $unallocatedByDate = UnallocatedByDate::factory()->create();

        $requestApprovalUnevenness
            ->unallocatedByDates()
            ->attach($unallocatedByDate);

        $response = $this->getJson(
            route(
                'api.request-approval-unevennesses.unallocated-by-dates.index',
                $requestApprovalUnevenness
            )
        );

        $response->assertOk()->assertSee($unallocatedByDate->date);
    }

    /**
     * @test
     */
    public function it_can_attach_unallocated_by_dates_to_request_approval_unevenness(): void
    {
        $requestApprovalUnevenness = RequestApprovalUnevenness::factory()->create();
        $unallocatedByDate = UnallocatedByDate::factory()->create();

        $response = $this->postJson(
            route(
                'api.request-approval-unevennesses.unallocated-by-dates.store',
                [$requestApprovalUnevenness, $unallocatedByDate]
            )
        );

        $response->assertNoContent();

        $this->assertTrue(
            $requestApprovalUnevenness
                ->unallocatedByDates()
                ->where('unallocated_by_dates.id', $unallocatedByDate->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_unallocated_by_dates_from_request_approval_unevenness(): void
    {
        $requestApprovalUnevenness = RequestApprovalUnevenness::factory()->create();
        $unallocatedByDate = UnallocatedByDate::factory()->create();

        $response = $this->deleteJson(
            route(
                'api.request-approval-unevennesses.unallocated-by-dates.store',
                [$requestApprovalUnevenness, $unallocatedByDate]
            )
        );

        $response->assertNoContent();

        $this->assertFalse(
            $requestApprovalUnevenness
                ->unallocatedByDates()
                ->where('unallocated_by_dates.id', $unallocatedByDate->id)
                ->exists()
        );
    }
}
