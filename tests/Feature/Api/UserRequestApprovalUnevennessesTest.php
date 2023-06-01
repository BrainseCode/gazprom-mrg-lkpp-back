<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\RequestApprovalUnevenness;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRequestApprovalUnevennessesTest extends TestCase
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
    public function it_gets_user_request_approval_unevennesses(): void
    {
        $user = User::factory()->create();
        $requestApprovalUnevennesses = RequestApprovalUnevenness::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(
            route('api.users.request-approval-unevennesses.index', $user)
        );

        $response->assertOk()->assertSee($requestApprovalUnevennesses[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_user_request_approval_unevennesses(): void
    {
        $user = User::factory()->create();
        $data = RequestApprovalUnevenness::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.request-approval-unevennesses.store', $user),
            $data
        );

        $this->assertDatabaseHas('request_approval_unevennesses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $requestApprovalUnevenness = RequestApprovalUnevenness::latest(
            'id'
        )->first();

        $this->assertEquals($user->id, $requestApprovalUnevenness->user_id);
    }
}
