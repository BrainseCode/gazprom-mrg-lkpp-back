<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MeasuringComplex;

class MeasuringComplexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MeasuringComplex::factory()
            ->count(5)
            ->create();
    }
}
