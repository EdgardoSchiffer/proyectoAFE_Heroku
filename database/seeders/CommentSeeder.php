<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comments = [
            [
                'vehicle_id' => 1,
                'user_id' => 1,
                'comment'=> "Calidad de vehiculo el mejor en su categoria."
            ],
            [
                'vehicle_id' => 3,
                'user_id' => 2,
                'comment'=> "El carro no llevaba llanta de repuesto y decia que tenia 2"
            ],
            [
                'vehicle_id' => 4,
                'user_id' => 2,
                'comment'=> "El mejor carro que he conducido"
            ],
        ];
        foreach ($comments as $comment) {
            Comment::create($comment);
        }
    }
}
