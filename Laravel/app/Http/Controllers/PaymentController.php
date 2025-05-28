<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\AppliedPromoCode;
use App\Models\PromoCode;
use App\Models\Cart;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    private $razorpayKey;
    private $razorpaySecret;

    public function __construct()
    {
        $this->middleware('auth');
        
        $this->razorpayKey = env('RAZORPAY_KEY');
        $this->razorpaySecret = env('RAZORPAY_SECRET');

        if (!$this->razorpayKey || !$this->razorpaySecret) {
            Log::error('Razorpay credentials not set in .env');
            throw new \RuntimeException('Razorpay credentials not set in .env');
        }

        Log::info('Razorpay credentials loaded', [
            'key' => $this->razorpayKey,
            'secret' => '******' // Don't log the actual secret
        ]);
    }

    public function initiatePayment(Request $request)
    {
        try {
            Log::info('Payment initiation started', [
                'user_id' => Auth::id(),
                'request_data' => $request->all()
            ]);

            // Validate request
            $request->validate([
                'amount' => 'required|numeric|min:0',
                'promo_code' => 'nullable|string|max:50'
            ]);

            Log::info('Request validation passed');

            // Get cart items
            $cartItems = Cart::with(['event', 'package'])
                ->where('user_id', Auth::id())
                ->get();

            if ($cartItems->isEmpty()) {
                Log::warning('Cart is empty for user', ['user_id' => Auth::id()]);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cart is empty'
                ], 400);
            }

            Log::info('Cart items retrieved', [
                'cart_count' => $cartItems->count(),
                'cart_items' => $cartItems->map(function($item) {
                    return [
                        'id' => $item->id,
                        'type' => $item->event ? 'event' : 'package',
                        'name' => $item->event ? $item->event->title : $item->package->name
                    ];
                })->toArray()
            ]);

            // Calculate total amount and apply promo code if provided
            $totalAmount = $request->amount;
            $discountAmount = 0;
            $promoCode = null;

            if ($request->promo_code) {
                Log::info('Checking promo code', ['code' => $request->promo_code]);
                $promoCode = PromoCode::where('code', $request->promo_code)
                    ->where('expiry_date', '>=', Carbon::now())
                    ->first();

                if ($promoCode) {
                    Log::info('Valid promo code found', [
                        'code' => $promoCode->code,
                        'discount_percentage' => $promoCode->discount_percentage
                    ]);
                    
                    $discountAmount = $totalAmount * ($promoCode->discount_percentage / 100);
                    if ($promoCode->max_discount_amount > 0) {
                        $discountAmount = min($discountAmount, $promoCode->max_discount_amount);
                    }
                    $totalAmount -= $discountAmount;
                } else {
                    Log::warning('Invalid promo code', ['code' => $request->promo_code]);
                }
            }

            Log::info('Amount calculation completed', [
                'original_amount' => $request->amount,
                'discount_amount' => $discountAmount,
                'final_amount' => $totalAmount
            ]);

            // Create Razorpay order
            try {
                Log::info('Attempting to create Razorpay order', [
                    'amount' => $totalAmount,
                    'currency' => 'INR'
                ]);

                $api = new Api($this->razorpayKey, $this->razorpaySecret);
                
                $order = $api->order->create([
                    'amount' => $totalAmount * 100, // Razorpay amount is in paise
                    'currency' => 'INR',
                    'receipt' => 'order_' . time(),
                    'payment_capture' => 1
                ]);

                Log::info('Razorpay order created successfully', [
                    'order_id' => $order->id
                ]);

                return response()->json([
                    'status' => 'success',
                    'order_id' => $order->id,
                    'key' => $this->razorpayKey,
                    'amount' => $totalAmount * 100,
                    'currency' => 'INR',
                    'name' => Auth::user()->name,
                    'promo_code' => $promoCode ? $promoCode->code : null,
                    'discount_amount' => $discountAmount
                ]);

            } catch (\Razorpay\Api\Errors\BadRequestError $e) {
                Log::error('Razorpay API error', [
                    'error' => $e->getMessage(),
                    'code' => $e->getCode(),
                    'trace' => $e->getTraceAsString()
                ]);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Razorpay API error: ' . $e->getMessage()
                ], 422);
            } catch (\Exception $e) {
                Log::error('Failed to create Razorpay order', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to create Razorpay order: ' . $e->getMessage()
                ], 500);
            }

        } catch (\Exception $e) {
            Log::error('Payment initiation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'status' => 'error',
                'message' => 'Payment initiation failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function verifyPayment(Request $request)
    {
        Log::info('Payment verification started', ['user_id' => Auth::id(), 'request_data' => $request->all()]);
        
        try {
            // Validate request
            $request->validate([
                'razorpay_payment_id' => 'required|string',
                'razorpay_order_id' => 'required|string',
                'razorpay_signature' => 'required|string',
                'date_time_selections' => 'required|array',
                'date_time_selections.*.id' => 'required',
                'date_time_selections.*.type' => 'required|in:event,package',
                'date_time_selections.*.datetime' => 'required|date_format:Y-m-d H:i'
            ]);

            // Verify payment signature
            $api = new Api($this->razorpayKey, $this->razorpaySecret);

            $attributes = [
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            Log::info('Verifying payment signature', ['attributes' => $attributes]);
            $api->utility->verifyPaymentSignature($attributes);
            Log::info('Payment signature verification successful');

            // Get cart items
            $cartItems = Cart::with(['event', 'package'])
                ->where('user_id', Auth::id())
                ->get();

            if ($cartItems->isEmpty()) {
                Log::warning('Cart is empty for user', ['user_id' => Auth::id()]);
                throw new \Exception('Cart is empty');
            }

            Log::info('Cart items retrieved', ['cart_count' => $cartItems->count()]);
            
            // Get date/time selections from the request
            $dateTimeSelections = $request->input('date_time_selections');
            
            // Create a lookup map for easier access
            $dateTimeMap = [];
            foreach ($dateTimeSelections as $selection) {
                $key = $selection['type'] . '_' . $selection['id'];
                $dateTimeMap[$key] = $selection['datetime'];
            }
            
            \Illuminate\Support\Facades\DB::beginTransaction();
            
            try {
                $totalDiscount = $request->discount_amount ?? 0;
                $totalFinalAmount = $request->amount;
                $user_id = Auth::id();
                
                // Get promo code if available
                $promo_code = $request->input('promo_code');
                $promo = null;
                
                if ($promo_code) {
                    $promo = PromoCode::where('code', $promo_code)->first();
                    Log::info('Promo code lookup result', ['found' => ($promo ? 'yes' : 'no')]);
                }
                
                foreach ($cartItems as $item) {
                    Log::info('Processing cart item', ['item_id' => $item->id, 'event_id' => $item->event_id, 'package_id' => $item->package_id]);
                    
                    // Get the price based on whether it's an event or package
                    $originalPrice = 0;
                    if ($item->event_id && $item->event) {
                        $originalPrice = $item->event->price;
                    } elseif ($item->package_id && $item->package) {
                        $originalPrice = $item->package->price;
                    } else {
                        Log::error('Invalid cart item - missing price', ['item' => $item]);
                        continue; // Skip this item
                    }
                    
                    $finalPrice = $originalPrice;
                    $itemDiscount = 0;
                    
                    // Calculate individual item discount from the total discount
                    // This is a simple proportional calculation; you might want a more sophisticated approach
                    if ($totalDiscount > 0) {
                        $itemDiscount = ($originalPrice / $totalFinalAmount) * $totalDiscount;
                        $finalPrice -= $itemDiscount;
                    }
                    
                    // Get the selected date and time for this item
                    $itemType = $item->event_id ? 'event' : 'package';
                    $itemId = $item->event_id ? $item->event_id : $item->package_id;
                    $lookupKey = $itemType . '_' . $itemId;
                    
                    // Get the event datetime from the map
                    $eventDatetime = null;
                    if (isset($dateTimeMap[$lookupKey])) {
                        $eventDatetime = $dateTimeMap[$lookupKey];
                        Log::info('Found event datetime', ['item' => $lookupKey, 'datetime' => $eventDatetime]);
                    } else {
                        Log::warning('No datetime found for item', ['item' => $lookupKey]);
                    }
                    
                    // Create booking record
                    $booking_id = \Illuminate\Support\Facades\DB::table('bookings')->insertGetId([
                        'user_id' => $user_id,
                        'event_id' => $item->event_id,
                        'package_id' => $item->package_id,
                        'event_datetime' => $eventDatetime,
                        'advance_paid' => $finalPrice,
                        'status' => 'pending', // Keep status as pending for decorator to review
                        'payment_id' => $request->razorpay_payment_id,
                        'created_at' => now(),
                    ]);
                    
                    Log::info('Booking created', ['booking_id' => $booking_id]);
                    
                    // Apply promo code if exists
                    if ($promo) {
                        \Illuminate\Support\Facades\DB::table('applied_promo_codes')->insert([
                            'user_id' => $user_id,
                            'promo_id' => $promo->promo_id,
                            'booking_id' => $booking_id,
                            'discount_applied' => $itemDiscount,
                            'applied_at' => now(),
                        ]);
                        Log::info('Promo code applied', ['promo_id' => $promo->promo_id, 'booking_id' => $booking_id, 'discount' => $itemDiscount]);
                    }
                    
                    // Calculate and store admin commission
                    $commissionAmount = $finalPrice * 0.1; // 10% commission rate
                    \Illuminate\Support\Facades\DB::table('admin_commissions')->insert([
                        'booking_id' => $booking_id,
                        'amount' => $commissionAmount,
                        'created_at' => now(),
                    ]);
                    
                    Log::info('Admin commission created', ['booking_id' => $booking_id]);
                }
                
                // Clear cart after successful booking
                Cart::where('user_id', $user_id)->delete();
                Log::info('Cart cleared for user', ['user_id' => $user_id]);
                
                \Illuminate\Support\Facades\DB::commit();
                Log::info('Transaction committed successfully');
                
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\DB::rollBack();
                Log::error('Transaction failed during payment verification', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                throw $e; // Re-throw to be caught by the outer catch block
            }

            // Return a success message with redirect to the congratulations page
            return response()->json([
                'status' => 'success',
                'message' => 'Payment successful',
                'redirect' => route('congratulations')
            ]);

        } catch (\Exception $e) {
            Log::error('Payment verification failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'status' => 'error',
                'message' => 'Payment verification failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function testPayment(Request $request)
    {
        try {
            // Test Razorpay credentials
            $api = new Api($this->razorpayKey, $this->razorpaySecret);
            
            // Create a test order
            $order = $api->order->create([
                'amount' => 100, // 1 rupee
                'currency' => 'INR',
                'receipt' => 'test_order_' . time(),
                'payment_capture' => 1
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Test payment successful',
                'order_id' => $order->id
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Test payment failed: ' . $e->getMessage()
            ], 500);
        }
    }
}