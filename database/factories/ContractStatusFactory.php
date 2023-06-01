<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ContractStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContractStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
