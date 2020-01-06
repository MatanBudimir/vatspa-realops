<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EventInfo;
use Illuminate\Support\Carbon;

class BookingController extends Controller
{
    public function departures() {

        if (Booking::where('user_id', Auth::user()->id)->where('booked', true)->count() >= EventInfo::first()->allowed_bookings) {
            return redirect()->back()->withError('You already reached maximum number of bookings!');
        }

        if (EventInfo::first()->bookings_end <= Carbon::now()) {
            return redirect()->back()->withError('Bookings are closed!');
        }

        $slots = Booking::where('type', 'DEP')->get();

        return view('bookings.index')->withSlots($slots);
    }

    public function arrivals() {
        if (Booking::where('user_id', Auth::user()->id)->where('booked', true)->count() >= EventInfo::first()->allowed_bookings) {
            return redirect()->back()->withError('You already reached maximum number of bookings!');
        }

        if (EventInfo::first()->bookings_end <= Carbon::now()) {
            return redirect()->back()->withError('Bookings are closed!');
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

        if (EventInfo::first()->bookings_end <= Carbon::now()) {
            return redirect()->back()->withError('Bookings are closed!');
        }

        $slot = Booking::where('unique_id', $uid)->firstOrFail();

        return view('bookings.book')->withSlot($slot);
    }

    public function book(Request $request) {
        if (! Booking::where('unique_id', $request->uid)->exists()) {
            return redirect()->back()->withError('Slot does not exist!');
        }

        if (Booking::where('unique_id', $request->uid)->first()->booked == true) {
            return redirect()->back()->withError('Slot is already booked!');
        }

        if (Booking::where('user_id', Auth::user()->id)->where('booked', true)->count() >= EventInfo::first()->allowed_bookings) {
            return redirect()->back()->withError('You already reached maximum number of bookings!');
        }

        if (EventInfo::first()->bookings_end <= Carbon::now()) {
            return redirect()->back()->withError('Bookings are closed!');
        }

        $slot = Booking::where('unique_id', $request->uid)->where('booked', false)->first();

        if ($slot->callsign == null || $slot->callsign == '') {
            if (Booking::where('callsign', $request->cs)->exists()) {
                return redirect()->back()->withError('Callsign already in use!');
            }
            if (strlen($request->cs) < 4 || strlen($request->cs) > 7) {
                return redirect()->back()->withError('Please enter valid callsign!');
            }
            $slot->callsign = $request->cs;
        }

        if ($slot->aircraft == null || $slot->aircraft == '') {
            if (strlen($request->aircraft) < 3 || strlen($request->aircraft) > 4) {
                return redirect()->back()->withError('Please enter valid aircraft type!');
            }
            $slot->aircraft = $request->aircraft;
        }

        $slot->user_id = Auth::user()->id;
        $slot->booked = true;

        $slot->save();

        return redirect()->route('profile')->withSuccess('Slot Successfully booked!');
    }

}
