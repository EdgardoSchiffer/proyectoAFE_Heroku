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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_type_id')->reference('id')->on('vehicle_types');
            $table->string("vehicle_name");
            $table->string("color");
            $table->integer("year");
            $table->integer("doors_number");
            $table->foreignId('fuel_type_id')->reference('id')->on('fuel_types');
            $table->float('rental_price');
            $table->integer("status");
            $table->string("registry_number");
            $table->foreignId('brand_id')->reference('id')->on('brands');
            $table->integer("stock");
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
        Schema::dropIfExists('vehicles');
    }
};
