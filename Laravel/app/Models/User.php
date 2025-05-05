<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public $timestamps = false;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'user_id');
    }

    // User has many bookmarks
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'user_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id', 'user_id');
    }
    
    // User has many bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

    // User has many cart items
    public function cartItems()
    {
        return $this->hasMany(Cart::class, 'user_id');
    }

    // User has many cancellations through bookings
    public function cancellations()
    {
        return $this->hasManyThrough(BookingCancellation::class, Booking::class, 'user_id', 'booking_id', 'user_id', 'booking_id');
    }

    /**
     * Get the name of the column used for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
