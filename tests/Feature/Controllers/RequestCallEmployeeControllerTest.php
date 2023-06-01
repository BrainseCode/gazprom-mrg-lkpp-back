<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\RequestCallEmployee;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RequestCallEmployeeControllerTest extends TestCase
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
    public function it_displays_index_view_with_request_call_employees(): void
    {
        $requestCallEmployees = RequestCallEmployee::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('request-call-employees.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.request_call_employees.index')
            ->assertViewHas('requestCallEmployees');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_request_call_employee(): void
    {
        $response = $this->get(route('request-call-employees.create'));

        $response
            ->assertOk()
            ->assertViewIs('app.request_call_employees.create');
    }

    /**
     * @test
     */
    public function it_stores_the_request_call_employee(): void
    {
        $data = RequestCallEmployee::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('request-call-employees.store'), $data);

        unset($data['user_id']);

        $this->assertDatabaseHas('request_call_employees', $data);

        $requestCallEmployee = RequestCallEmployee::latest('id')->first();

        $response->assertRedirect(
            route('request-call-employees.edit', $requestCallEmployee)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_request_call_employee(): void
    {
        $requestCallEmployee = RequestCallEmployee::factory()->create();

        $response = $this->get(
            route('request-call-employees.show', $requestCallEmployee)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.request_call_employees.show')
            ->assertViewHas('requestCallEmployee');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_request_call_employee(): void
    {
        $requestCallEmployee = RequestCallEmployee::factory()->create();

        $response = $this->get(
            route('request-call-employees.edit', $requestCallEmployee)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.request_call_employees.edit')
            ->assertViewHas('requestCallEmployee');
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

        $response = $this->put(
            route('request-call-employees.update', $requestCallEmployee),
            $data
        );

        unset($data['user_id']);

        $data['id'] = $requestCallEmployee->id;

        $this->assertDatabaseHas('request_call_employees', $data);

        $response->assertRedirect(
            route('request-call-employees.edit', $requestCallEmployee)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_request_call_employee(): void
    {
        $requestCallEmployee = RequestCallEmployee::factory()->create();

        $response = $this->delete(
            route('request-call-employees.destroy', $requestCallEmployee)
        );

        $response->assertRedirect(route('request-call-employees.index'));

        $this->assertSoftDeleted($requestCallEmployee);
    }
}
