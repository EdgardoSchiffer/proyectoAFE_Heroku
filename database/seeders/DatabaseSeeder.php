<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        //$this->call(UserSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(MunicipalitySeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(FuelTypeSeeder::class);
        $this->call(AccessoryTypeSeeder::class);
        $this->call(AccessorySeeder::class);
        $this->call(VehicleTypeSeeder::class);
        $this->call(VehicleSeeder::class);
        $this->call(RentalSeeder::class);
        $this->call(RentalDetailSeeder::class);
        $this->call(VehicleDetailSeeder::class);
        $this->call(RentalUserSeeder::class);
    }
}
