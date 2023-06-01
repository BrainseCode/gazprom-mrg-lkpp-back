<?php

namespace Database\Factories;

use App\Models\Contract;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contract::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => $this->faker->randomNumber(),
            'name' => $this->faker->text(255),
            'reporting_hour' => $this->faker->time(),
            'registration_date' => $this->faker->date(),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'arrears' => $this->faker->randomNumber(0),
            'user_id' => \App\Models\User::factory(),
            'request_approval_unevenness_id' => \App\Models\RequestApprovalUnevenness::factory(),
        ];
    }
}
