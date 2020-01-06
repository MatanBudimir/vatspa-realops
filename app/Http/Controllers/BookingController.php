<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function departures() {
        $slots = Booking::where('type', 'DEP')->get();

        return view('bookings.index')->withSlots($slots);
    }

    public function arrivals() {
        $slots = Booking::where('type', 'ARR')->get();

        return view('bookings.index')->withSlots($slots);
    }
}
