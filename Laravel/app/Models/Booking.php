<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Feedback;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'user_id',
        'event_id',
        'package_id',
        'original_amount',
        'discount_amount',
        'final_amount',
        'status',
        'created_at',
        'updated_at',
    ];

    public $timestamps = false; //to prevent error with timestamps column

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
    
    public function feedback()
    {
        return $this->hasOne(Feedback::class, 'booking_id');
    }
    
    public function hasFeedback()
    {
        return Feedback::where('booking_id', $this->booking_id)->exists();
    }
}
