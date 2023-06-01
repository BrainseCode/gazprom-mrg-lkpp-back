<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\RequestCallEmployee;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRequestCallEmployeesTest extends TestCase
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
    public function it_gets_user_request_call_employees(): void
    {
        $user = User::factory()->create();
        $requestCallEmployees = RequestCallEmployee::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(
            route('api.users.request-call-employees.index', $user)
        );

        $response->assertOk()->assertSee($requestCallEmployees[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_user_request_call_employees(): void
    {
        $user = User::factory()->create();
        $data = RequestCallEmployee::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.request-call-employees.store', $user),
            $data
        );

        unset($data['user_id']);

        $this->assertDatabaseHas('request_call_employees', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $requestCallEmployee = RequestCallEmployee::latest('id')->first();

        $this->assertEquals($user->id, $requestCallEmployee->user_id);
    }
}
