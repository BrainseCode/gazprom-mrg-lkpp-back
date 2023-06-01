<?php

namespace Database\Seeders;

use App\Models\PayGasPlanned;
use Illuminate\Database\Seeder;

class PayGasPlannedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PayGasPlanned::factory()
            ->count(5)
            ->create();
    }
}
