<?php

namespace Database\Factories;

use App\Models\PayTovdgo;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayTovdgoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PayTovdgo::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'summ' => $this->faker->randomNumber(2),
            'status_pay' => $this->faker->boolean(),
            'contract_id' => \App\Models\Contract::factory(),
        ];
    }
}
