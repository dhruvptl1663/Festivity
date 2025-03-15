<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
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

        $events = $query->get();
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
}
