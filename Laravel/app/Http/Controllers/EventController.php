<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Feedback;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function index(Request $request)
    {
        $query = Event::query();

        // Apply sorting
        switch ($request->sort) {
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            default:
                $query->latest();
        }

        $events = $query->get()->map(function ($event) {
            $feedbackCount = Feedback::where('event_id', $event->event_id)->count();
            $event->reviews = $feedbackCount;
            return $event;
        });

        $categories = Category::all();
        return view('events', compact('events', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,category_id',
            'decorator_id' => 'required|exists:decorators,decorator_id',
            'is_live' => 'boolean',
            'price' => 'required|numeric',
            'rating' => 'nullable|numeric|min:0|max:5'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $imageName = str_replace('public/', '', $imagePath);
        } else {
            $imageName = null;
        }

        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
            'category_id' => $request->category_id,
            'decorator_id' => $request->decorator_id,
            'is_live' => $request->is_live ?? false,
            'price' => $request->price,
            'rating' => $request->rating ?? 0.00
        ]);

        return back()->with('success', 'Event created successfully!');
    }

    public function getEventsByCategory($categoryId)
    {
        $events = Event::with(['category', 'decorator'])
            ->where('category_id', $categoryId)
            ->get()
            ->map(function ($event) {
                return [
                    'title' => $event->title,
                    'description' => $event->description,
                    'image' => $event->image,
                    'price' => $event->price,
                    'rating' => $event->rating,
                    'category' => [
                        'category_name' => $event->category->category_name ?? 'N/A'
                    ],
                    'decorator' => [
                        'decorator_name' => $event->decorator->decorator_name ?? 'Unknown Decorator',
                        'decorator_icon' => $event->decorator->decorator_icon ?? ''
                    ]
                ];
            });
        return response()->json($events);
    }

    public function show($id)
    {
        $event = Event::with([
            'category', 
            'decorator', 
            'feedback' => function($query) {
                $query->with('user')->orderBy('created_at', 'desc')->select(['feedback_id', 'user_id', 'event_id', 'rating', 'comment', 'created_at']);
            }
        ])->findOrFail($id);
        $event->reviews = $event->reviews_count;
        $event->rating_count = $event->rating_count;
        return view('eventdetails', compact('event'));
    }

    
    // Admin methods
    public function adminIndex()
    {
        $events = Event::with(['category', 'decorator'])->get();
        return view('admin.events.index', compact('events'));
    }

    public function adminCreate()
    {
        $categories = Category::all();
        return view('admin.events.create', compact('categories'));
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,category_id',
            'decorator_id' => 'required|exists:decorators,decorator_id',
            'is_live' => 'boolean',
            'price' => 'required|numeric',
            'rating' => 'nullable|numeric|min:0|max:5'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $imageName = str_replace('public/', '', $imagePath);
        } else {
            $imageName = null;
        }

        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
            'category_id' => $request->category_id,
            'decorator_id' => $request->decorator_id,
            'is_live' => $request->is_live ?? false,
            'price' => $request->price,
            'rating' => $request->rating ?? 0.00
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully!');
    }

    public function adminEdit($id)
    {
        $event = Event::with('category')->findOrFail($id);
        $categories = Category::all();
        return view('admin.events.edit', compact('event', 'categories'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,category_id',
            'decorator_id' => 'required|exists:decorators,decorator_id',
            'is_live' => 'boolean',
            'price' => 'required|numeric',
            'rating' => 'nullable|numeric|min:0|max:5'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $imageName = str_replace('public/', '', $imagePath);
            $event->image = $imageName;
        }

        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'decorator_id' => $request->decorator_id,
            'is_live' => $request->is_live ?? false,
            'price' => $request->price,
            'rating' => $request->rating ?? $event->rating
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully!');
    }

    // Status management methods
    public function approve(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $event->is_live = true;
        $event->save();

        return redirect()->back()->with('success', 'Event approved successfully!');
    }

    public function decline(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $event->is_live = false;
        $event->save();

        return redirect()->back()->with('success', 'Event declined successfully!');
    }

}
