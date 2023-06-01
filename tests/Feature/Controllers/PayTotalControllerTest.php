<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\PayTotal;

use App\Models\Contract;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PayTotalControllerTest extends TestCase
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
    public function it_displays_index_view_with_pay_totals(): void
    {
        $payTotals = PayTotal::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('pay-totals.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.pay_totals.index')
            ->assertViewHas('payTotals');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_pay_total(): void
    {
        $response = $this->get(route('pay-totals.create'));

        $response->assertOk()->assertViewIs('app.pay_totals.create');
    }

    /**
     * @test
     */
    public function it_stores_the_pay_total(): void
    {
        $data = PayTotal::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('pay-totals.store'), $data);

        $this->assertDatabaseHas('pay_totals', $data);

        $payTotal = PayTotal::latest('id')->first();

        $response->assertRedirect(route('pay-totals.edit', $payTotal));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_pay_total(): void
    {
        $payTotal = PayTotal::factory()->create();

        $response = $this->get(route('pay-totals.show', $payTotal));

        $response
            ->assertOk()
            ->assertViewIs('app.pay_totals.show')
            ->assertViewHas('payTotal');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_pay_total(): void
    {
        $payTotal = PayTotal::factory()->create();

        $response = $this->get(route('pay-totals.edit', $payTotal));

        $response
            ->assertOk()
            ->assertViewIs('app.pay_totals.edit')
            ->assertViewHas('payTotal');
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

        $response = $this->put(route('pay-totals.update', $payTotal), $data);

        $data['id'] = $payTotal->id;

        $this->assertDatabaseHas('pay_totals', $data);

        $response->assertRedirect(route('pay-totals.edit', $payTotal));
    }

    /**
     * @test
     */
    public function it_deletes_the_pay_total(): void
    {
        $payTotal = PayTotal::factory()->create();

        $response = $this->delete(route('pay-totals.destroy', $payTotal));

        $response->assertRedirect(route('pay-totals.index'));

        $this->assertSoftDeleted($payTotal);
    }
}
