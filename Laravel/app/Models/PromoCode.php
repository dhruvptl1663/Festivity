<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    public $timestamps = false;
    protected $table = 'promo_codes';
    protected $primaryKey = 'promo_id';
    
    protected $fillable = [
        'code',
        'discount_percentage',
        'max_discount_amount',
        'expiry_date'
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'discount_percentage' => 'decimal:2',
        'max_discount_amount' => 'decimal:2'
    ];

    public function isValid()
    {
        return $this->expiry_date->isFuture();
    }
}
