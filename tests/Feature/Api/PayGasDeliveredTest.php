<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PayGasDelivered;

use App\Models\Contract;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PayGasDeliveredTest extends TestCase
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
    public function it_gets_pay_gas_delivereds_list(): void
    {
        $payGasDelivereds = PayGasDelivered::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.pay-gas-delivereds.index'));

        $response->assertOk()->assertSee($payGasDelivereds[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_pay_gas_delivered(): void
    {
        $data = PayGasDelivered::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.pay-gas-delivereds.store'),
            $data
        );

        $this->assertDatabaseHas('pay_gas_delivereds', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_pay_gas_delivered(): void
    {
        $payGasDelivered = PayGasDelivered::factory()->create();

        $contract = Contract::factory()->create();

        $data = [
            'date' => $this->faker->date(),
            'summ' => $this->faker->randomNumber(2),
            'status_pay' => $this->faker->boolean(),
            'contract_id' => $contract->id,
        ];

        $response = $this->putJson(
            route('api.pay-gas-delivereds.update', $payGasDelivered),
            $data
        );

        $data['id'] = $payGasDelivered->id;

        $this->assertDatabaseHas('pay_gas_delivereds', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_pay_gas_delivered(): void
    {
        $payGasDelivered = PayGasDelivered::factory()->create();

        $response = $this->deleteJson(
            route('api.pay-gas-delivereds.destroy', $payGasDelivered)
        );

        $this->assertSoftDeleted($payGasDelivered);

        $response->assertNoContent();
    }
}
