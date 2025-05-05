<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Feedback;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'user_id',
        'event_id',
        'package_id',
        'decorator_id',  // Added decorator_id to fillable
        'original_amount',
        'discount_amount',
        'final_amount',
        'status',
        'booking_date',
        'created_at',
        'updated_at',
    ];

    public $timestamps = false; //to prevent error with timestamps column

    protected $casts = [
        'booking_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    /**
     * Get the decorator associated with this booking.
     * This will either be directly assigned or derived from the event/package.
     */
    public function decorator()
    {
        // If decorator_id is directly set on the booking
        if ($this->decorator_id) {
            return $this->belongsTo(Decorator::class, 'decorator_id');
        }
        
        // Otherwise, get it from the related event or package
        return $this->event ? $this->event->decorator() : ($this->package ? $this->package->decorator() : null);
    }
    
    public function feedback()
    {
        return $this->hasOne(Feedback::class, 'booking_id');
    }
    
    public function cancellation()
    {
        return $this->hasOne(BookingCancellation::class, 'booking_id');
    }
    
    public function hasFeedback()
    {
        return $this->feedback()->exists();
    }
    
    public function isCancelled()
    {
        return $this->status === 'cancelled' || $this->cancellation()->exists();
    }
    
    /**
     * Determine if this booking is eligible for cancellation
     */
    public function isEligibleForCancellation()
    {
        return in_array($this->status, ['pending', 'accepted']) && !$this->isCancelled();
    }
    
    /**
     * Determine if this booking is eligible for feedback
     */
    public function isEligibleForFeedback()
    {
        return $this->status === 'completed' && !$this->hasFeedback();
    }
    
    /**
     * Get the decorator ID for this booking (directly set or from related entities)
     */
    public function getDecoratorIdAttribute()
    {
        if ($this->attributes['decorator_id'] ?? null) {
            return $this->attributes['decorator_id'];
        }
        
        if ($this->event_id && $this->event) {
            return $this->event->decorator_id;
        }
        
        if ($this->package_id && $this->package) {
            return $this->package->decorator_id;
        }
        
        return null;
    }
}
