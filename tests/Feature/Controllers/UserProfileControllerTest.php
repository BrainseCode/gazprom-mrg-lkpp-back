<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\UserProfile;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserProfileControllerTest extends TestCase
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
    public function it_displays_index_view_with_user_profiles(): void
    {
        $userProfiles = UserProfile::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('user-profiles.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.user_profiles.index')
            ->assertViewHas('userProfiles');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_user_profile(): void
    {
        $response = $this->get(route('user-profiles.create'));

        $response->assertOk()->assertViewIs('app.user_profiles.create');
    }

    /**
     * @test
     */
    public function it_stores_the_user_profile(): void
    {
        $data = UserProfile::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('user-profiles.store'), $data);

        $this->assertDatabaseHas('user_profiles', $data);

        $userProfile = UserProfile::latest('id')->first();

        $response->assertRedirect(route('user-profiles.edit', $userProfile));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_user_profile(): void
    {
        $userProfile = UserProfile::factory()->create();

        $response = $this->get(route('user-profiles.show', $userProfile));

        $response
            ->assertOk()
            ->assertViewIs('app.user_profiles.show')
            ->assertViewHas('userProfile');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_user_profile(): void
    {
        $userProfile = UserProfile::factory()->create();

        $response = $this->get(route('user-profiles.edit', $userProfile));

        $response
            ->assertOk()
            ->assertViewIs('app.user_profiles.edit')
            ->assertViewHas('userProfile');
    }

    /**
     * @test
     */
    public function it_updates_the_user_profile(): void
    {
        $userProfile = UserProfile::factory()->create();

        $user = User::factory()->create();

        $data = [
            'short_name' => $this->faker->text(255),
            'full_name' => $this->faker->text(255),
            'responsible_person' => $this->faker->text(255),
            'shared_phone' => $this->faker->text(255),
            'responsible_phone' => $this->faker->text(255),
            'legal_address' => $this->faker->text(255),
            'postal_address' => $this->faker->text(255),
            'inn' => $this->faker->text(255),
            'kpp' => $this->faker->text(255),
            'ogrn' => $this->faker->text(255),
            'okpo' => $this->faker->text(255),
            'okfs' => $this->faker->text(255),
            'okato' => $this->faker->text(255),
            'okopf' => $this->faker->text(255),
            'oktmo' => $this->faker->text(255),
            'okved' => $this->faker->text(255),
            'okogu' => $this->faker->text(255),
            'user_id' => $user->id,
        ];

        $response = $this->put(
            route('user-profiles.update', $userProfile),
            $data
        );

        $data['id'] = $userProfile->id;

        $this->assertDatabaseHas('user_profiles', $data);

        $response->assertRedirect(route('user-profiles.edit', $userProfile));
    }

    /**
     * @test
     */
    public function it_deletes_the_user_profile(): void
    {
        $userProfile = UserProfile::factory()->create();

        $response = $this->delete(route('user-profiles.destroy', $userProfile));

        $response->assertRedirect(route('user-profiles.index'));

        $this->assertSoftDeleted($userProfile);
    }
}
