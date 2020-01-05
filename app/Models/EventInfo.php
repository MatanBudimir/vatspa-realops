<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventInfo extends Model
{
    protected $table = 'event_info';

    protected $fillable = [
        'bookings', 'bookings_end', 'icao', 'allowed_bookings', 'chart_link', 'background_image',
        'banner_link', 'event_name', 'event_text', 'title_text', 'below_title_text', 'start_time',
        'end_time',
    ];
}
