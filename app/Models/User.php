<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','fname', 'lname','email', 'receive_email', 'access_level',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function full() {
        return $this->fname . ' ' . $this->lname;
    }

    public function bookings() {
        return $this->hasMany('App\Models\Booking', 'id', 'user_id');
    }

}
