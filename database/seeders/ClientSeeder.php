<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = [
            [
               'client_name' => 'Don Jeff',
                'dui' => '03554781-2',
                'email' => 'don.jeff@gmail.com',
                'address' => 'Residencial La High de Opico',
                'phone' => 74415209,
                'municipality_id' => 10,
                'user_id' => 1
            ],
            [
                'client_name' => 'Juan Perez',
                 'dui' => '02247894-1',
                 'email' => 'juan.perez@gmail.com',
                 'address' => 'Residencial Buena vista',
                 'phone' => 22577777,
                 'municipality_id' => 5,
                 'user_id' => 2
             ],
             [
                'client_name' => 'Bryan Gomez',
                 'dui' => '02235417-4',
                 'email' => 'bryan.gomez@gmail.com',
                 'address' => 'Residencial La vida no vale nada',
                 'phone' => 64410283,
                 'municipality_id' => 12,
                 'user_id' => 1
             ],
             [
                'client_name' => 'Miguel Cervantes',
                 'dui' => '02245170-3',
                 'email' => 'miguel.cervantes@gmail.com',
                 'address' => 'Colonia España',
                 'phone' => 65520137,
                 'municipality_id' => 8,
                 'user_id' => 2
             ],
             [
                'client_name' => 'Sancho Panza',
                 'dui' => '0224789-5',
                 'email' => 'sancho.panza@gmail.com',
                 'address' => 'Canton los gorditos',
                 'phone' => 23354710,
                 'municipality_id' => 3,
                 'user_id' => 1
             ],
             [
                'client_name' => 'Cristiano Ronaldo',
                 'dui' => '011244478-9',
                 'email' => 'the.goat@gmail.com',
                 'address' => 'Altos de madeira',
                 'phone' => 75541038,
                 'municipality_id' => 9,
                 'user_id' => 2

             ],
             [
                'client_name' => 'Elon Musk',
                 'dui' => '03333247-1',
                 'email' => 'elon.musk@gmail.com',
                 'address' => 'Palo Alto',
                 'phone' => 74110090,
                 'municipality_id' => 10,
                 'user_id' => 1
             ],
             [
                'client_name' => 'Nayik Bukele',
                 'dui' => '09999999-1',
                 'email' => 'nayik.dictador@gmail.com',
                 'address' => 'Residencial Las Luces',
                 'phone' => 7550118,
                 'municipality_id' => 3,
                 'user_id' => 2
             ],
             [
                'client_name' => 'Yanira Berrios',
                 'dui' => '07784128-3',
                 'email' => 'mis.corazones.bellos@gmail.com',
                 'address' => 'Urb. Nueva San Salvador',
                 'phone' => 63314701,
                 'municipality_id' => 4,
                 'user_id' => 1
             ],
             [
                'client_name' => 'Lebron James',
                 'dui' => '00147418-5',
                 'email' => 'lebron.james@gmail.com',
                 'address' => 'Calabazas',
                 'phone' => 70021483,
                 'municipality_id' => 6,
                 'user_id' => 2
             ],
        ];
        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}
