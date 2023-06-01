<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\NotificationStatus;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotificationStatusTest extends TestCase
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
    public function it_gets_notification_statuses_list(): void
    {
        $notificationStatuses = NotificationStatus::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.notification-statuses.index'));

        $response->assertOk()->assertSee($notificationStatuses[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_notification_status(): void
    {
        $data = NotificationStatus::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.notification-statuses.store'),
            $data
        );

        $this->assertDatabaseHas('notification_statuses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_notification_status(): void
    {
        $notificationStatus = NotificationStatus::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(
            route('api.notification-statuses.update', $notificationStatus),
            $data
        );

        $data['id'] = $notificationStatus->id;

        $this->assertDatabaseHas('notification_statuses', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_notification_status(): void
    {
        $notificationStatus = NotificationStatus::factory()->create();

        $response = $this->deleteJson(
            route('api.notification-statuses.destroy', $notificationStatus)
        );

        $this->assertSoftDeleted($notificationStatus);

        $response->assertNoContent();
    }
}
