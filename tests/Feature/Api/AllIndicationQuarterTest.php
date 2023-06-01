<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\AllIndicationQuarter;

use App\Models\Contract;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AllIndicationQuarterTest extends TestCase
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
    public function it_gets_all_indication_quarters_list(): void
    {
        $allIndicationQuarters = AllIndicationQuarter::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-indication-quarters.index'));

        $response->assertOk()->assertSee($allIndicationQuarters[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_all_indication_quarter(): void
    {
        $data = AllIndicationQuarter::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.all-indication-quarters.store'),
            $data
        );

        $this->assertDatabaseHas('all_indication_quarters', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_all_indication_quarter(): void
    {
        $allIndicationQuarter = AllIndicationQuarter::factory()->create();

        $contract = Contract::factory()->create();

        $data = [
            'date_year' => $this->faker->year(),
            'year' => $this->faker->randomNumber(2),
            'quarter_1' => $this->faker->randomNumber(2),
            'quarter_2' => $this->faker->randomNumber(2),
            'quarter_3' => $this->faker->randomNumber(2),
            'quarter_4' => $this->faker->randomNumber(2),
            'january' => $this->faker->randomNumber(2),
            'february' => $this->faker->randomNumber(2),
            'march' => $this->faker->randomNumber(2),
            'april' => $this->faker->randomNumber(2),
            'may' => $this->faker->randomNumber(2),
            'june' => $this->faker->randomNumber(2),
            'july' => $this->faker->randomNumber(2),
            'august' => $this->faker->randomNumber(2),
            'september' => $this->faker->randomNumber(2),
            'october' => $this->faker->randomNumber(2),
            'november' => $this->faker->randomNumber(2),
            'december' => $this->faker->randomNumber(2),
            'contract_id' => $contract->id,
        ];

        $response = $this->putJson(
            route('api.all-indication-quarters.update', $allIndicationQuarter),
            $data
        );

        $data['id'] = $allIndicationQuarter->id;

        $this->assertDatabaseHas('all_indication_quarters', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_all_indication_quarter(): void
    {
        $allIndicationQuarter = AllIndicationQuarter::factory()->create();

        $response = $this->deleteJson(
            route('api.all-indication-quarters.destroy', $allIndicationQuarter)
        );

        $this->assertSoftDeleted($allIndicationQuarter);

        $response->assertNoContent();
    }
}
