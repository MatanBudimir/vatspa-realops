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

        if (strlen($request->aircraft) < 4 || strlen($request->aircraft) > 4) {
            return redirect()->back()->withError('Please enter valid aircraft type!');
        }



        Booking::where('unique_id', $request->uid)->where('booked', false)->update([
            'aircraft' => strtoupper($request->aircraft),
            'user_id' => Auth::user()->id,
            'booked' => true,
        ]);

        return redirect()->route('profile')->withSuccess('Slot Successfully booked!');
    }

    public function booking($uid) {
        if (! Booking::where('unique_id', $uid)->exists()) {
            return redirect()->back()->withError('Slot does not exist!');
        }

        if (Booking::where('unique_id', $uid)->first()->user_id != Auth::user()->id) {
            return redirect()->back()->withError('This is not your slot!');
        }

        if (! Booking::where('user_id', Auth::user()->id)->where('unique_id', $uid)->exists()) {
            return redirect()->back()->withError('Slot does not exist!');
        }

        $slot = Booking::where('unique_id', $uid)->where('user_id', Auth::user()->id)->where('booked', true)->firstOrFail();

        return view('bookings.slot')->withSlot($slot);

    }

    public function edit(Request $request) {
        if (! Booking::where('unique_id', $request->uid)->exists()) {
            return redirect()->back()->withError('Slot does not exist!');
        }

        if (! Booking::where('user_id', Auth::user()->id)->where('unique_id', $request->uid)->exists()) {
            return redirect()->back()->withError('Slot does not exist!');
        }

        if (Booking::where('unique_id', $request->uid)->first()->user_id != Auth::user()->id) {
            return redirect()->back()->withError('This is not your slot!');
        }

        if (strlen($request->aircraft) < 4 || strlen($request->aircraft) > 4) {
            return redirect()->back()->withError('Please enter valid aircraft type!');
        }

        Booking::where('user_id', Auth::user()->id)->where('booked', true)->where('unique_id', $request->uid)->update([
            'aircraft' => $request->aircraft,
        ]);

        return redirect()->back()->withSuccess('Slot successfully edited!');
    }

    public function delete(Request $request) {
        if (! Booking::where('unique_id', $request->uid)->exists()) {
            return redirect()->back()->withError('Slot does not exist!');
        }

        if (! Booking::where('user_id', Auth::user()->id)->where('unique_id', $request->uid)->exists()) {
            return redirect()->back()->withError('Slot does not exist!');
        }

        if (Booking::where('unique_id', $request->uid)->first()->user_id != Auth::user()->id) {
            return redirect()->back()->withError('This is not your slot!');
        }


        Booking::where('user_id', Auth::user()->id)->where('booked', true)->where('unique_id', $request->uid)->update([
            'aircraft' => null,
            'user_id' => null,
            'booked' => false,
        ]);

        return redirect()->route('profile')->withSuccess('Slot successfully deleted!');
    }

}
