<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\TransferIndication;

use App\Models\MeasuringComplex;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransferIndicationTest extends TestCase
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
    public function it_gets_transfer_indications_list(): void
    {
        $transferIndications = TransferIndication::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.transfer-indications.index'));

        $response->assertOk()->assertSee($transferIndications[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_transfer_indication(): void
    {
        $data = TransferIndication::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.transfer-indications.store'),
            $data
        );

        unset($data['measuring_complex_id']);
        unset($data['date']);
        unset($data['indication']);
        unset($data['value']);

        $this->assertDatabaseHas('transfer_indications', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.transfer-indications.update', $transferIndication),
            $data
        );

        unset($data['measuring_complex_id']);
        unset($data['date']);
        unset($data['indication']);
        unset($data['value']);

        $data['id'] = $transferIndication->id;

        $this->assertDatabaseHas('transfer_indications', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_transfer_indication(): void
    {
        $transferIndication = TransferIndication::factory()->create();

        $response = $this->deleteJson(
            route('api.transfer-indications.destroy', $transferIndication)
        );

        $this->assertSoftDeleted($transferIndication);

        $response->assertNoContent();
    }
}
