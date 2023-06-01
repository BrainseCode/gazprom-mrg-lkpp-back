<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\UserProfile;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserProfileTest extends TestCase
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
    public function it_gets_user_profiles_list(): void
    {
        $userProfiles = UserProfile::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.user-profiles.index'));

        $response->assertOk()->assertSee($userProfiles[0]->short_name);
    }

    /**
     * @test
     */
    public function it_stores_the_user_profile(): void
    {
        $data = UserProfile::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.user-profiles.store'), $data);

        $this->assertDatabaseHas('user_profiles', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.user-profiles.update', $userProfile),
            $data
        );

        $data['id'] = $userProfile->id;

        $this->assertDatabaseHas('user_profiles', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_user_profile(): void
    {
        $userProfile = UserProfile::factory()->create();

        $response = $this->deleteJson(
            route('api.user-profiles.destroy', $userProfile)
        );

        $this->assertSoftDeleted($userProfile);

        $response->assertNoContent();
    }
}
