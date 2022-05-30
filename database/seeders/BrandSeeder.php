<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            ['brand_name'=>'Toyota'],
            ['brand_name'=>'Honda'],
            ['brand_name'=>'Hyundai'],
            ['brand_name'=>'Mc Laren'],
            ['brand_name'=>'Chevrolet'],
            ['brand_name'=>'Mazda'],
            ['brand_name'=>'BMW'],
            ['brand_name'=>'Mercedes Benz'],
            ['brand_name'=>'Audi'],
            ['brand_name'=>'Lexus'],
            ['brand_name'=>'Renault'],
            ['brand_name'=>'Ford'],
            ['brand_name'=>'Opel'],
            ['brand_name'=>'Seat'],
            ['brand_name'=>'Tesla'],
            ['brand_name'=>'Rolls Royce'],
            ['brand_name'=>'Kia'],
            ['brand_name'=>'Land Rover'],
            ['brand_name'=>'Jeep'],
            ['brand_name'=>'Jaguar'],
            ['brand_name'=>'Mitsubishi'],
            ['brand_name'=>'Peugeot'],
            ['brand_name'=>'Suzuki'],
            ['brand_name'=>'Subaru'],
            ['brand_name'=>'Volvo'],
            ['brand_name'=>'Volkswagen'],
            ['brand_name'=>'Porshe'],
            ['brand_name'=>'Nissan'],
            ['brand_name'=>'Cadillac'],
            ['brand_name'=>'Ferrari'],
            ['brand_name'=>'Lamborghini'],
            ['brand_name'=>'Piaggio'],
            ['brand_name'=>'Maserati'],
            ['brand_name'=>'Aston Martin'],
            ['brand_name'=>'Alfa Romeo'],
        ];
        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
