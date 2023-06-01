<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IndicationQuarter;

class IndicationQuarterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IndicationQuarter::factory()
            ->count(5)
            ->create();
    }
}
