<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('bookings')->default(false);
            $table->timestamp('bookings_end');
            $table->string('icao')->default('LEMD');
            $table->tinyInteger('allowed_bookings')->default(1);
            $table->string('chart_link')->default('https://ais.enaire.es/AIP/');
            $table->longtext('background_image');
            $table->longtext('banner_link');
            $table->longtext('event_name');
            $table->longtext('event_text');
            $table->string('title_text')->default('Madrid Realops');
            $table->longtext('below_title_text');
            $table->time('start_time')->default('00:00');
            $table->time('end_time')->default('00:00');
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
        Schema::dropIfExists('event_info');
    }
}
