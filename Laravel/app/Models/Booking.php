<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'event_id',
        'package_id',
        'status',
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
}
