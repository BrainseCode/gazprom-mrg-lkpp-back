<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\AllIndicationQuarter;
use Illuminate\Database\Eloquent\Factories\Factory;

class AllIndicationQuarterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AllIndicationQuarter::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date_year' => $this->faker->year(),
            'year' => $this->faker->randomNumber(2),
            'quarter_1' => $this->faker->randomNumber(2),
            'quarter_2' => $this->faker->randomNumber(2),
            'quarter_3' => $this->faker->randomNumber(2),
            'quarter_4' => $this->faker->randomNumber(2),
            'january' => $this->faker->randomNumber(2),
            'february' => $this->faker->randomNumber(2),
            'march' => $this->faker->randomNumber(2),
            'april' => $this->faker->randomNumber(2),
            'may' => $this->faker->randomNumber(2),
            'june' => $this->faker->randomNumber(2),
            'july' => $this->faker->randomNumber(2),
            'august' => $this->faker->randomNumber(2),
            'september' => $this->faker->randomNumber(2),
            'october' => $this->faker->randomNumber(2),
            'november' => $this->faker->randomNumber(2),
            'december' => $this->faker->randomNumber(2),
            'contract_id' => \App\Models\Contract::factory(),
        ];
    }
}
