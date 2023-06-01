<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Contract;
use App\Models\CalorieArchive;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractCalorieArchivesTest extends TestCase
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
    public function it_gets_contract_calorie_archives(): void
    {
        $contract = Contract::factory()->create();
        $calorieArchives = CalorieArchive::factory()
            ->count(2)
            ->create([
                'contract_id' => $contract->id,
            ]);

        $response = $this->getJson(
            route('api.contracts.calorie-archives.index', $contract)
        );

        $response->assertOk()->assertSee($calorieArchives[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_contract_calorie_archives(): void
    {
        $contract = Contract::factory()->create();
        $data = CalorieArchive::factory()
            ->make([
                'contract_id' => $contract->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.contracts.calorie-archives.store', $contract),
            $data
        );

        $this->assertDatabaseHas('calorie_archives', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $calorieArchive = CalorieArchive::latest('id')->first();

        $this->assertEquals($contract->id, $calorieArchive->contract_id);
    }
}
