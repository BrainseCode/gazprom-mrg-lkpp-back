<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PayTotal;

use App\Models\Contract;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PayTotalTest extends TestCase
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
    public function it_gets_pay_totals_list(): void
    {
        $payTotals = PayTotal::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.pay-totals.index'));

        $response->assertOk()->assertSee($payTotals[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_pay_total(): void
    {
        $data = PayTotal::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.pay-totals.store'), $data);

        $this->assertDatabaseHas('pay_totals', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_pay_total(): void
    {
        $payTotal = PayTotal::factory()->create();

        $contract = Contract::factory()->create();

        $data = [
            'pay_delivered' => $this->faker->randomNumber(2),
            'pay_planned' => $this->faker->randomNumber(2),
            'pay_tovdgo' => $this->faker->randomNumber(2),
            'total' => $this->faker->randomNumber(2),
            'total_nds' => $this->faker->randomNumber(2),
            'contract_id' => $contract->id,
        ];

        $response = $this->putJson(
            route('api.pay-totals.update', $payTotal),
            $data
        );

        $data['id'] = $payTotal->id;

        $this->assertDatabaseHas('pay_totals', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_pay_total(): void
    {
        $payTotal = PayTotal::factory()->create();

        $response = $this->deleteJson(
            route('api.pay-totals.destroy', $payTotal)
        );

        $this->assertSoftDeleted($payTotal);

        $response->assertNoContent();
    }
}
