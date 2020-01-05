<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $fillable = [
        'user_id', 'unique_id', 'callsign', 'aircraft', 'etd', 'eta', 'date', 'route', 'booked',
    ];

    public function pilot() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
