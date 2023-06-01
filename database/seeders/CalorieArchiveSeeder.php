<?php

namespace Database\Seeders;

use App\Models\CalorieArchive;
use Illuminate\Database\Seeder;

class CalorieArchiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CalorieArchive::factory()
            ->count(5)
            ->create();
    }
}
