<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ContractType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractTypeControllerTest extends TestCase
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
    public function it_displays_index_view_with_contract_types(): void
    {
        $contractTypes = ContractType::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('contract-types.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.contract_types.index')
            ->assertViewHas('contractTypes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_contract_type(): void
    {
        $response = $this->get(route('contract-types.create'));

        $response->assertOk()->assertViewIs('app.contract_types.create');
    }

    /**
     * @test
     */
    public function it_stores_the_contract_type(): void
    {
        $data = ContractType::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('contract-types.store'), $data);

        $this->assertDatabaseHas('contract_types', $data);

        $contractType = ContractType::latest('id')->first();

        $response->assertRedirect(route('contract-types.edit', $contractType));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_contract_type(): void
    {
        $contractType = ContractType::factory()->create();

        $response = $this->get(route('contract-types.show', $contractType));

        $response
            ->assertOk()
            ->assertViewIs('app.contract_types.show')
            ->assertViewHas('contractType');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_contract_type(): void
    {
        $contractType = ContractType::factory()->create();

        $response = $this->get(route('contract-types.edit', $contractType));

        $response
            ->assertOk()
            ->assertViewIs('app.contract_types.edit')
            ->assertViewHas('contractType');
    }

    /**
     * @test
     */
    public function it_updates_the_contract_type(): void
    {
        $contractType = ContractType::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->put(
            route('contract-types.update', $contractType),
            $data
        );

        $data['id'] = $contractType->id;

        $this->assertDatabaseHas('contract_types', $data);

        $response->assertRedirect(route('contract-types.edit', $contractType));
    }

    /**
     * @test
     */
    public function it_deletes_the_contract_type(): void
    {
        $contractType = ContractType::factory()->create();

        $response = $this->delete(
            route('contract-types.destroy', $contractType)
        );

        $response->assertRedirect(route('contract-types.index'));

        $this->assertSoftDeleted($contractType);
    }
}
