<?php

namespace Database\Seeders;

use App\Models\Galery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GalerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $galeries = [
            ['image_name'=>'/upload/vehicles/image.png', 'vehicle_id'=>1],
            ['image_name'=>'/upload/vehicles/image.png', 'vehicle_id'=>1],
            ['image_name'=>'/upload/vehicles/image.png', 'vehicle_id'=>1],
            ['image_name'=>'/upload/vehicles/image.png', 'vehicle_id'=>2],
            ['image_name'=>'/upload/vehicles/image.png', 'vehicle_id'=>3],
            ['image_name'=>'/upload/vehicles/image.png', 'vehicle_id'=>4],
            ['image_name'=>'/upload/vehicles/image.png', 'vehicle_id'=>5],
            ['image_name'=>'/upload/vehicles/image.png', 'vehicle_id'=>6],
            ['image_name'=>'/upload/vehicles/image.png', 'vehicle_id'=>7],
            ['image_name'=>'/upload/vehicles/image.png', 'vehicle_id'=>8],
            ['image_name'=>'/upload/vehicles/image.png', 'vehicle_id'=>9],
            ['image_name'=>'/upload/vehicles/image.png', 'vehicle_id'=>10],
        ];
        foreach ($galeries as $galery) {
            Galery::create($galery);
        }
    }
}
