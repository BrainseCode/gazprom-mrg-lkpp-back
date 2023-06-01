<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NotificationStatus;

class NotificationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NotificationStatus::factory()
            ->count(5)
            ->create();
    }
}
