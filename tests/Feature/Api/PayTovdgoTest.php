<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PayTovdgo;

use App\Models\Contract;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PayTovdgoTest extends TestCase
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
    public function it_gets_pay_tovdgos_list(): void
    {
        $payTovdgos = PayTovdgo::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.pay-tovdgos.index'));

        $response->assertOk()->assertSee($payTovdgos[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_pay_tovdgo(): void
    {
        $data = PayTovdgo::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.pay-tovdgos.store'), $data);

        $this->assertDatabaseHas('pay_tovdgos', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_pay_tovdgo(): void
    {
        $payTovdgo = PayTovdgo::factory()->create();

        $contract = Contract::factory()->create();

        $data = [
            'date' => $this->faker->date(),
            'summ' => $this->faker->randomNumber(2),
            'status_pay' => $this->faker->boolean(),
            'contract_id' => $contract->id,
        ];

        $response = $this->putJson(
            route('api.pay-tovdgos.update', $payTovdgo),
            $data
        );

        $data['id'] = $payTovdgo->id;

        $this->assertDatabaseHas('pay_tovdgos', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_pay_tovdgo(): void
    {
        $payTovdgo = PayTovdgo::factory()->create();

        $response = $this->deleteJson(
            route('api.pay-tovdgos.destroy', $payTovdgo)
        );

        $this->assertSoftDeleted($payTovdgo);

        $response->assertNoContent();
    }
}
