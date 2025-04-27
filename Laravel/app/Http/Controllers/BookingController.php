<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\BookingCancellation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Cancel a booking and create a booking cancellation record
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,booking_id',
            'reason' => 'required|string|max:500',
        ]);
        
        DB::beginTransaction();
        
        try {
            $booking = Booking::findOrFail($request->booking_id);
            
            // Check if user owns this booking
            if ($booking->user_id != Auth::id()) {
                return redirect()->route('orders')
                    ->with('error', 'You do not have permission to cancel this booking.');
            }
            
            // Check if booking is in a cancellable state
            if (!in_array($booking->status, ['pending', 'accepted'])) {
                return redirect()->route('orders')
                    ->with('error', 'This booking cannot be cancelled.');
            }
            
            // Calculate refund amount (50%)
            $price = 0;
            if ($booking->event_id) {
                $price = $booking->event->price;
            } elseif ($booking->package_id) {
                $price = $booking->package->price;
            }
            $refundAmount = $price * 0.5;
            
            // Update booking status
            $booking->status = 'cancelled';
            $booking->save();
            
            // Create cancellation record
            $cancellation = new BookingCancellation();
            $cancellation->booking_id = $booking->booking_id;
            $cancellation->cancelled_by = 'user';
            $cancellation->reason = $request->reason;
            $cancellation->refund_amount = $refundAmount;
            $cancellation->save();
            
            DB::commit();
            
            return redirect()->route('orders')
                ->with('success', 'Your booking has been cancelled successfully. A refund of ₹' . number_format($refundAmount, 2) . ' will be processed shortly.');
                
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('orders')
                ->with('error', 'Something went wrong. Please try again.');
        }
    }
}
