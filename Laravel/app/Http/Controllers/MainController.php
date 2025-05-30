<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Bookmark;
use App\Models\Cart;
use App\Models\Contact;
use App\Models\Package;
use App\Models\Booking;
use App\Models\Decorator;
use App\Models\Feedback;

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
        // Get events in random order
        $events = Event::with(['category', 'decorator'])
            ->withAvg('feedback as rating', 'rating')
            ->inRandomOrder() // This randomizes the order of events
            ->get();
        
        // Get categories for filter
        $categories = \App\Models\Category::all();
        
        // Get decorators for filter
        $decorators = Decorator::all();
        
        // Get min and max prices for price filter
        $minPrice = Event::min('price') ?: 0;
        $maxPrice = Event::max('price') ?: 10000;
        
        return view('events', compact('events', 'categories', 'decorators', 'minPrice', 'maxPrice'));
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

    public function decoratordetails($id)
    {
        $decorator = Decorator::findOrFail($id);
        
        // Get events for this decorator with limit
        $events = Event::where('decorator_id', $id)
            ->withCount(['feedback as rating_count'])
            ->withAvg('feedback as rating', 'rating')
            ->limit(3)
            ->get();
            
        // Get packages for this decorator with limit
        $packages = Package::where('decorator_id', $id)
            ->with('packageEvents.event')
            ->withCount(['feedback as rating_count'])
            ->withAvg('feedback as rating', 'rating')
            ->limit(3)
            ->get();
            
        // Get feedbacks for this decorator
        $feedbacks = Feedback::where('decorator_id', $id)
            ->with(['user', 'event', 'package'])
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
            
        // Count statistics
        $totalEvents = Event::where('decorator_id', $id)->count();
        $totalPackages = Package::where('decorator_id', $id)->count();
        
        // Count completed bookings by checking bookings for this decorator's events and packages
        $eventIds = Event::where('decorator_id', $id)->pluck('event_id')->toArray();
        $packageIds = Package::where('decorator_id', $id)->pluck('package_id')->toArray();
        
        $completedBookings = Booking::where(function($query) use ($eventIds, $packageIds) {
                if (!empty($eventIds)) {
                    $query->whereIn('event_id', $eventIds);
                }
            })
            ->orWhere(function($query) use ($packageIds) {
                if (!empty($packageIds)) {
                    $query->whereIn('package_id', $packageIds);
                }
            })
            ->where('status', 'completed')
            ->count();
            
        $totalFeedbacks = Feedback::where('decorator_id', $id)->count();
        
        return view('decoratordetails', compact(
            'decorator', 
            'events', 
            'packages', 
            'feedbacks',
            'totalEvents',
            'totalPackages',
            'completedBookings',
            'totalFeedbacks'
        ));
    }
}
