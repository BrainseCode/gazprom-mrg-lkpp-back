<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\RequestApprovalUnevenness;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestApprovalUnevennessFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RequestApprovalUnevenness::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'gas_volume' => $this->faker->randomNumber(2),
            'gas_volume_unallocated' => $this->faker->randomNumber(2),
            'total' => $this->faker->randomNumber(2),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
