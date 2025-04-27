<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    /**
     * Display the user's orders/bookings.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id', $user->user_id)
            ->with(['event', 'package'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('orders', compact('bookings'));
    }
}
