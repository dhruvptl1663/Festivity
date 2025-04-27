<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminCommission extends Model
{
    use HasFactory;

    protected $table = 'admin_commissions';
    
    protected $primaryKey = 'commission_id';
    
    protected $fillable = [
        'booking_id',
        'amount',
        'created_at'
    ];
    
    public $timestamps = false;
    
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'booking_id');
    }
}
