<?php

namespace Database\Seeders;

use App\Models\PressureGauge;
use Illuminate\Database\Seeder;

class PressureGaugeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PressureGauge::factory()
            ->count(5)
            ->create();
    }
}
