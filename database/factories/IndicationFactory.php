<?php

namespace Database\Factories;

use App\Models\Indication;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class IndicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Indication::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'volume' => $this->faker->randomNumber(2),
            'plan' => $this->faker->randomNumber(2),
            'connection_point_id' => \App\Models\ConnectionPoint::factory(),
        ];
    }
}
