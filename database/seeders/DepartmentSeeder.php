<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departaments = [
            ['department_name'=>'Ahuachapán'],
            ['department_name'=>'Cabañas'],
            ['department_name'=>'Chalatenango'],
            ['department_name'=>'Cuscatlán'],
            ['department_name'=>'La Libertad'],
            ['department_name'=>'La Paz'],
            ['department_name'=>'La Unión'],
            ['department_name'=>'Morazán'],
            ['department_name'=>'San Miguel'],
            ['department_name'=>'San Salvador'],
            ['department_name'=>'San Vicente'],
            ['department_name'=>'Santa Ana'],
            ['department_name'=>'Sonsonate'],
            ['department_name'=>'Usulután'],
        ];
        foreach ($departaments as $department) {
            Department::create($department);
        }
    }
}
