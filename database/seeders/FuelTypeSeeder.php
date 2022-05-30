<?php

namespace Database\Seeders;

use App\Models\Fuel_type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fuel_types = [
            ['fuel_type_name'=>'Gasolina Regular',
            'description'=>'Gasolina con menor obtanaje, se utiliza principalmente como combustible en la mayoría de motores de combustión.'],
            ['fuel_type_name'=>'Gasolina Especial',
            'description'=>'Gasolina con mayor obtanaje.'],
            ['fuel_type_name'=>'Diesel',
            'description'=>'combustible líquido diseñado específicamente para su uso en un motor diesel.'],
        ];
        foreach ($fuel_types as $fuel_type) {
            Fuel_type::create($fuel_type);
        }
    }
}
