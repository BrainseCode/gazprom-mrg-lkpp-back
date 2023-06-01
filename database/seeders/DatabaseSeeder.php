<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        $this->call(AllIndicationQuarterSeeder::class);
        $this->call(CalculatorSeeder::class);
        $this->call(CalorieArchiveSeeder::class);
        $this->call(ConnectionPointSeeder::class);
        $this->call(ContractSeeder::class);
        $this->call(ContractStatusSeeder::class);
        $this->call(ContractTypeSeeder::class);
        $this->call(GasConsumingEquipmentSeeder::class);
        $this->call(IndicationSeeder::class);
        $this->call(IndicationQuarterSeeder::class);
        $this->call(IndicationSourceSeeder::class);
        $this->call(IndicationStatusSeeder::class);
        $this->call(MeasuringComplexSeeder::class);
        $this->call(MeterSeeder::class);
        $this->call(NotificationSeeder::class);
        $this->call(NotificationStatusSeeder::class);
        $this->call(PayGasDeliveredSeeder::class);
        $this->call(PayGasPlannedSeeder::class);
        $this->call(PayTotalSeeder::class);
        $this->call(PayTovdgoSeeder::class);
        $this->call(PowerUnitSeeder::class);
        $this->call(PressureGaugeSeeder::class);
        $this->call(RequestApprovalUnevennessSeeder::class);
        $this->call(RequestCallEmployeeSeeder::class);
        $this->call(ThermometerSeeder::class);
        $this->call(TransferIndicationSeeder::class);
        $this->call(UnallocatedByDateSeeder::class);
        $this->call(UniversalRequestSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UserProfileSeeder::class);
    }
}
