<?php

namespace Database\Seeders;

use App\Models\Rental;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rentals = [
             [
                 'rental_date' => now(),
                 'vehicle_id' => 1,
                 'client_id' => 1,
                 'advance' => 0.0,
                 'late_delivery_charge' => 50,
                 'comment'=> 'Vehiculo en excelentes condiciones, todos las prestaciones funcionando al 100%',
                 'damage_charge'=> 200,
                 'rental_time'=> 10,
                 
             ],
             [
                'rental_date' => now(),
                'vehicle_id' => 2,
                'client_id' => 2,
                'advance' => 0.0,
                'late_delivery_charge' => 50,
                'comment'=> 'Vehiculo en excelentes condiciones, no posee aire acondicionado',
                'damage_charge'=> 200,
                'rental_time'=> 10,
                
            ],
            [
                'rental_date' => now(),
                'vehicle_id' => 3,
                'client_id' => 3,
                'advance' => 0.0,
                'late_delivery_charge' => 50,
                'comment'=> 'Vehiculo en excelentes condiciones, no posee aire acondicionado',
                'damage_charge'=> 200,
                'rental_time'=> 10,
                
            ],
            [
                'rental_date' => now(),
                'vehicle_id' => 4,
                'client_id' => 4,
                'advance' => 0.0,
                'late_delivery_charge' => 50,
                'comment'=> 'Vehiculo en excelentes condiciones, no posee aire acondicionado',
                'damage_charge'=> 200,
                'rental_time'=> 10,
                
            ],
        ];
        foreach ($rentals as $rental) {
            Rental::create($rental);
        }
    }
}
