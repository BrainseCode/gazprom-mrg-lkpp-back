<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\UniversalRequest;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserUniversalRequestsTest extends TestCase
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
    public function it_gets_user_universal_requests(): void
    {
        $user = User::factory()->create();
        $universalRequests = UniversalRequest::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(
            route('api.users.universal-requests.index', $user)
        );

        $response->assertOk()->assertSee($universalRequests[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_user_universal_requests(): void
    {
        $user = User::factory()->create();
        $data = UniversalRequest::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.universal-requests.store', $user),
            $data
        );

        $this->assertDatabaseHas('universal_requests', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $universalRequest = UniversalRequest::latest('id')->first();

        $this->assertEquals($user->id, $universalRequest->user_id);
    }
}
