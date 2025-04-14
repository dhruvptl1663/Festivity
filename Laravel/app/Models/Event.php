<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $primaryKey = 'event_id';

    protected $fillable = [
        'title',
        'description',
        'image',
        'category_id',
        'decorator_id',
        'is_live',
        'price',
        'rating',
    ];

    public $timestamps = false; //to prevent error with timestamps column

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function decorator()
    {
        return $this->belongsTo(Decorator::class, 'decorator_id');
    }

    public function packageEvents()
    {
        return $this->hasMany(PackageEvent::class, 'event_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'event_id');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'event_id');
    }

    public function getReviewsCountAttribute()
    {
        return $this->feedback()->count();
    }

    public function getRatingCountAttribute()
    {
        return $this->feedback()->whereNotNull('rating')->count();
    }
}
