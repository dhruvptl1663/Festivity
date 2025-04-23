<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\AppliedPromoCode;
use App\Models\PromoCode;
use App\Models\Cart;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    private $razorpayKey;
    private $razorpaySecret;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('json');
        
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
        try {
            // Validate request
            $request->validate([
                'razorpay_payment_id' => 'required|string',
                'razorpay_order_id' => 'required|string',
                'razorpay_signature' => 'required|string'
            ]);

            // Verify payment signature
            $api = new Api($this->razorpayKey, $this->razorpaySecret);

            $attributes = [
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            $api->utility->verifyPaymentSignature($attributes);

            // Get cart items
            $cartItems = Cart::with(['event', 'package'])
                ->where('user_id', Auth::id())
                ->get();

            if ($cartItems->isEmpty()) {
                throw new \Exception('Cart is empty');
            }

            // Create booking
            $booking = new Booking();
            $booking->user_id = Auth::id();
            $booking->total_amount = $request->amount;
            $booking->discount_amount = $request->discount_amount ?? 0;
            $booking->payment_status = 'completed';
            $booking->payment_id = $request->razorpay_payment_id;
            $booking->save();

            // Create booking items
            foreach ($cartItems as $item) {
                if ($item->event) {
                    $booking->events()->attach($item->event_id);
                }
                if ($item->package) {
                    $booking->packages()->attach($item->package_id);
                }
            }

            // Apply promo code if exists
            if ($request->promo_code) {
                $promoCode = PromoCode::where('code', $request->promo_code)->first();
                if ($promoCode) {
                    $appliedPromo = new AppliedPromoCode();
                    $appliedPromo->user_id = Auth::id();
                    $appliedPromo->promo_id = $promoCode->promo_id;
                    $appliedPromo->booking_id = $booking->booking_id;
                    $appliedPromo->discount_applied = $request->discount_amount;
                    $appliedPromo->save();
                }
            }

            // Clear cart
            Cart::where('user_id', Auth::id())->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Payment successful',
                'booking_id' => $booking->booking_id
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