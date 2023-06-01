<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Notification;
use App\Models\NotificationStatus;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotificationNotificationStatusesTest extends TestCase
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
    public function it_gets_notification_notification_statuses(): void
    {
        $notification = Notification::factory()->create();
        $notificationStatus = NotificationStatus::factory()->create();

        $notification->notificationStatuses()->attach($notificationStatus);

        $response = $this->getJson(
            route(
                'api.notifications.notification-statuses.index',
                $notification
            )
        );

        $response->assertOk()->assertSee($notificationStatus->name);
    }

    /**
     * @test
     */
    public function it_can_attach_notification_statuses_to_notification(): void
    {
        $notification = Notification::factory()->create();
        $notificationStatus = NotificationStatus::factory()->create();

        $response = $this->postJson(
            route('api.notifications.notification-statuses.store', [
                $notification,
                $notificationStatus,
            ])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $notification
                ->notificationStatuses()
                ->where('notification_statuses.id', $notificationStatus->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_notification_statuses_from_notification(): void
    {
        $notification = Notification::factory()->create();
        $notificationStatus = NotificationStatus::factory()->create();

        $response = $this->deleteJson(
            route('api.notifications.notification-statuses.store', [
                $notification,
                $notificationStatus,
            ])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $notification
                ->notificationStatuses()
                ->where('notification_statuses.id', $notificationStatus->id)
                ->exists()
        );
    }
}
