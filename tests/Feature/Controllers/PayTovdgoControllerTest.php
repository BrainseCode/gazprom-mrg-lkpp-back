<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\PayTovdgo;

use App\Models\Contract;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PayTovdgoControllerTest extends TestCase
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
    public function it_displays_index_view_with_pay_tovdgos(): void
    {
        $payTovdgos = PayTovdgo::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('pay-tovdgos.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.pay_tovdgos.index')
            ->assertViewHas('payTovdgos');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_pay_tovdgo(): void
    {
        $response = $this->get(route('pay-tovdgos.create'));

        $response->assertOk()->assertViewIs('app.pay_tovdgos.create');
    }

    /**
     * @test
     */
    public function it_stores_the_pay_tovdgo(): void
    {
        $data = PayTovdgo::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('pay-tovdgos.store'), $data);

        $this->assertDatabaseHas('pay_tovdgos', $data);

        $payTovdgo = PayTovdgo::latest('id')->first();

        $response->assertRedirect(route('pay-tovdgos.edit', $payTovdgo));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_pay_tovdgo(): void
    {
        $payTovdgo = PayTovdgo::factory()->create();

        $response = $this->get(route('pay-tovdgos.show', $payTovdgo));

        $response
            ->assertOk()
            ->assertViewIs('app.pay_tovdgos.show')
            ->assertViewHas('payTovdgo');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_pay_tovdgo(): void
    {
        $payTovdgo = PayTovdgo::factory()->create();

        $response = $this->get(route('pay-tovdgos.edit', $payTovdgo));

        $response
            ->assertOk()
            ->assertViewIs('app.pay_tovdgos.edit')
            ->assertViewHas('payTovdgo');
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

        $response = $this->put(route('pay-tovdgos.update', $payTovdgo), $data);

        $data['id'] = $payTovdgo->id;

        $this->assertDatabaseHas('pay_tovdgos', $data);

        $response->assertRedirect(route('pay-tovdgos.edit', $payTovdgo));
    }

    /**
     * @test
     */
    public function it_deletes_the_pay_tovdgo(): void
    {
        $payTovdgo = PayTovdgo::factory()->create();

        $response = $this->delete(route('pay-tovdgos.destroy', $payTovdgo));

        $response->assertRedirect(route('pay-tovdgos.index'));

        $this->assertSoftDeleted($payTovdgo);
    }
}
