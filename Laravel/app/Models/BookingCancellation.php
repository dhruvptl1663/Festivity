<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;

class BookingCancellation extends Model
{
    use HasFactory;
    
    protected $table = 'booking_cancellations';
    
    protected $primaryKey = 'cancellation_id';
    
    protected $fillable = [
        'booking_id',
        'cancelled_by',
        'reason',
        'refund_amount',
    ];
    
    public $timestamps = false;
    
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
