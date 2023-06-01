<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RequestApprovalUnevenness;

class RequestApprovalUnevennessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RequestApprovalUnevenness::factory()
            ->count(5)
            ->create();
    }
}
