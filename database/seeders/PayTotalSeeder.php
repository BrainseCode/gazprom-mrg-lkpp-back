<?php

namespace Database\Seeders;

use App\Models\PayTotal;
use Illuminate\Database\Seeder;

class PayTotalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PayTotal::factory()
            ->count(5)
            ->create();
    }
}
