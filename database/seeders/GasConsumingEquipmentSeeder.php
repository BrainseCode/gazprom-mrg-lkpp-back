<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GasConsumingEquipment;

class GasConsumingEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GasConsumingEquipment::factory()
            ->count(5)
            ->create();
    }
}
