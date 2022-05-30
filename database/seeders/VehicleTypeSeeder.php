<?php

namespace Database\Seeders;

use App\Models\Vehicle_type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicles_type = [
            ['vehicle_type_name'=>'Sedan'],
            ['vehicle_type_name'=>'SUV'],
            ['vehicle_type_name'=>'Hatchback'],
            ['vehicle_type_name'=>'Pickup'],
            ['vehicle_type_name'=>'Van'],
            ['vehicle_type_name'=>'Coupe'],
            ['vehicle_type_name'=>'Supercar'],
            ['vehicle_type_name'=>'Minitruck'],
            ['vehicle_type_name'=>'Minivan'],
            ['vehicle_type_name'=>'Truck'],
        ];
        foreach ($vehicles_type as $vehicle_type) {
            Vehicle_type::create($vehicle_type);
        }
    }
}
