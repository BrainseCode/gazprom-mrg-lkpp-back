<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\GasConsumingEquipment;
use Illuminate\Database\Eloquent\Factories\Factory;

class GasConsumingEquipmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GasConsumingEquipment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'quantity' => $this->faker->randomNumber(),
            'power' => $this->faker->randomNumber(2),
            'consumption' => $this->faker->randomNumber(2),
            'connection_point_id' => \App\Models\ConnectionPoint::factory(),
        ];
    }
}
