<?php

namespace Database\Seeders;

use App\Models\Municipality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $municipalities = [
            [
                'department_id' => 1,
                'municipality_name' => 'Ahuachapán',
            ],
            [
                'department_id' => 2,
                'municipality_name' => 'Sensuntepeque',
            ],
            [
                'department_id' => 3,
                'municipality_name' => 'Chalatenango',
            ],
            [
                'department_id' => 4,
                'municipality_name' => 'Cojutepeque',
            ],
            [
                'department_id' => 5,
                'municipality_name' => 'Santa Tecla',
            ],
            [
                'department_id' => 6,
                'municipality_name' => 'Zacatecoluca',
            ],
            [
                'department_id' => 7,
                'municipality_name' => 'La Unión',
            ],
            [
                'department_id' => 8,
                'municipality_name' => 'San Francisco Gotera',
            ],
            [
                'department_id' => 9,
                'municipality_name' => 'San Miguel',
            ],
            [
                'department_id' => 10,
                'municipality_name' => 'San Salvador',
            ],
            [
                'department_id' => 11,
                'municipality_name' => 'San Vicente',
            ],
            [
                'department_id' => 12,
                'municipality_name' => 'Santa Ana',
            ],
            [
                'department_id' => 13,
                'municipality_name' => 'Sonsonate',
            ],
            [
                'department_id' => 14,
                'municipality_name' => 'Usulután',
            ],
        ];
        foreach ($municipalities as $municiaplity) {
            Municipality::create($municiaplity);
        }
    }
}
