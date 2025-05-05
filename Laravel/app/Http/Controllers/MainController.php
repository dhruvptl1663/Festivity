<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Bookmark;
use App\Models\Cart;
use App\Models\Contact;
use App\Models\Package;
use App\Models\Booking;

class MainController extends Controller
{
    //
    public function index()
    {
        // Get the 2 most booked events
        $popularEvents = Event::withCount('bookings')
            ->orderBy('bookings_count', 'desc')
            ->limit(2)
            ->get();
            
        // Get the 2 most booked packages
        $popularPackages = Package::withCount('bookings')
            ->orderBy('bookings_count', 'desc')
            ->limit(2)
            ->get();
            
        return view('index', compact('popularEvents', 'popularPackages'));
    }

    public function events()
    {
        return view('events');
    }

    public function packages()
    {
        return view('packages');
    }

    public function about()
    {
        return view('about');
    }

    public function contactus()
    {
        return view('contactus');
    }

    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/contact'), $imageName);
            $validated['image'] = 'images/contact/' . $imageName;
        }

        Contact::create($validated);

        return redirect()->route('contactus')->with('success', 'Your message has been sent successfully!');
    }

    public function login()
    {
        return view('login');
    }

    public function signup()
    {
        return view('signup');
    }

    public function profile()
    {
        return view('profile');
    }

   
    public function eventdetails($id)
    {
        $event = Event::findOrFail($id);
        $isBookmarked = auth()->check() 
            ? Bookmark::where('user_id', auth()->id())
                ->where('event_id', $id)
                ->exists()
            : false;

        $isInCart = auth()->check()
            ? Cart::where('user_id', auth()->id())
                ->where('event_id', $id)
                ->exists()
            : false;

        return view('eventdetails', compact('event', 'isBookmarked', 'isInCart'));
    }

    public function cart()
    {
        return view('cart');
    }

    public function info()
    {
        return view('info');
    }
}
