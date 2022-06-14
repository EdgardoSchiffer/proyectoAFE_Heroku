<?php

namespace Database\Seeders;

use App\Models\Rental_user;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentalUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * example de fechas con dias extra
         */
                //'date' => now()->addDays(5), //dia que se entrega (option) = entregar
                 //'date' => now()->addDays(10), //dia que se recibe de regreso = recibir
                 $rental_users = [
                    [
                        'rental_id' => 1,
                        'user_id' => 1,
                        'option' => 'Entregado',
                        'date' => now()->addDays(5),
                    ],
                    [
                        'rental_id' => 2,
                        'user_id' => 3,
                        'option' => 'Reservado',
                        'date' => now()->addDays(10),
                    ],
                    [
                        'rental_id' => 3,
                        'user_id' => 3,
                        'option' => 'Recibido',
                        'date' => now()->addDays(10),
                    ],
                    [
                        'rental_id' => 4,
                        'user_id' => 4,
                        'option' => 'Entregado',
                        'date' => now()->addDays(5),
                    ],
                    [
                        'rental_id' => 4,
                        'user_id' => 5,
                        'option' => 'Completado',
                        'date' => now()->addDays(15),
                    ],
               ];
               foreach ($rental_users as $rental_user) {
                   Rental_user::create($rental_user);
               }
    }
}
