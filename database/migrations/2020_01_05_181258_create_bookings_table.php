<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->string('unique_id');
            $table->string('callsign')->nullable();
            $table->string('aircraft')->nullable();
            $table->string('type');
            $table->string('etd')->nullable();
            $table->string('eta')->nullable();
            $table->string('date')->nullable();
            $table->longtext('route')->nullable();
            $table->boolean('booked')->default(false);
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
        Schema::dropIfExists('bookings');
    }
}
