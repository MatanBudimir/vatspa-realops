<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\EventInfo;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function home() {
        $evenInfo = EventInfo::first();

        return view('front.index')->withEvent($evenInfo);
    }

    public function profile() {
        $bookings = Booking::where('user_id', Auth::user()->id)->get();
        return view('user.profile')->withBookings($bookings);
    }
}
