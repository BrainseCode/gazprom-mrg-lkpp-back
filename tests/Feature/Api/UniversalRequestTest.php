<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\UniversalRequest;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UniversalRequestTest extends TestCase
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
    public function it_gets_universal_requests_list(): void
    {
        $universalRequests = UniversalRequest::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.universal-requests.index'));

        $response->assertOk()->assertSee($universalRequests[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_universal_request(): void
    {
        $data = UniversalRequest::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.universal-requests.store'),
            $data
        );

        $this->assertDatabaseHas('universal_requests', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_universal_request(): void
    {
        $universalRequest = UniversalRequest::factory()->create();

        $user = User::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'message' => $this->faker->sentence(20),
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.universal-requests.update', $universalRequest),
            $data
        );

        $data['id'] = $universalRequest->id;

        $this->assertDatabaseHas('universal_requests', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_universal_request(): void
    {
        $universalRequest = UniversalRequest::factory()->create();

        $response = $this->deleteJson(
            route('api.universal-requests.destroy', $universalRequest)
        );

        $this->assertSoftDeleted($universalRequest);

        $response->assertNoContent();
    }
}
