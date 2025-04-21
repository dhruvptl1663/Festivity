<?php

namespace App\Http\Controllers;

use App\Models\PromoCode;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PromoCodeController extends Controller
{
    public function apply(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50'
        ]);

        $promoCode = PromoCode::where('code', $request->code)
            ->where('expiry_date', '>=', Carbon::now())
            ->first();

        if (!$promoCode) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or expired promo code'
            ], 400);
        }

        // Calculate discount
        $cartTotal = $request->cart_total;
        $discountAmount = $cartTotal * ($promoCode->discount_percentage / 100);
        
        // Apply max discount limit if set
        if ($promoCode->max_discount_amount > 0) {
            $discountAmount = min($discountAmount, $promoCode->max_discount_amount);
        }

        return response()->json([
            'status' => 'success',
            'discount' => round($discountAmount, 2),
            'message' => 'Promo code applied successfully'
        ]);
    }
}
