<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RequestCallEmployee;

class RequestCallEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RequestCallEmployee::factory()
            ->count(5)
            ->create();
    }
}
