<?php

namespace Database\Seeders;

use App\Models\Accessory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccessorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accessories = [
            [
                'accessory_type_id' => 1,
                'accessory_name' => 'Luces altas'
            ],
            [
                'accessory_type_id' => 1,
                'accessory_name' => 'Luces bajas'
            ],
            [
                'accessory_type_id' => 1,
                'accessory_name' => 'Luces antiniebla'
            ],
            [
                'accessory_type_id' => 1,
                'accessory_name' => 'Luz stop'
            ],
            [
                'accessory_type_id' => 1,
                'accessory_name' => 'Antena de radio'
            ],
            [
                'accessory_type_id' => 1,
                'accessory_name' => 'Cricos'
            ],
            [
                'accessory_type_id' => 1,
                'accessory_name' => 'Espejo lateral izquierdo'
            ],
            [
                'accessory_type_id' => 1,
                'accessory_name' => 'Espejo lateral derecho'
            ],
            [
                'accessory_type_id' => 1,
                'accessory_name' => 'Vidrios laterales'
            ],
            [
                'accessory_type_id' => 1,
                'accessory_name' => 'Parabrisas'
            ],
            [
                'accessory_type_id' => 1,
                'accessory_name' => 'Tapones de llantas'
            ],
            [
                'accessory_type_id' => 1,
                'accessory_name' => 'Rines especiales'
            ],
            [
                'accessory_type_id' => 1,
                'accessory_name' => 'Tapon de gasolina'
            ],
            [
                'accessory_type_id' => 1,
                'accessory_name' => 'Carroceria sin golpes'
            ],
            [
                'accessory_type_id' => 1,
                'accessory_name' => 'Parachoque delantero'
            ],
            [
                'accessory_type_id' => 1,
                'accessory_name' => 'Parachoque trasero'
            ],
            [
                'accessory_type_id' => 1,
                'accessory_name' => 'Estribos'
            ],
            [
                'accessory_type_id' => 1,
                'accessory_name' => 'Placas'
            ],
            [
                'accessory_type_id' => 2,
                'accessory_name' => 'A/C'
            ],
            [
                'accessory_type_id' => 2,
                'accessory_name' => 'Pantalla'
            ],
            [
                'accessory_type_id' => 2,
                'accessory_name' => 'Camara de retroceso'
            ],
            [
                'accessory_type_id' => 2,
                'accessory_name' => 'Sensores de retroceso'
            ],
            [
                'accessory_type_id' => 2,
                'accessory_name' => 'Subwoofer'
            ],
            [
                'accessory_type_id' => 2,
                'accessory_name' => 'Radio-CD'
            ],
            [
                'accessory_type_id' => 2,
                'accessory_name' => 'Bocinas'
            ],
            [
                'accessory_type_id' => 2,
                'accessory_name' => 'Encendedor'
            ],
            [
                'accessory_type_id' => 2,
                'accessory_name' => 'Retrovisor'
            ],
            [
                'accessory_type_id' => 2,
                'accessory_name' => 'Cenicero'
            ],
            [
                'accessory_type_id' => 2,
                'accessory_name' => 'Cinturones'
            ],
            [
                'accessory_type_id' => 2,
                'accessory_name' => 'Sube vidrios'
            ],
            [
                'accessory_type_id' => 2,
                'accessory_name' => 'Tapetes'
            ],
            [
                'accessory_type_id' => 2,
                'accessory_name' => 'Funda de asientos'
            ],
            [
                'accessory_type_id' => 2,
                'accessory_name' => 'Sujetador de manos'
            ],
            [
                'accessory_type_id' => 2,
                'accessory_name' => 'Jalador de puertas'
            ],
            [
                'accessory_type_id' => 2,
                'accessory_name' => 'Calefacción de asientos'
            ],
            [
                'accessory_type_id' => 3,
                'accessory_name' => 'Tarjeta de circulación'
            ],
            [
                'accessory_type_id' => 3,
                'accessory_name' => 'Inspección técnica'
            ],
            [
                'accessory_type_id' => 3,
                'accessory_name' => 'Poliza de seguro'
            ],

        ];

        foreach ($accessories as $accessory) {
            Accessory::create($accessory);
        }
    }
}
