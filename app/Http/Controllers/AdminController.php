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

    protected function editUser(Request $request) {
        if (User::where('id', $request->cid)->first()->access_level == $request->role) {
            return redirect()->back()->withError('User is already member of this role');
        }

        User::where('id', $request->cid)->update([
            'access_level' => $request->role,
        ]);

        return redirect()->back()->withSuccess('User successfully edited!');
    }
}
