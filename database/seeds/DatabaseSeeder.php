<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_info')->insert([
            'bookings_end' => Carbon::now(),
            'background_image' => 'https://vatspa.es/img/bck1.jpg',
            'banner_link' => 'https://vatspa.es/img/eventos/madrid-wednesdays.png',
            'event_name' => 'Madrid Realops',
            'event_text' => 'Basic text',
            'below_title_text' => 'We proudly invite you to Madrid Realops',
        ]);
    }
}
