<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\IndicationQuarter;

use App\Models\ConnectionPoint;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndicationQuarterTest extends TestCase
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
    public function it_gets_indication_quarters_list(): void
    {
        $indicationQuarters = IndicationQuarter::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.indication-quarters.index'));

        $response->assertOk()->assertSee($indicationQuarters[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_indication_quarter(): void
    {
        $data = IndicationQuarter::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.indication-quarters.store'),
            $data
        );

        $this->assertDatabaseHas('indication_quarters', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_indication_quarter(): void
    {
        $indicationQuarter = IndicationQuarter::factory()->create();

        $connectionPoint = ConnectionPoint::factory()->create();

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
            'connection_point_id' => $connectionPoint->id,
        ];

        $response = $this->putJson(
            route('api.indication-quarters.update', $indicationQuarter),
            $data
        );

        $data['id'] = $indicationQuarter->id;

        $this->assertDatabaseHas('indication_quarters', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_indication_quarter(): void
    {
        $indicationQuarter = IndicationQuarter::factory()->create();

        $response = $this->deleteJson(
            route('api.indication-quarters.destroy', $indicationQuarter)
        );

        $this->assertSoftDeleted($indicationQuarter);

        $response->assertNoContent();
    }
}
