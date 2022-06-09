<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'name' => 'El mero Don Jeff',
                'last_name' => 'Pineda',
                'username' => 'maestro.pineda',
                'email' => 'maestro.pineda@gmail.com',
                'password' => bcrypt('@dmin123'),
                'role_id' => 1
            ],
            [
                'name' => 'Don Nico',
                'last_name' => 'Escobar',
                'username' => 'nico.escobar',
                'email' => 'nico.escobar@gmail.com',
                'password' => bcrypt('@dmin123'),
                'role_id' => 1
            ],
        ];
        $clients = [
            [
                'name' => 'Guillermo',
                'last_name' => 'Hernandez',
                'username' => 'guillermo.hernandez',
                'email' => 'guillermo.hernandez@gmail.com',
                'password' => bcrypt('cli3nt123'),
                'role_id' => 2
            ],
        ];
        $advisers = [
            [
                'name' => 'Bryan',
                'last_name' => 'Gomez',
                'username' => 'bryan.gomez',
                'email' => 'bryan.gomez@gmail.com',
                'password' => bcrypt('g@to123'),
                'role_id' => 3
            ],
            [
                'name' => 'Edgardo',
                'last_name' => 'Argueta',
                'username' => 'edgardo.argueta',
                'email' => 'edgardo.argueta@gmail.com',
                'password' => bcrypt('@dviser123'),
                'role_id' => 3
            ],
        ];
        foreach ($admins as $user) {
            $user = User::create($user);
            $user->assignRole('Administrator');
        }
        foreach ($clients as $user) {
            $user = User::create($user);
            $user->assignRole('Client');
        }
        foreach ($advisers as $user) {
            $user = User::create($user);
            $user->assignRole('Adviser');
        }
    }
}
