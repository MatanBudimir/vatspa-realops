<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users() {
        $users = User::all();

        return view('admin.users')->withUsers($users);
    }
}
