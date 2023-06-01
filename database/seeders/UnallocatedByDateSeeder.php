<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UnallocatedByDate;

class UnallocatedByDateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UnallocatedByDate::factory()
            ->count(5)
            ->create();
    }
}
