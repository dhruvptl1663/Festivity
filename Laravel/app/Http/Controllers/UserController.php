<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        return view('profile');
    }

    public function orders()
    {
        $bookings = Auth::user()->bookings()->with(['event','package'])->paginate(10);
        return view('orders', compact('bookings'));
    }
}
