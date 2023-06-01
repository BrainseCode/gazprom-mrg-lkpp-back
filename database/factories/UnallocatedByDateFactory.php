<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\UnallocatedByDate;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnallocatedByDateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UnallocatedByDate::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'gas_volume' => $this->faker->randomNumber(2),
        ];
    }
}
