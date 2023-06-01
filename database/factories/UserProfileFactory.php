<?php

namespace Database\Factories;

use App\Models\UserProfile;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserProfile::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
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
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
