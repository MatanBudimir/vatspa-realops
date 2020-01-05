<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventInfo;

class PagesController extends Controller
{
    public function home() {
        $evenInfo = EventInfo::first();

        return view('front.index')->withEvent($evenInfo);
    }
}
