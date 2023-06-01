<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Notification;
use App\Models\NotificationStatus;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotificationStatusNotificationsTest extends TestCase
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
    public function it_gets_notification_status_notifications(): void
    {
        $notificationStatus = NotificationStatus::factory()->create();
        $notification = Notification::factory()->create();

        $notificationStatus->notifications()->attach($notification);

        $response = $this->getJson(
            route(
                'api.notification-statuses.notifications.index',
                $notificationStatus
            )
        );

        $response->assertOk()->assertSee($notification->name);
    }

    /**
     * @test
     */
    public function it_can_attach_notifications_to_notification_status(): void
    {
        $notificationStatus = NotificationStatus::factory()->create();
        $notification = Notification::factory()->create();

        $response = $this->postJson(
            route('api.notification-statuses.notifications.store', [
                $notificationStatus,
                $notification,
            ])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $notificationStatus
                ->notifications()
                ->where('notifications.id', $notification->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_notifications_from_notification_status(): void
    {
        $notificationStatus = NotificationStatus::factory()->create();
        $notification = Notification::factory()->create();

        $response = $this->deleteJson(
            route('api.notification-statuses.notifications.store', [
                $notificationStatus,
                $notification,
            ])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $notificationStatus
                ->notifications()
                ->where('notifications.id', $notification->id)
                ->exists()
        );
    }
}
