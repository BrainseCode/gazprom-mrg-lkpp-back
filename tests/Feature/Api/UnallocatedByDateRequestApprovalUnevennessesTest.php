<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\UnallocatedByDate;
use App\Models\RequestApprovalUnevenness;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UnallocatedByDateRequestApprovalUnevennessesTest extends TestCase
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
    public function it_gets_unallocated_by_date_request_approval_unevennesses(): void
    {
        $unallocatedByDate = UnallocatedByDate::factory()->create();
        $requestApprovalUnevenness = RequestApprovalUnevenness::factory()->create();

        $unallocatedByDate
            ->requestApprovalUnevennesses()
            ->attach($requestApprovalUnevenness);

        $response = $this->getJson(
            route(
                'api.unallocated-by-dates.request-approval-unevennesses.index',
                $unallocatedByDate
            )
        );

        $response->assertOk()->assertSee($requestApprovalUnevenness->id);
    }

    /**
     * @test
     */
    public function it_can_attach_request_approval_unevennesses_to_unallocated_by_date(): void
    {
        $unallocatedByDate = UnallocatedByDate::factory()->create();
        $requestApprovalUnevenness = RequestApprovalUnevenness::factory()->create();

        $response = $this->postJson(
            route(
                'api.unallocated-by-dates.request-approval-unevennesses.store',
                [$unallocatedByDate, $requestApprovalUnevenness]
            )
        );

        $response->assertNoContent();

        $this->assertTrue(
            $unallocatedByDate
                ->requestApprovalUnevennesses()
                ->where(
                    'request_approval_unevennesses.id',
                    $requestApprovalUnevenness->id
                )
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_request_approval_unevennesses_from_unallocated_by_date(): void
    {
        $unallocatedByDate = UnallocatedByDate::factory()->create();
        $requestApprovalUnevenness = RequestApprovalUnevenness::factory()->create();

        $response = $this->deleteJson(
            route(
                'api.unallocated-by-dates.request-approval-unevennesses.store',
                [$unallocatedByDate, $requestApprovalUnevenness]
            )
        );

        $response->assertNoContent();

        $this->assertFalse(
            $unallocatedByDate
                ->requestApprovalUnevennesses()
                ->where(
                    'request_approval_unevennesses.id',
                    $requestApprovalUnevenness->id
                )
                ->exists()
        );
    }
}
