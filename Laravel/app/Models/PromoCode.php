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
        return now()->lessThanOrEqualTo($this->expiry_date);
    }

    /**
     * Calculate the discount for a given price based on this promo code.
     * @param float $price
     * @return float
     */
    public function calculateDiscount($price)
    {
        $discount = ($price * $this->discount_percentage) / 100;
        if ($this->max_discount_amount !== null && $this->max_discount_amount > 0) {
            $discount = min($discount, $this->max_discount_amount);
        }
        return round($discount, 2);
    }
}
