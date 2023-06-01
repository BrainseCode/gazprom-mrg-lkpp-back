<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IndicationStatus;

class IndicationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IndicationStatus::factory()
            ->count(5)
            ->create();
    }
}
