<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Indication;

use App\Models\ConnectionPoint;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndicationControllerTest extends TestCase
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
    public function it_displays_index_view_with_indications(): void
    {
        $indications = Indication::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('indications.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.indications.index')
            ->assertViewHas('indications');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_indication(): void
    {
        $response = $this->get(route('indications.create'));

        $response->assertOk()->assertViewIs('app.indications.create');
    }

    /**
     * @test
     */
    public function it_stores_the_indication(): void
    {
        $data = Indication::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('indications.store'), $data);

        $this->assertDatabaseHas('indications', $data);

        $indication = Indication::latest('id')->first();

        $response->assertRedirect(route('indications.edit', $indication));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_indication(): void
    {
        $indication = Indication::factory()->create();

        $response = $this->get(route('indications.show', $indication));

        $response
            ->assertOk()
            ->assertViewIs('app.indications.show')
            ->assertViewHas('indication');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_indication(): void
    {
        $indication = Indication::factory()->create();

        $response = $this->get(route('indications.edit', $indication));

        $response
            ->assertOk()
            ->assertViewIs('app.indications.edit')
            ->assertViewHas('indication');
    }

    /**
     * @test
     */
    public function it_updates_the_indication(): void
    {
        $indication = Indication::factory()->create();

        $connectionPoint = ConnectionPoint::factory()->create();

        $data = [
            'date' => $this->faker->date(),
            'volume' => $this->faker->randomNumber(2),
            'plan' => $this->faker->randomNumber(2),
            'connection_point_id' => $connectionPoint->id,
        ];

        $response = $this->put(route('indications.update', $indication), $data);

        $data['id'] = $indication->id;

        $this->assertDatabaseHas('indications', $data);

        $response->assertRedirect(route('indications.edit', $indication));
    }

    /**
     * @test
     */
    public function it_deletes_the_indication(): void
    {
        $indication = Indication::factory()->create();

        $response = $this->delete(route('indications.destroy', $indication));

        $response->assertRedirect(route('indications.index'));

        $this->assertSoftDeleted($indication);
    }
}
