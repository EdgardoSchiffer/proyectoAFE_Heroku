<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rental_details', function (Blueprint $table) {
            $table->id();
            $table->string("previous_state");
            $table->string("later_state");
            $table->foreignId('rental_id')->reference('id')->on('rentals');
            $table->foreignId('accessory_id')->reference('id')->on('accessories');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rental_details');
    }
};
