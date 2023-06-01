<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\MeasuringComplex;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeasuringComplexFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MeasuringComplex::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => $this->faker->randomNumber(),
            'connection_point_id' => \App\Models\ConnectionPoint::factory(),
        ];
    }
}
