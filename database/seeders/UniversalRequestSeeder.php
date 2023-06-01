<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UniversalRequest;

class UniversalRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UniversalRequest::factory()
            ->count(5)
            ->create();
    }
}
