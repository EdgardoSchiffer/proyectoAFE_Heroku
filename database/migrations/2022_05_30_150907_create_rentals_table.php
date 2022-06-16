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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->timestamp('rental_date'); //fecha que se realiza el alquiler
            $table->foreignId('vehicle_id')->reference('id')->on('vehicles')->nullable()->constrained(); 
            $table->foreignId('client_id')->reference('id')->on('clients')->nullable()->constrained(); //usuario que hace la reserva
            $table->float('advance'); 
            $table->float('late_delivery_charge');//retorno del vehiculo por parte del cliente
            $table->string('comment');
            $table->float('damage_charge');
            $table->integer('rental_time'); //numero de dias que se renta el vehiculo partiendo de la fecha de entrega(delivery_date)
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
        Schema::dropIfExists('rentals');
    }
};
