<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\CalorieArchive;

use App\Models\Contract;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CalorieArchiveControllerTest extends TestCase
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
    public function it_displays_index_view_with_calorie_archives(): void
    {
        $calorieArchives = CalorieArchive::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('calorie-archives.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.calorie_archives.index')
            ->assertViewHas('calorieArchives');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_calorie_archive(): void
    {
        $response = $this->get(route('calorie-archives.create'));

        $response->assertOk()->assertViewIs('app.calorie_archives.create');
    }

    /**
     * @test
     */
    public function it_stores_the_calorie_archive(): void
    {
        $data = CalorieArchive::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('calorie-archives.store'), $data);

        $this->assertDatabaseHas('calorie_archives', $data);

        $calorieArchive = CalorieArchive::latest('id')->first();

        $response->assertRedirect(
            route('calorie-archives.edit', $calorieArchive)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_calorie_archive(): void
    {
        $calorieArchive = CalorieArchive::factory()->create();

        $response = $this->get(route('calorie-archives.show', $calorieArchive));

        $response
            ->assertOk()
            ->assertViewIs('app.calorie_archives.show')
            ->assertViewHas('calorieArchive');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_calorie_archive(): void
    {
        $calorieArchive = CalorieArchive::factory()->create();

        $response = $this->get(route('calorie-archives.edit', $calorieArchive));

        $response
            ->assertOk()
            ->assertViewIs('app.calorie_archives.edit')
            ->assertViewHas('calorieArchive');
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

        $response = $this->put(
            route('calorie-archives.update', $calorieArchive),
            $data
        );

        $data['id'] = $calorieArchive->id;

        $this->assertDatabaseHas('calorie_archives', $data);

        $response->assertRedirect(
            route('calorie-archives.edit', $calorieArchive)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_calorie_archive(): void
    {
        $calorieArchive = CalorieArchive::factory()->create();

        $response = $this->delete(
            route('calorie-archives.destroy', $calorieArchive)
        );

        $response->assertRedirect(route('calorie-archives.index'));

        $this->assertSoftDeleted($calorieArchive);
    }
}
