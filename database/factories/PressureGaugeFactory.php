<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\PressureGauge;
use Illuminate\Database\Eloquent\Factories\Factory;

class PressureGaugeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PressureGauge::class;

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
