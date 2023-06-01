<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\TransferIndication;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransferIndicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TransferIndication::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'indication' => $this->faker->randomNumber(2),
            'value' => $this->faker->randomNumber(2),
            'measuring_complex_id' => \App\Models\MeasuringComplex::factory(),
        ];
    }
}
