<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicles = [
            [
                'vehicle_type_id'=> 1,
                'vehicle_name'=> 'Veloster Turbo',
                'color'=> 'Black',
                'year'=> 2013,
                'doors_number'=> 4,
                'fuel_type_id'=> 2,
                'rental_price'=> 450,
                'status'=> 1,
                'registry_number'=> 'P87410014',
                'brand_id'=> 3,
            ],
            [
                'vehicle_type_id'=> 7,
                'vehicle_name'=> '720S',
                'color'=> 'Gray',
                'year'=> 2022,
                'doors_number'=> 2,
                'fuel_type_id'=> 2,
                'rental_price'=> 700,
                'status'=> 1,
                'registry_number'=> 'P22471009',
                'brand_id'=> 4,
            ],
            [
                'vehicle_type_id'=> 7,
                'vehicle_name'=> '720S',
                'color'=> 'Gray',
                'year'=> 2022,
                'doors_number'=> 2,
                'fuel_type_id'=> 2,
                'rental_price'=> 1000,
                'status'=> 1,
                'registry_number'=> 'P22471009',
                'brand_id'=> 4,
            ],
            [
                'vehicle_type_id'=> 2,
                'vehicle_name'=> 'CX-5',
                'color'=> 'White',
                'year'=> 2022,
                'doors_number'=> 5,
                'fuel_type_id'=> 2,
                'rental_price'=> 550,
                'status'=> 1,
                'registry_number'=> 'P554101047',
                'brand_id'=> 6,
            ],
            [
                'vehicle_type_id'=> 7,
                'vehicle_name'=> '720S',
                'color'=> 'Gray',
                'year'=> 2022,
                'doors_number'=> 2,
                'fuel_type_id'=> 2,
                'rental_price'=> 700,
                'status'=> 1,
                'registry_number'=> 'P22471009',
                'brand_id'=> 4,
            ],
            [
                'vehicle_type_id'=> 6,
                'vehicle_name'=> 'GR86',
                'color'=> 'Red',
                'year'=> 2022,
                'doors_number'=> 2,
                'fuel_type_id'=> 2,
                'rental_price'=> 800,
                'status'=> 1,
                'registry_number'=> 'P00214763',
                'brand_id'=> 1,
            ],
            [
                'vehicle_type_id'=> 4,
                'vehicle_name'=> 'Silverado ZR2',
                'color'=> 'Blue sky',
                'year'=> 2022,
                'doors_number'=> 4,
                'fuel_type_id'=> 3,
                'rental_price'=> 745,
                'status'=> 1,
                'registry_number'=> 'P344178509',
                'brand_id'=> 5,
            ],
            [
                'vehicle_type_id'=> 9,
                'vehicle_name'=> 'Sienna',
                'color'=> 'Pink',
                'year'=> 2022,
                'doors_number'=> 5,
                'fuel_type_id'=> 3,
                'rental_price'=> 380,
                'status'=> 1,
                'registry_number'=> 'P665741017',
                'brand_id'=> 1,
            ],
            [
                'vehicle_type_id'=> 10,
                'vehicle_name'=> 'Colorado',
                'color'=> 'Dark Green',
                'year'=> 2022,
                'doors_number'=> 4,
                'fuel_type_id'=> 2,
                'rental_price'=> 675,
                'status'=> 1,
                'registry_number'=> 'P877410254',
                'brand_id'=> 5,
            ],
            [
                'vehicle_type_id'=> 1,
                'vehicle_name'=> 'Mazda 3',
                'color'=> 'White',
                'year'=> 2022,
                'doors_number'=> 5,
                'fuel_type_id'=> 2,
                'rental_price'=> 490,
                'status'=> 1,
                'registry_number'=> 'P855401885',
                'brand_id'=> 6,
            ],
        ];
        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }
    }
}
