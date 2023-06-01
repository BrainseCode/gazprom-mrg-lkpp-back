<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\RequestApprovalUnevenness;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RequestApprovalUnevennessTest extends TestCase
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
    public function it_gets_request_approval_unevennesses_list(): void
    {
        $requestApprovalUnevennesses = RequestApprovalUnevenness::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(
            route('api.request-approval-unevennesses.index')
        );

        $response->assertOk()->assertSee($requestApprovalUnevennesses[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_request_approval_unevenness(): void
    {
        $data = RequestApprovalUnevenness::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.request-approval-unevennesses.store'),
            $data
        );

        $this->assertDatabaseHas('request_approval_unevennesses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route(
                'api.request-approval-unevennesses.update',
                $requestApprovalUnevenness
            ),
            $data
        );

        $data['id'] = $requestApprovalUnevenness->id;

        $this->assertDatabaseHas('request_approval_unevennesses', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_request_approval_unevenness(): void
    {
        $requestApprovalUnevenness = RequestApprovalUnevenness::factory()->create();

        $response = $this->deleteJson(
            route(
                'api.request-approval-unevennesses.destroy',
                $requestApprovalUnevenness
            )
        );

        $this->assertSoftDeleted($requestApprovalUnevenness);

        $response->assertNoContent();
    }
}
