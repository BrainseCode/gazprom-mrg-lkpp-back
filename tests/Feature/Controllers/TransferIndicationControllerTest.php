<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\TransferIndication;

use App\Models\MeasuringComplex;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransferIndicationControllerTest extends TestCase
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
    public function it_displays_index_view_with_transfer_indications(): void
    {
        $transferIndications = TransferIndication::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('transfer-indications.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.transfer_indications.index')
            ->assertViewHas('transferIndications');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_transfer_indication(): void
    {
        $response = $this->get(route('transfer-indications.create'));

        $response->assertOk()->assertViewIs('app.transfer_indications.create');
    }

    /**
     * @test
     */
    public function it_stores_the_transfer_indication(): void
    {
        $data = TransferIndication::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('transfer-indications.store'), $data);

        unset($data['measuring_complex_id']);
        unset($data['date']);
        unset($data['indication']);
        unset($data['value']);

        $this->assertDatabaseHas('transfer_indications', $data);

        $transferIndication = TransferIndication::latest('id')->first();

        $response->assertRedirect(
            route('transfer-indications.edit', $transferIndication)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_transfer_indication(): void
    {
        $transferIndication = TransferIndication::factory()->create();

        $response = $this->get(
            route('transfer-indications.show', $transferIndication)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.transfer_indications.show')
            ->assertViewHas('transferIndication');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_transfer_indication(): void
    {
        $transferIndication = TransferIndication::factory()->create();

        $response = $this->get(
            route('transfer-indications.edit', $transferIndication)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.transfer_indications.edit')
            ->assertViewHas('transferIndication');
    }

    /**
     * @test
     */
    public function it_updates_the_transfer_indication(): void
    {
        $transferIndication = TransferIndication::factory()->create();

        $measuringComplex = MeasuringComplex::factory()->create();

        $data = [
            'date' => $this->faker->date(),
            'indication' => $this->faker->randomNumber(2),
            'value' => $this->faker->randomNumber(2),
            'measuring_complex_id' => $measuringComplex->id,
        ];

        $response = $this->put(
            route('transfer-indications.update', $transferIndication),
            $data
        );

        unset($data['measuring_complex_id']);
        unset($data['date']);
        unset($data['indication']);
        unset($data['value']);

        $data['id'] = $transferIndication->id;

        $this->assertDatabaseHas('transfer_indications', $data);

        $response->assertRedirect(
            route('transfer-indications.edit', $transferIndication)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_transfer_indication(): void
    {
        $transferIndication = TransferIndication::factory()->create();

        $response = $this->delete(
            route('transfer-indications.destroy', $transferIndication)
        );

        $response->assertRedirect(route('transfer-indications.index'));

        $this->assertSoftDeleted($transferIndication);
    }
}
