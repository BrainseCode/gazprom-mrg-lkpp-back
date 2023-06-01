<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ContractStatus;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractStatusControllerTest extends TestCase
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
    public function it_displays_index_view_with_contract_statuses(): void
    {
        $contractStatuses = ContractStatus::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('contract-statuses.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.contract_statuses.index')
            ->assertViewHas('contractStatuses');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_contract_status(): void
    {
        $response = $this->get(route('contract-statuses.create'));

        $response->assertOk()->assertViewIs('app.contract_statuses.create');
    }

    /**
     * @test
     */
    public function it_stores_the_contract_status(): void
    {
        $data = ContractStatus::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('contract-statuses.store'), $data);

        $this->assertDatabaseHas('contract_statuses', $data);

        $contractStatus = ContractStatus::latest('id')->first();

        $response->assertRedirect(
            route('contract-statuses.edit', $contractStatus)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_contract_status(): void
    {
        $contractStatus = ContractStatus::factory()->create();

        $response = $this->get(
            route('contract-statuses.show', $contractStatus)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.contract_statuses.show')
            ->assertViewHas('contractStatus');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_contract_status(): void
    {
        $contractStatus = ContractStatus::factory()->create();

        $response = $this->get(
            route('contract-statuses.edit', $contractStatus)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.contract_statuses.edit')
            ->assertViewHas('contractStatus');
    }

    /**
     * @test
     */
    public function it_updates_the_contract_status(): void
    {
        $contractStatus = ContractStatus::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->put(
            route('contract-statuses.update', $contractStatus),
            $data
        );

        $data['id'] = $contractStatus->id;

        $this->assertDatabaseHas('contract_statuses', $data);

        $response->assertRedirect(
            route('contract-statuses.edit', $contractStatus)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_contract_status(): void
    {
        $contractStatus = ContractStatus::factory()->create();

        $response = $this->delete(
            route('contract-statuses.destroy', $contractStatus)
        );

        $response->assertRedirect(route('contract-statuses.index'));

        $this->assertSoftDeleted($contractStatus);
    }
}
