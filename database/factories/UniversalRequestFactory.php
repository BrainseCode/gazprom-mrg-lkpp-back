<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\UniversalRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class UniversalRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UniversalRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'message' => $this->faker->sentence(20),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
