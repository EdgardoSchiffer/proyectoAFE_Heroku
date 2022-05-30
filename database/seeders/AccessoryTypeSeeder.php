<?php

namespace Database\Seeders;

use App\Models\Accessory_type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccessoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accesoryTypes = [
            [
                'accessory_type_name' => 'Exterior'
            ],
            [
                'accessory_type_name' => 'Interior'
            ],
            [
                'accessory_type_name' => 'Kit de Emergencias'
            ],
            [
                'accessory_type_name' => 'Otro'
            ],
        ];
        foreach ($accesoryTypes as $accesoryType) {
            Accessory_type::create($accesoryType);
        }
    }
}
