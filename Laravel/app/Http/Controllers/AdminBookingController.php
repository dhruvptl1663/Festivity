<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Event;
use App\Models\Package;
use App\Models\User;
use App\Models\Feedback;

class AdminBookingController extends Controller
{
    /**
     * Display a listing of all bookings
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::with(['user', 'event.decorator', 'package.decorator', 'feedback', 'event.category'])->orderBy('created_at', 'desc')->get();
        $pendingCount = Booking::where('status', 'pending')->count();
        $acceptedCount = Booking::where('status', 'accepted')->count();
        $rejectedCount = Booking::where('status', 'rejected')->count();
        $completedCount = Booking::where('status', 'completed')->count();
        $cancelledCount = Booking::where('status', 'cancelled')->count();
        
        return view('Admin.bookings.index', compact('bookings', 'pendingCount', 'acceptedCount', 'rejectedCount', 'completedCount', 'cancelledCount'));
    }

    /**
     * Display the specified booking details
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::with([
            'user', 
            'event' => function($query) {
                $query->with(['decorator', 'category']);
            },
            'package' => function($query) {
                $query->with(['decorator']);
            },
            'feedback'
        ])->findOrFail($id);
        
        // Debug information - you can remove this after confirming it works
        \Log::info('Booking details:', [
            'booking' => $booking->toArray(),
            'event' => $booking->event ? $booking->event->toArray() : null,
            'package' => $booking->package ? $booking->package->toArray() : null,
            'user' => $booking->user ? $booking->user->toArray() : null
        ]);
        
        return view('Admin.bookings.show', compact('booking'));
    }

    /**
     * Update the booking status
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected,completed,cancelled',
        ]);
        
        $booking->status = $request->status;
        $booking->save();
        
        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking status updated successfully');
    }
    
    /**
     * Handle booking cancellation with refund policy
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        
        // Set default refund amount since we don't have the actual column
        $refundAmount = 0;
        
        // Update booking status
        $booking->status = 'cancelled';
        $booking->save();
        
        // Here you would integrate with payment gateway for refund processing
        // This is a placeholder for actual refund logic
        
        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking cancelled successfully. Refund will be processed if applicable.');
    }
}
