<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\CalorieArchive;

use App\Models\Contract;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CalorieArchiveTest extends TestCase
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
    public function it_gets_calorie_archives_list(): void
    {
        $calorieArchives = CalorieArchive::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.calorie-archives.index'));

        $response->assertOk()->assertSee($calorieArchives[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_calorie_archive(): void
    {
        $data = CalorieArchive::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.calorie-archives.store'), $data);

        $this->assertDatabaseHas('calorie_archives', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_calorie_archive(): void
    {
        $calorieArchive = CalorieArchive::factory()->create();

        $contract = Contract::factory()->create();

        $data = [
            'date' => $this->faker->date(),
            'caloric' => $this->faker->randomNumber(2),
            'quality_passport' => $this->faker->text(255),
            'contract_id' => $contract->id,
        ];

        $response = $this->putJson(
            route('api.calorie-archives.update', $calorieArchive),
            $data
        );

        $data['id'] = $calorieArchive->id;

        $this->assertDatabaseHas('calorie_archives', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_calorie_archive(): void
    {
        $calorieArchive = CalorieArchive::factory()->create();

        $response = $this->deleteJson(
            route('api.calorie-archives.destroy', $calorieArchive)
        );

        $this->assertSoftDeleted($calorieArchive);

        $response->assertNoContent();
    }
}
