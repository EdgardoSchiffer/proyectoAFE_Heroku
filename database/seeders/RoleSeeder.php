<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'Administrator',
                'guard_name' => 'web',
                'description' => 'FULL ACCESS',
            ],
            [
                'name' => 'Client',
                'guard_name' => 'web',
                'description' => 'Role with permission to rent a car',
            ],
            [
                'name' => 'Adviser',
                'guard_name' => 'web',
                'description' => 'Role with permission to give fr rent a vehicle',
            ],
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
