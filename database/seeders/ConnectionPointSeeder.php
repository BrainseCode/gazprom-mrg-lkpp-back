<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ConnectionPoint;

class ConnectionPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ConnectionPoint::factory()
            ->count(5)
            ->create();
    }
}
