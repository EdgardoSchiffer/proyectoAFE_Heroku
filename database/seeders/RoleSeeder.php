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
                'role_name' => 'Administrator',
                'description' => 'FULL ACCESS',
            ],
            [
                'role_name' => 'Client',
                'description' => 'Role with permission to rent a car',
            ],
            [
                'role_name' => 'Adviser',
                'description' => 'Role with permission to give fr rent a vehicle',
            ],
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
