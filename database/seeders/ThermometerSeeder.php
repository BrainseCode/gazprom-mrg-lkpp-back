<?php

namespace Database\Seeders;

use App\Models\Thermometer;
use Illuminate\Database\Seeder;

class ThermometerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Thermometer::factory()
            ->count(5)
            ->create();
    }
}
