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

Route::get('/', 'PagesController@home')->name('home');

Route::group(['middleware' => 'auth'], function () {



    Route::group(['prefix' => 'bookings'], function () {

        Route::get('departures', 'BookingController@departures')->name('bookings.dep');

        Route::get('arrivals', 'BookingController@arrivals')->name('bookings.arr');

    });

    Route::group(['prefix' => 'book'], function () {

        Route::get('{id}', 'BookingController@viewSlot')->name('user.start.booking');

        Route::post('/', 'BookingController@book')->name('user.book.slot');

    });

    Route::get('booking/{id}', 'BookingController@booking')->name('user.booking');

    Route::post('booking/edit', 'BookingController@edit')->name('user.edit.slot');

    Route::post('booking/delete', 'BookingController@delete')->name('user.delete.slot');

    Route::get('profile', 'PagesController@profile')->name('profile');

});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

    Route::get('users', 'AdminController@users')->name('admin.users');

    Route::get('bookings', 'AdminController@bookings')->name('admin.bookings');

    Route::get('event', 'AdminController@eventInfo')->name('admin.event');

    Route::post('edit', 'AdminController@editUser')->name('admin.user.edit');

    Route::post('import', 'AdminController@importFlight')->name('admin.import.flights');

    Route::post('event/edit', 'AdminController@editEvent')->name('admin.edit.event');

});


//VATSIM SSO Routing
Route::get('/login', 'Auth\LoginController@login')->middleware('guest')->name('login');
Route::get('/validate', 'Auth\LoginController@validateLogin')->middleware('guest')->name('sso.validate');
Route::get('/logout', 'Auth\LoginController@logout')->middleware('auth')->name('logout');
