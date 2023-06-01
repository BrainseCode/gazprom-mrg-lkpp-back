<?php

namespace Database\Seeders;

use App\Models\PayTovdgo;
use Illuminate\Database\Seeder;

class PayTovdgoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PayTovdgo::factory()
            ->count(5)
            ->create();
    }
}
