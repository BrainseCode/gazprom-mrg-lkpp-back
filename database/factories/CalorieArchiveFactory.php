<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\CalorieArchive;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalorieArchiveFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CalorieArchive::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'caloric' => $this->faker->randomNumber(2),
            'quality_passport' => $this->faker->text(255),
            'contract_id' => \App\Models\Contract::factory(),
        ];
    }
}
