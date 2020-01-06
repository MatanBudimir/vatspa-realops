<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Models\EventInfo;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('admin', function() {
            return auth()->user()->access_level == 1;
        });

        Blade::if('hasBooking', function() {
            return Booking::where('user_id', Auth::user()->id)->where('booked', true)->exists();
        });
    }
}
