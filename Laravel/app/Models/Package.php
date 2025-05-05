<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $table = 'packages';

    protected $primaryKey = 'package_id';

    protected $fillable = [
        'title',
        'description',
        'decorator_id',
        'price',
        'rating',
        'status',
        'image',
        'discounted_price',
        'is_featured',
    ];

    public $timestamps = false; //to prevent error with timestamps column
    
    protected $casts = [
        'price' => 'float',
        'discounted_price' => 'float',
        'rating' => 'float',
        'is_featured' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scope for active packages
    public function scopeActive($query)
    {
        return $query->where('status', 'approved');
    }

    public function decorator()
    {
        return $this->belongsTo(Decorator::class, 'decorator_id');
    }

    public function packageEvents()
    {
        return $this->hasMany(PackageEvent::class, 'package_id');
    }

    public function events()
    {
        return $this->hasManyThrough(
            Event::class,
            PackageEvent::class,
            'package_id', // Foreign key on package_events table
            'event_id',   // Foreign key on events table
            'package_id', // Local key on packages table
            'event_id'    // Local key on events table
        );
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'package_id');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'package_id');
    }
    
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'package_id');
    }
    
    public function cartItems()
    {
        return $this->hasMany(Cart::class, 'package_id');
    }
    
    /**
     * Get the total bookings count for this package
     */
    public function getBookingsCountAttribute()
    {
        return $this->bookings()->count();
    }
    
    /**
     * Get the total revenue from this package
     */
    public function getRevenueAttribute()
    {
        return $this->bookings()->where('status', 'completed')->sum('final_amount');
    }
    
    /**
     * Get the effective price (discounted or original)
     */
    public function getEffectivePriceAttribute()
    {
        return $this->discounted_price > 0 ? $this->discounted_price : $this->price;
    }
}
