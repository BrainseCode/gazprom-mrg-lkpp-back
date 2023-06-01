<?php

namespace Database\Factories;

use App\Models\PayTotal;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayTotalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PayTotal::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pay_delivered' => $this->faker->randomNumber(2),
            'pay_planned' => $this->faker->randomNumber(2),
            'pay_tovdgo' => $this->faker->randomNumber(2),
            'total' => $this->faker->randomNumber(2),
            'total_nds' => $this->faker->randomNumber(2),
            'contract_id' => \App\Models\Contract::factory(),
        ];
    }
}
