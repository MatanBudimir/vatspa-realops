<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\EventInfo;
use Illuminate\Support\Str;
use Rap2hpoutre\FastExcel\FastExcel;
use DB;

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

    protected function editEvent(Request $request) {
        $request->validate([
            'booking_end' => 'required',
            'icao' => 'required|min:4|max:4',
            'chart' => 'required',
            'back_img' => 'required',
            'banner' => 'required',
            'ev_name' => 'required',
            'ev_date' => 'required',
            'title' => 'required',
            'b_title' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);
        EventInfo::first()->update([
            'bookings_end' => $request->booking_end,
            'icao' => $request->icao,
            'allowed_bookings' => $request->allowed,
            'chart_link' => $request->chart,
            'background_image' => $request->back_img,
            'banner_link' => $request->banner,
            'event_name' => $request->ev_name,
            'event_date' => $request->ev_date,
            'title_text' => $request->title,
            'below_title_text' => $request->b_title,
            'start_time' => $request->start,
            'end_time' => $request->end,
            'event_text' => $request->ev_text,
        ]);

        return redirect()->back()->withSuccess('Event Edited!');
    }

    protected function importFlight(Request $request) {
        Booking::truncate();
        $path = $request->file('xlsx')->storeAs('files', 'flights.xlsx');
        $bookings = (new FastExcel)->import(storage_path('app/files/flights.xlsx'), function ($line) {
            return Booking::create([
                'user_id' => null,
                'unique_id' => Str::random(10) . '-' . Str::random(10),
                'callsign' => $line['callsign'],
                'aircraft' => $line['aircraft'],
                'etd' => $line['etd'],
                'eta' => $line['eta'],
                'date' => $line['date'],
                'route' => $line['route'],
                'booked' => false,
                'dep_icao' => $line['dep'],
                'arr_icao' => $line['arr'],
                'type' => $line['type'],
            ]);
        });

        return redirect()->back()->withSuccess('Flights Successfully imported!');
    }
}
