<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AllIndicationQuarter;

class AllIndicationQuarterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AllIndicationQuarter::factory()
            ->count(5)
            ->create();
    }
}
