<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Location::create([
            'name' => 'Bodega Central Mixco',
            'city' => 'Guatemala',
            'address' => 'Zona 4 Mixco'
        ]);

        Location::create([
            'name' => 'Hub Quetzaltenango',
            'city' => 'Quetzaltenango',
            'address' => 'Zona 3 Xela'
        ]);

        Location::create([
            'name' => 'Centro Distribucion Capital',
            'city' => 'Guatemala',
            'address' => 'Zona 12'
        ]);
    }
}
