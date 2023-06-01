<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\MeasuringComplex;
use App\Models\TransferIndication;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MeasuringComplexTransferIndicationsTest extends TestCase
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
    public function it_gets_measuring_complex_transfer_indications(): void
    {
        $measuringComplex = MeasuringComplex::factory()->create();
        $transferIndications = TransferIndication::factory()
            ->count(2)
            ->create([
                'measuring_complex_id' => $measuringComplex->id,
            ]);

        $response = $this->getJson(
            route(
                'api.measuring-complexes.transfer-indications.index',
                $measuringComplex
            )
        );

        $response->assertOk()->assertSee($transferIndications[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_measuring_complex_transfer_indications(): void
    {
        $measuringComplex = MeasuringComplex::factory()->create();
        $data = TransferIndication::factory()
            ->make([
                'measuring_complex_id' => $measuringComplex->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.measuring-complexes.transfer-indications.store',
                $measuringComplex
            ),
            $data
        );

        unset($data['measuring_complex_id']);
        unset($data['date']);
        unset($data['indication']);
        unset($data['value']);

        $this->assertDatabaseHas('transfer_indications', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $transferIndication = TransferIndication::latest('id')->first();

        $this->assertEquals(
            $measuringComplex->id,
            $transferIndication->measuring_complex_id
        );
    }
}
