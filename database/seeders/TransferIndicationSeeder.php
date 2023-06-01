<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransferIndication;

class TransferIndicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransferIndication::factory()
            ->count(5)
            ->create();
    }
}
