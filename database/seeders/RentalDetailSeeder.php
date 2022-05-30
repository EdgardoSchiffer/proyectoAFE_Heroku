<?php

namespace Database\Seeders;

use App\Models\Rental_detail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentalDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // States : (I : intacto), (D : Dañado), (E : Extraviado)
        $rental_details = [
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 1,
                'accessory_id' => 1
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 1,
                'accessory_id' => 2
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 1,
                'accessory_id' => 3
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 1,
                'accessory_id' => 4
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 1,
                'accessory_id' => 5
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 1,
                'accessory_id' => 6
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 1,
                'accessory_id' => 7
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 1,
                'accessory_id' => 8
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 1,
                'accessory_id' => 9
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 1,
                'accessory_id' => 10
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 1,
                'accessory_id' => 11
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 1,
                'accessory_id' => 12
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 1,
                'accessory_id' => 13
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 1,
                'accessory_id' => 14
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 1,
                'accessory_id' => 15
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 1,
                'accessory_id' => 16
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 1,
                'accessory_id' => 17
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 1,
                'accessory_id' => 18
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 1,
                'accessory_id' => 19
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 1,
                'accessory_id' => 20
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 1,
                'accessory_id' => 21
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 1,
                'accessory_id' => 22
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 1,
                'accessory_id' => 23
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 1,
                'accessory_id' => 24
            ],
            [
                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 1,
                'accessory_id' => 25
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 2,
                'accessory_id' => 1
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 2,
                'accessory_id' => 2
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 2,
                'accessory_id' => 3
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 2,
                'accessory_id' => 4
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 2,
                'accessory_id' => 5
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 2,
                'accessory_id' => 6
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 2,
                'accessory_id' => 7
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 2,
                'accessory_id' => 8
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 2,
                'accessory_id' => 9
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 2,
                'accessory_id' => 10
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 2,
                'accessory_id' => 11
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 2,
                'accessory_id' => 12
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 2,
                'accessory_id' => 13
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 2,
                'accessory_id' => 14
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 2,
                'accessory_id' => 15
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 2,
                'accessory_id' => 16
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 2,
                'accessory_id' => 17
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 2,
                'accessory_id' => 18
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 2,
                'accessory_id' => 19
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 2,
                'accessory_id' => 20
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 2,
                'accessory_id' => 21
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 2,
                'accessory_id' => 22
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 2,
                'accessory_id' => 23
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 2,
                'accessory_id' => 24
            ],
            [
                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 2,
                'accessory_id' => 25
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 3,
                'accessory_id' => 1
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 3,
                'accessory_id' => 2
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 3,
                'accessory_id' => 3
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 3,
                'accessory_id' => 4
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 3,
                'accessory_id' => 5
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 3,
                'accessory_id' => 6
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 3,
                'accessory_id' => 7
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 3,
                'accessory_id' => 8
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 3,
                'accessory_id' => 9
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 3,
                'accessory_id' => 10
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 3,
                'accessory_id' => 11
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 3,
                'accessory_id' => 12
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 3,
                'accessory_id' => 13
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 3,
                'accessory_id' => 14
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 3,
                'accessory_id' => 15
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 3,
                'accessory_id' => 16
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 3,
                'accessory_id' => 17
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 3,
                'accessory_id' => 18
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 3,
                'accessory_id' => 19
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 3,
                'accessory_id' => 20
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 3,
                'accessory_id' => 21
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 3,
                'accessory_id' => 22
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 3,
                'accessory_id' => 23
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 3,
                'accessory_id' => 24
            ],
            [
                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 3,
                'accessory_id' => 25
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 4,
                'accessory_id' => 1
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 4,
                'accessory_id' => 2
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 4,
                'accessory_id' => 3
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 4,
                'accessory_id' => 4
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 4,
                'accessory_id' => 5
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 4,
                'accessory_id' => 6
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 4,
                'accessory_id' => 7
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 4,
                'accessory_id' => 8
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 4,
                'accessory_id' => 9
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 4,
                'accessory_id' => 10
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 4,
                'accessory_id' => 11
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 4,
                'accessory_id' => 12
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 4,
                'accessory_id' => 13
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 4,
                'accessory_id' => 14
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 4,
                'accessory_id' => 15
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 4,
                'accessory_id' => 16
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 4,
                'accessory_id' => 17
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 4,
                'accessory_id' => 18
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 4,
                'accessory_id' => 19
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 4,
                'accessory_id' => 20
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 4,
                'accessory_id' => 21
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 4,
                'accessory_id' => 22
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 4,
                'accessory_id' => 23
            ],
            [

                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 4,
                'accessory_id' => 24
            ],
            [
                'previous_state' => 'I',
                'later_state' => 'I',
                'rental_id' => 4,
                'accessory_id' => 25
            ],
        ];
        foreach ($rental_details as $rental_detail) {
            Rental_detail::create($rental_detail);
        }
    }
}
