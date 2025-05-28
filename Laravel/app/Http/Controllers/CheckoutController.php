<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\PromoCode;
use App\Models\AdminCommission;
use App\Models\Cart;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function submit(Request $request)
    {
        Log::info('CheckoutController@submit called - redirecting to payment flow', ['user_id' => Auth::id(), 'input' => $request->all()]);
        
        // Check if authenticated
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'error' => 'User not authenticated'], 401);
            }
            return redirect()->route('login')->with('error', 'Please login to continue');
        }
        
        // This method is now deprecated - redirect to payment flow
        // Calculate total amount from cart
        $user_id = Auth::id();
        $cartItems = Cart::with(['event', 'package'])
            ->where('user_id', $user_id)
            ->get();

        if ($cartItems->isEmpty()) {
            Log::warning('Cart is empty for user', ['user_id' => $user_id]);
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'error' => 'Your cart is empty'], 400);
            }
            return redirect()->back()->with('error', 'Your cart is empty');
        }

        // Inform client to use the payment flow instead
        Log::info('Redirecting to cart page to use payment flow');
        
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'error' => 'Please use the Razorpay payment flow to complete your booking.',
                'redirect' => route('cart')
            ]);
        }
        
        return redirect()->route('cart')->with('payment_required', 'Please complete the payment to process your booking.');
    }

    public function congratulations()
    {
        return view('checkout.congratulations');
    }
}
