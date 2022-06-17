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
            ['image_name'=>'/upload/vehicles/1655493657.jpeg', 'vehicle_id'=>1],
            ['image_name'=>'/upload/vehicles/1655493658.jpeg', 'vehicle_id'=>1],
            ['image_name'=>'/upload/vehicles/1655493660.jpeg', 'vehicle_id'=>1],
            ['image_name'=>'/upload/vehicles/1655493661.jpeg', 'vehicle_id'=>1],
            ['image_name'=>'/upload/vehicles/1655493662.jpeg', 'vehicle_id'=>1],
            ['image_name'=>'/upload/vehicles/1655493698.jpeg', 'vehicle_id'=>2],
            ['image_name'=>'/upload/vehicles/1655493699.jpeg', 'vehicle_id'=>2],
            ['image_name'=>'/upload/vehicles/1655493700.jpeg', 'vehicle_id'=>2],
            ['image_name'=>'/upload/vehicles/1655493701.jpeg', 'vehicle_id'=>2],
            ['image_name'=>'/upload/vehicles/1655493702.jpeg', 'vehicle_id'=>2],
            ['image_name'=>'/upload/vehicles/1655493703.jpeg', 'vehicle_id'=>2],
            ['image_name'=>'/upload/vehicles/1655493731.jpeg', 'vehicle_id'=>3],
            ['image_name'=>'/upload/vehicles/1655493732.jpeg', 'vehicle_id'=>3],
            ['image_name'=>'/upload/vehicles/1655493733.jpeg', 'vehicle_id'=>3],
            ['image_name'=>'/upload/vehicles/1655493734.jpeg', 'vehicle_id'=>3],
            ['image_name'=>'/upload/vehicles/1655493735.jpeg', 'vehicle_id'=>3],
            ['image_name'=>'/upload/vehicles/1655493736.jpeg', 'vehicle_id'=>3],
            ['image_name'=>'/upload/vehicles/1655493766.jpeg', 'vehicle_id'=>4],
            ['image_name'=>'/upload/vehicles/1655493767.jpeg', 'vehicle_id'=>4],
            ['image_name'=>'/upload/vehicles/1655493768.jpeg', 'vehicle_id'=>4],
            ['image_name'=>'/upload/vehicles/1655493769.jpeg', 'vehicle_id'=>4],
            ['image_name'=>'/upload/vehicles/1655493770.jpeg', 'vehicle_id'=>4],
            ['image_name'=>'/upload/vehicles/1655493771.jpeg', 'vehicle_id'=>4],
            ['image_name'=>'/upload/vehicles/1655493829.jpeg', 'vehicle_id'=>6],
            ['image_name'=>'/upload/vehicles/1655493830.jpeg', 'vehicle_id'=>6],
            ['image_name'=>'/upload/vehicles/1655493831.jpeg', 'vehicle_id'=>6],
            ['image_name'=>'/upload/vehicles/1655493847.jpeg', 'vehicle_id'=>5],
            ['image_name'=>'/upload/vehicles/1655493848.jpeg', 'vehicle_id'=>5],
            ['image_name'=>'/upload/vehicles/1655493849.jpeg', 'vehicle_id'=>5],
            ['image_name'=>'/upload/vehicles/1655493850.jpeg', 'vehicle_id'=>5],
            ['image_name'=>'/upload/vehicles/1655493851.jpeg', 'vehicle_id'=>5],
            ['image_name'=>'/upload/vehicles/1655493852.jpeg', 'vehicle_id'=>5],
            ['image_name'=>'/upload/vehicles/1655493976.jpeg', 'vehicle_id'=>9],
            ['image_name'=>'/upload/vehicles/1655493978.jpeg', 'vehicle_id'=>9],
            ['image_name'=>'/upload/vehicles/1655493979.jpeg', 'vehicle_id'=>9],
            ['image_name'=>'/upload/vehicles/image.png', 'vehicle_id'=>10],
            ['image_name'=>'/upload/vehicles/image.png', 'vehicle_id'=>7],
            ['image_name'=>'/upload/vehicles/image.png', 'vehicle_id'=>8],
        ];
        foreach ($galeries as $galery) {
            Galery::create($galery);
        }
    }
}
