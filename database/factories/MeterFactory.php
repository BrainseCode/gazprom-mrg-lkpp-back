<?php

namespace Database\Factories;

use App\Models\Meter;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Meter::class;

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
            'type' => $this->faker->word(),
            'verification_date' => $this->faker->date(),
            'measuring_complex_id' => \App\Models\MeasuringComplex::factory(),
        ];
    }
}
