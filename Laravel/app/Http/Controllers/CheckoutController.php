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
        Log::info('CheckoutController@submit called', ['user_id' => Auth::id(), 'input' => $request->all()]);
        
        // Check if authenticated
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'error' => 'User not authenticated'], 401);
            }
            return redirect()->route('login')->with('error', 'Please login to continue');
        }
        
        $user_id = Auth::id();
        
        // Validate the request
        try {
            $request->validate([
                'promo_code' => 'nullable|string|max:255',
                'date_time_selections' => 'required|array',
                'date_time_selections.*.id' => 'required',
                'date_time_selections.*.type' => 'required|in:event,package',
                'date_time_selections.*.datetime' => 'required|date_format:Y-m-d H:i'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed', ['errors' => $e->errors()]);
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'error' => 'Validation failed', 'details' => $e->errors()], 422);
            }
            return redirect()->back()->with('error', 'Validation failed');
        }

        // Get cart items
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

        DB::beginTransaction();
        try {
            $totalDiscount = 0;
            $totalOriginalAmount = 0;
            $totalFinalAmount = 0;
            
            // Apply promo code if available
            $promo_code = $request->input('promo_code');
            $promo = null;
            
            Log::info('Processing promo code', ['promo_code' => $promo_code]);
            
            if ($promo_code) {
                try {
                    $promo = PromoCode::where('code', $promo_code)->first();
                    Log::info('Promo code lookup result', ['found' => ($promo ? 'yes' : 'no')]);
                    
                    if ($promo) {
                        Log::info('Promo code details', [
                            'promo_id' => $promo->promo_id,
                            'code' => $promo->code,
                            'discount_percentage' => $promo->discount_percentage,
                            'expiry_date' => $promo->expiry_date
                        ]);
                        
                        $isValid = $promo->isValid();
                        Log::info('Promo code validity check', ['is_valid' => $isValid]);
                        
                        if (!$isValid) {
                            if ($request->expectsJson()) {
                                return response()->json(['success' => false, 'error' => 'Expired promo code'], 400);
                            }
                            return redirect()->back()->with('error', 'Expired promo code');
                        }
                    } else {
                        if ($request->expectsJson()) {
                            return response()->json(['success' => false, 'error' => 'Invalid promo code'], 400);
                        }
                        return redirect()->back()->with('error', 'Invalid promo code');
                    }
                } catch (\Exception $e) {
                    Log::error('Error processing promo code', ['error' => $e->getMessage()]);
                    if ($request->expectsJson()) {
                        return response()->json(['success' => false, 'error' => 'Error processing promo code: ' . $e->getMessage()], 400);
                    }
                    return redirect()->back()->with('error', 'Error processing promo code');
                }
            }

            // Get date/time selections from the request
            $dateTimeSelections = $request->input('date_time_selections');
            
            // Create a lookup map for easier access
            $dateTimeMap = [];
            foreach ($dateTimeSelections as $selection) {
                $key = $selection['type'] . '_' . $selection['id'];
                $dateTimeMap[$key] = $selection['datetime'];
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
                
                // Calculate discount if promo code exists
                if ($promo) {
                    $itemDiscount = $promo->calculateDiscount($originalPrice);
                    $finalPrice -= $itemDiscount;
                }

                $totalOriginalAmount += $originalPrice;
                $totalDiscount += $itemDiscount;
                $totalFinalAmount += $finalPrice;

                // Create booking - only using fields that exist in the bookings table
                $status = 'pending'; // Using a value we know is in the enum
                
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
                
                // Use direct DB insertion to avoid any model-related issues
                $booking_id = DB::table('bookings')->insertGetId([
                    'user_id' => $user_id,
                    'event_id' => $item->event_id,
                    'package_id' => $item->package_id,
                    'event_datetime' => $eventDatetime,
                    'advance_paid' => $finalPrice,
                    'status' => $status,
                    'created_at' => now(),
                ]);
                
                Log::info('Booking created using DB::table', ['booking_id' => $booking_id]);

                // Apply promo code if exists
                if ($promo) {
                    DB::table('applied_promo_codes')->insert([
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
                DB::table('admin_commissions')->insert([
                    'booking_id' => $booking_id,
                    'amount' => $commissionAmount,
                    'created_at' => now(),
                ]);
                
                Log::info('Admin commission created', ['booking_id' => $booking_id]);
            }

            // Clear cart after successful booking
            Cart::where('user_id', $user_id)->delete();
            Log::info('Cart cleared for user', ['user_id' => $user_id]);

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Booking successful!',
                    'total_amount' => $totalFinalAmount,
                    'discount_amount' => $totalDiscount,
                ]);
            }
            return redirect()->route('congratulations')->with([
                'success' => true,
                'message' => 'Booking successful!',
                'total_amount' => $totalFinalAmount,
                'discount_amount' => $totalDiscount,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout error', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'error' => 'Failed to process booking. Please try again.', 'details' => $e->getMessage()], 500);
            }
            return redirect()->back()->with('error', 'Failed to process booking. Please try again.');
        }
    }

    public function congratulations()
    {
        return view('checkout.congratulations');
    }
}
