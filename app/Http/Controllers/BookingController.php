<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EventInfo;

class BookingController extends Controller
{
    public function departures() {

        if (Booking::where('user_id', Auth::user()->id)->where('booked', true)->count() >= EventInfo::first()->allowed_bookings) {
            return redirect()->back()->withError('You already reached maximum number of bookings!');
        }

        $slots = Booking::where('type', 'DEP')->get();

        return view('bookings.index')->withSlots($slots);
    }

    public function arrivals() {
        if (Booking::where('user_id', Auth::user()->id)->where('booked', true)->count() >= EventInfo::first()->allowed_bookings) {
            return redirect()->back()->withError('You already reached maximum number of bookings!');
        }
        $slots = Booking::where('type', 'ARR')->get();

        return view('bookings.index')->withSlots($slots);
    }

    public function viewSlot($uid) {
        if (! Booking::where('unique_id', $uid)->exists()) {
            return redirect()->back()->withError('Slot does not exist!');
        }

        if (Booking::where('unique_id', $uid)->first()->booked == true) {
            return redirect()->back()->withError('Slot is already booked!');
        }

        if (Booking::where('user_id', Auth::user()->id)->where('booked', true)->count() >= EventInfo::first()->allowed_bookings) {
            return redirect()->back()->withError('You already reached maximum number of bookings!');
        }

        $slot = Booking::where('unique_id', $uid)->firstOrFail();

        return view('bookings.book')->withSlot($slot);
    }

}
