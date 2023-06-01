<?php

namespace Database\Seeders;

use App\Models\PowerUnit;
use Illuminate\Database\Seeder;

class PowerUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PowerUnit::factory()
            ->count(5)
            ->create();
    }
}
