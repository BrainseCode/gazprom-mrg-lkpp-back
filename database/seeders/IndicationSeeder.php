<?php

namespace Database\Seeders;

use App\Models\Indication;
use Illuminate\Database\Seeder;

class IndicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Indication::factory()
            ->count(5)
            ->create();
    }
}
