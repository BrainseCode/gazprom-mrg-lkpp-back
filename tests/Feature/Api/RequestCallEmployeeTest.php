<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\RequestCallEmployee;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RequestCallEmployeeTest extends TestCase
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
    public function it_gets_request_call_employees_list(): void
    {
        $requestCallEmployees = RequestCallEmployee::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.request-call-employees.index'));

        $response->assertOk()->assertSee($requestCallEmployees[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_request_call_employee(): void
    {
        $data = RequestCallEmployee::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.request-call-employees.store'),
            $data
        );

        unset($data['user_id']);

        $this->assertDatabaseHas('request_call_employees', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_request_call_employee(): void
    {
        $requestCallEmployee = RequestCallEmployee::factory()->create();

        $user = User::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'message' => $this->faker->sentence(20),
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.request-call-employees.update', $requestCallEmployee),
            $data
        );

        unset($data['user_id']);

        $data['id'] = $requestCallEmployee->id;

        $this->assertDatabaseHas('request_call_employees', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_request_call_employee(): void
    {
        $requestCallEmployee = RequestCallEmployee::factory()->create();

        $response = $this->deleteJson(
            route('api.request-call-employees.destroy', $requestCallEmployee)
        );

        $this->assertSoftDeleted($requestCallEmployee);

        $response->assertNoContent();
    }
}
