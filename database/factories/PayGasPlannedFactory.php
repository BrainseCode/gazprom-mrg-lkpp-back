<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\PayGasPlanned;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayGasPlannedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PayGasPlanned::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'Percent' => $this->faker->randomNumber(2),
            'summ' => $this->faker->randomNumber(2),
            'status_pay' => $this->faker->boolean(),
            'contract_id' => \App\Models\Contract::factory(),
        ];
    }
}
