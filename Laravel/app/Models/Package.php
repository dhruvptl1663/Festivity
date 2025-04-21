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
    ];

    public $timestamps = false; //to prevent error with timestamps column

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
}
