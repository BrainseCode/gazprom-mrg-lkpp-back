<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\RequestApprovalUnevenness;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RequestApprovalUnevennessControllerTest extends TestCase
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
    public function it_displays_index_view_with_request_approval_unevennesses(): void
    {
        $requestApprovalUnevennesses = RequestApprovalUnevenness::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('request-approval-unevennesses.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.request_approval_unevennesses.index')
            ->assertViewHas('requestApprovalUnevennesses');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_request_approval_unevenness(): void
    {
        $response = $this->get(route('request-approval-unevennesses.create'));

        $response
            ->assertOk()
            ->assertViewIs('app.request_approval_unevennesses.create');
    }

    /**
     * @test
     */
    public function it_stores_the_request_approval_unevenness(): void
    {
        $data = RequestApprovalUnevenness::factory()
            ->make()
            ->toArray();

        $response = $this->post(
            route('request-approval-unevennesses.store'),
            $data
        );

        $this->assertDatabaseHas('request_approval_unevennesses', $data);

        $requestApprovalUnevenness = RequestApprovalUnevenness::latest(
            'id'
        )->first();

        $response->assertRedirect(
            route(
                'request-approval-unevennesses.edit',
                $requestApprovalUnevenness
            )
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_request_approval_unevenness(): void
    {
        $requestApprovalUnevenness = RequestApprovalUnevenness::factory()->create();

        $response = $this->get(
            route(
                'request-approval-unevennesses.show',
                $requestApprovalUnevenness
            )
        );

        $response
            ->assertOk()
            ->assertViewIs('app.request_approval_unevennesses.show')
            ->assertViewHas('requestApprovalUnevenness');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_request_approval_unevenness(): void
    {
        $requestApprovalUnevenness = RequestApprovalUnevenness::factory()->create();

        $response = $this->get(
            route(
                'request-approval-unevennesses.edit',
                $requestApprovalUnevenness
            )
        );

        $response
            ->assertOk()
            ->assertViewIs('app.request_approval_unevennesses.edit')
            ->assertViewHas('requestApprovalUnevenness');
    }

    /**
     * @test
     */
    public function it_updates_the_request_approval_unevenness(): void
    {
        $requestApprovalUnevenness = RequestApprovalUnevenness::factory()->create();

        $user = User::factory()->create();

        $data = [
            'gas_volume' => $this->faker->randomNumber(2),
            'gas_volume_unallocated' => $this->faker->randomNumber(2),
            'total' => $this->faker->randomNumber(2),
            'user_id' => $user->id,
        ];

        $response = $this->put(
            route(
                'request-approval-unevennesses.update',
                $requestApprovalUnevenness
            ),
            $data
        );

        $data['id'] = $requestApprovalUnevenness->id;

        $this->assertDatabaseHas('request_approval_unevennesses', $data);

        $response->assertRedirect(
            route(
                'request-approval-unevennesses.edit',
                $requestApprovalUnevenness
            )
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_request_approval_unevenness(): void
    {
        $requestApprovalUnevenness = RequestApprovalUnevenness::factory()->create();

        $response = $this->delete(
            route(
                'request-approval-unevennesses.destroy',
                $requestApprovalUnevenness
            )
        );

        $response->assertRedirect(route('request-approval-unevennesses.index'));

        $this->assertSoftDeleted($requestApprovalUnevenness);
    }
}
