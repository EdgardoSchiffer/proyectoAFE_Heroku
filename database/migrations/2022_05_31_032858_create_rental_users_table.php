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
        Schema::create('rental_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rental_id')->reference('id')->on('rentals')->nullable()->constrained();
            $table->foreignId('user_id')->reference('id')->on('users')->nullable()->constrained();
            $table->string('option'); //option recibir, entregar
            $table->timestamp('date'); //fecha depende de la opcion recibir, entregar
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
        Schema::dropIfExists('rental_users');
    }
};
