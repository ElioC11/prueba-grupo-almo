<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Shipment;

class ShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Shipment::create([
            'tracking_number' => 'GT123456',
            'status_id' => 2,
            'current_location_id' => 2,
            'employee_name' => 'Juan Perez',
        ]);

        Shipment::create([
            'tracking_number' => 'GT789012',
            'status_id' => 1,
            'current_location_id' => 1,
            'employee_name' => 'Maria Lopez',
        ]);
    }
}
