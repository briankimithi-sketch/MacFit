<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipments = [
            [
                'name' => 'Treadmill Pro-X',
                'usage' => 'Cardio',
                'model_number' => 'TM-1000',
                'value' => 1500.00,
                'status' => 'Available'
            ],
            [
                'name' => 'Smith Machine',
                'usage' => 'Strength',
                'model_number' => 'SM-500',
                'value' => 2200.00,
                'status' => 'Available'
            ],
            [
                'name' => 'Stationary Bike',
                'usage' => 'Cardio',
                'model_number' => 'BK-200',
                'value' => 800.00,
                'status' => 'Under Maintenance'
            ],
        ];
    }
}
