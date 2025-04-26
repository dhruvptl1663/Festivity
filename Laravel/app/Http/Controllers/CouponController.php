<?php

namespace App\Http\Controllers;

use App\Models\PromoCode;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $promoCodes = PromoCode::all();
        return view('Admin.coupon', compact('promoCodes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:promo_codes,code',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'max_discount_amount' => 'required|numeric|min:0',
            'expiry_date' => 'required|date|after:today'
        ]);

        PromoCode::create($validated);

        return redirect()->back()->with('success', 'Promo code created successfully');
    }

    public function destroy($promo_id)
    {
        $coupon = PromoCode::findOrFail($promo_id);
        $coupon->delete();
        return redirect()->back()->with('success', 'Promo code deleted successfully');
    }
    
}