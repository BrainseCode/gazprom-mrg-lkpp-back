<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PayGasDelivered;

class PayGasDeliveredSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PayGasDelivered::factory()
            ->count(5)
            ->create();
    }
}
