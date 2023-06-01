<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\UniversalRequest;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UniversalRequestControllerTest extends TestCase
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
    public function it_displays_index_view_with_universal_requests(): void
    {
        $universalRequests = UniversalRequest::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('universal-requests.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.universal_requests.index')
            ->assertViewHas('universalRequests');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_universal_request(): void
    {
        $response = $this->get(route('universal-requests.create'));

        $response->assertOk()->assertViewIs('app.universal_requests.create');
    }

    /**
     * @test
     */
    public function it_stores_the_universal_request(): void
    {
        $data = UniversalRequest::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('universal-requests.store'), $data);

        $this->assertDatabaseHas('universal_requests', $data);

        $universalRequest = UniversalRequest::latest('id')->first();

        $response->assertRedirect(
            route('universal-requests.edit', $universalRequest)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_universal_request(): void
    {
        $universalRequest = UniversalRequest::factory()->create();

        $response = $this->get(
            route('universal-requests.show', $universalRequest)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.universal_requests.show')
            ->assertViewHas('universalRequest');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_universal_request(): void
    {
        $universalRequest = UniversalRequest::factory()->create();

        $response = $this->get(
            route('universal-requests.edit', $universalRequest)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.universal_requests.edit')
            ->assertViewHas('universalRequest');
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

        $response = $this->put(
            route('universal-requests.update', $universalRequest),
            $data
        );

        $data['id'] = $universalRequest->id;

        $this->assertDatabaseHas('universal_requests', $data);

        $response->assertRedirect(
            route('universal-requests.edit', $universalRequest)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_universal_request(): void
    {
        $universalRequest = UniversalRequest::factory()->create();

        $response = $this->delete(
            route('universal-requests.destroy', $universalRequest)
        );

        $response->assertRedirect(route('universal-requests.index'));

        $this->assertSoftDeleted($universalRequest);
    }
}
