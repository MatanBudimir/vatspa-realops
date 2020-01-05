<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\EventInfo;

class AdminController extends Controller
{
    public function users() {
        $users = User::all();

        return view('admin.users')->withUsers($users);
    }

    public function bookings() {
        $bookings = Booking::where('booked', true)->get();

        return view('admin.bookings')->withBookings($bookings);
    }

    public function eventInfo() {
        $event = EventInfo::first();

        return view('admin.eventInfo')->withEvent($event);
    }
}
