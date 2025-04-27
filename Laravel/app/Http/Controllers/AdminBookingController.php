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
        $bookings = Booking::with(['user', 'event.decorator', 'package.decorator', 'feedback'])->orderBy('created_at', 'desc')->get();
        $pendingCount = Booking::where('status', 'pending')->count();
        $confirmedCount = Booking::where('status', 'confirmed')->count();
        $completedCount = Booking::where('status', 'completed')->count();
        $cancelledCount = Booking::where('status', 'cancelled')->count();
        
        return view('Admin.bookings.index', compact('bookings', 'pendingCount', 'confirmedCount', 'completedCount', 'cancelledCount'));
    }

    /**
     * Display the specified booking details
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::with(['user', 'event.decorator', 'package.decorator', 'feedback'])->findOrFail($id);
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
        
        // Calculate 50% refund amount
        $refundAmount = $booking->final_amount * 0.5;
        
        // Update booking status
        $booking->status = 'cancelled';
        $booking->save();
        
        // Here you would integrate with payment gateway for refund processing
        // This is a placeholder for actual refund logic
        
        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking cancelled successfully. Refund of ₹' . number_format($refundAmount, 2) . ' will be processed.');
    }
}
