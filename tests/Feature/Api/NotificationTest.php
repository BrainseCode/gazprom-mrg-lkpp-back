<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Notification;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotificationTest extends TestCase
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
    public function it_gets_notifications_list(): void
    {
        $notifications = Notification::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.notifications.index'));

        $response->assertOk()->assertSee($notifications[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_notification(): void
    {
        $data = Notification::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.notifications.store'), $data);

        $this->assertDatabaseHas('notifications', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_notification(): void
    {
        $notification = Notification::factory()->create();

        $user = User::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'date' => $this->faker->date(),
            'message' => $this->faker->sentence(20),
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.notifications.update', $notification),
            $data
        );

        $data['id'] = $notification->id;

        $this->assertDatabaseHas('notifications', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_notification(): void
    {
        $notification = Notification::factory()->create();

        $response = $this->deleteJson(
            route('api.notifications.destroy', $notification)
        );

        $this->assertSoftDeleted($notification);

        $response->assertNoContent();
    }
}
