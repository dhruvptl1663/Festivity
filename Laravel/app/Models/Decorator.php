<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Use Authenticatable for decorators

class Decorator extends Authenticatable
{
    use HasFactory;

    protected $table = 'decorators';

    protected $primaryKey = 'decorator_id';

    protected $fillable = [
        'decorator_name',
        'decorator_icon',
        'email',
        'password',
        'rating',
        'availability',
        'description',
        'location',
        'contact_number',
        'profile_image',
    ];

    public $timestamps = false;

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $casts = [
        'availability' => 'boolean',
        'rating' => 'float',
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * Get the name of the column used for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'decorator_id');
    }

    public function packages()
    {
        return $this->hasMany(Package::class, 'decorator_id');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'decorator_id');
    }
    
    /**
     * Get all bookings associated with this decorator (either directly or through events/packages)
     */
    public function bookings()
    {
        // First get direct associations if decorator_id is directly on bookings
        $directBookings = Booking::where('decorator_id', $this->decorator_id);
        
        // Get event IDs for this decorator
        $eventIds = $this->events()->pluck('event_id');
        
        // Get package IDs for this decorator
        $packageIds = $this->packages()->pluck('package_id');
        
        // Build a query to get all bookings that reference this decorator's events or packages
        return Booking::where('decorator_id', $this->decorator_id)
            ->orWhereIn('event_id', $eventIds)
            ->orWhereIn('package_id', $packageIds);
    }
    
    /**
     * Get all carts associated with this decorator (either directly or through events/packages)
     */
    public function carts()
    {
        // Get event IDs for this decorator
        $eventIds = $this->events()->pluck('event_id');
        
        // Get package IDs for this decorator
        $packageIds = $this->packages()->pluck('package_id');
        
        return Cart::where('decorator_id', $this->decorator_id)
            ->orWhereIn('event_id', $eventIds)
            ->orWhereIn('package_id', $packageIds);
    }
    
    /**
     * Get all bookmarks for this decorator (either directly or through events/packages)
     */
    public function bookmarks()
    {
        // Get event IDs for this decorator
        $eventIds = $this->events()->pluck('event_id');
        
        // Get package IDs for this decorator
        $packageIds = $this->packages()->pluck('package_id');
        
        return Bookmark::where('decorator_id', $this->decorator_id)
            ->orWhereIn('event_id', $eventIds)
            ->orWhereIn('package_id', $packageIds);
    }
}
