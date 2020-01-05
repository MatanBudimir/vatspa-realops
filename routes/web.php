<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('front.index');
});

//VATSIM SSO Routing
Route::get('/login', 'LoginController@login')->middleware('guest')->name('login');
Route::get('/validate', 'LoginController@validateLogin')->middleware('guest')->name('sso.validate');
Route::get('/logout', 'LoginController@logout')->middleware('auth')->name('logout');
