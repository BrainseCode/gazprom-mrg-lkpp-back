<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\NotificationStatus;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotificationStatusControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_notification_statuses(): void
    {
        $notificationStatuses = NotificationStatus::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('notification-statuses.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.notification_statuses.index')
            ->assertViewHas('notificationStatuses');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_notification_status(): void
    {
        $response = $this->get(route('notification-statuses.create'));

        $response->assertOk()->assertViewIs('app.notification_statuses.create');
    }

    /**
     * @test
     */
    public function it_stores_the_notification_status(): void
    {
        $data = NotificationStatus::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('notification-statuses.store'), $data);

        $this->assertDatabaseHas('notification_statuses', $data);

        $notificationStatus = NotificationStatus::latest('id')->first();

        $response->assertRedirect(
            route('notification-statuses.edit', $notificationStatus)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_notification_status(): void
    {
        $notificationStatus = NotificationStatus::factory()->create();

        $response = $this->get(
            route('notification-statuses.show', $notificationStatus)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.notification_statuses.show')
            ->assertViewHas('notificationStatus');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_notification_status(): void
    {
        $notificationStatus = NotificationStatus::factory()->create();

        $response = $this->get(
            route('notification-statuses.edit', $notificationStatus)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.notification_statuses.edit')
            ->assertViewHas('notificationStatus');
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

        $response = $this->put(
            route('notification-statuses.update', $notificationStatus),
            $data
        );

        $data['id'] = $notificationStatus->id;

        $this->assertDatabaseHas('notification_statuses', $data);

        $response->assertRedirect(
            route('notification-statuses.edit', $notificationStatus)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_notification_status(): void
    {
        $notificationStatus = NotificationStatus::factory()->create();

        $response = $this->delete(
            route('notification-statuses.destroy', $notificationStatus)
        );

        $response->assertRedirect(route('notification-statuses.index'));

        $this->assertSoftDeleted($notificationStatus);
    }
}
