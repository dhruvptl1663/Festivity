<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function index()
    {
        $events = Event::all();
        return view('events', compact('events'));
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
}
