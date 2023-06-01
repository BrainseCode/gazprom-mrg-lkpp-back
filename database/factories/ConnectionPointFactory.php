<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ConnectionPoint;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConnectionPointFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ConnectionPoint::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address' => $this->faker->address(),
            'contract_id' => \App\Models\Contract::factory(),
        ];
    }
}
