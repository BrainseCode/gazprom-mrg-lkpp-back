<?php

namespace Database\Factories;

use App\Models\Thermometer;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThermometerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Thermometer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'number' => $this->faker->randomNumber(),
            'verification_date' => $this->faker->date(),
            'measuring_complex_id' => \App\Models\MeasuringComplex::factory(),
        ];
    }
}
