<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $packages = Package::with(['decorator', 'packageEvents.event.category'])
            ->when($request->category_id, function ($query) use ($request) {
                return $query->whereHas('packageEvents.event', function ($query) use ($request) {
                    $query->where('category_id', $request->category_id);
                });
            })
            ->when($request->event_count, function ($query) use ($request) {
                $eventCount = (int) $request->event_count;
                if ($eventCount === 5) {
                    return $query->whereHas('packageEvents', function ($query) {
                        $query->havingRaw('COUNT(*) >= 5');
                    });
                }
                return $query->whereHas('packageEvents', function ($query) use ($eventCount) {
                    $query->havingRaw('COUNT(*) = ?', [$eventCount]);
                });
            })
            ->when($request->sort, function ($query) use ($request) {
                switch ($request->sort) {
                    case 'price_high':
                        return $query->orderBy('price', 'desc');
                    case 'price_low':
                        return $query->orderBy('price', 'asc');
                    case 'newest':
                        return $query->latest();
                    case 'rating':
                        return $query->orderBy('rating', 'desc');
                    default:
                        return $query->latest();
                }
            })
            ->get();

        $categories = Category::all();

        $eventCounts = [
            ['id' => 2, 'name' => '2 Events'],
            ['id' => 3, 'name' => '3 Events'],
            ['id' => 4, 'name' => '4 Events'],
            ['id' => 5, 'name' => '5+ Events']
        ];

        return view('packages', compact('packages', 'categories', 'eventCounts'));
    }

    public function show(Package $package)
    {
        // Load all necessary relationships including feedback
        $package->load([
            'decorator', 
            'packageEvents.event.category',
            'feedback'
        ]);
        
        // Check if the package is bookmarked by the current user
        $isBookmarked = false;
        if (auth()->check()) {
            $isBookmarked = auth()->user()->bookmarks()->where('package_id', $package->package_id)->exists();
        }

        // Check if the package is in cart
        $isInCart = false;
        if (auth()->check()) {
            $isInCart = \App\Models\Cart::where('user_id', auth()->id())
                ->where('package_id', $package->package_id)
                ->exists();
        }
        
        return view('packagedetails', compact('package', 'isBookmarked', 'isInCart'));
    }

    public function adminIndex()
    {
        $packages = Package::with(['decorator', 'packageEvents.event.category'])->get();
        return view('admin.packages.index', compact('packages'));
    }

    public function adminCreate()
    {
        $events = Event::with('category')->get();
        $decorators = \App\Models\Decorator::all();
        return view('admin.packages.create', compact('events', 'decorators'));
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'decorator_id' => 'required|exists:decorators,decorator_id',
            'price' => 'required|numeric',
            'rating' => 'nullable|numeric|min:0|max:5',
            'event_ids' => 'required|array',
            'event_ids.*' => 'exists:events,event_id'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $imageName = str_replace('public/', '', $imagePath);
        } else {
            $imageName = null;
        }

        $package = Package::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
            'decorator_id' => $request->decorator_id,
            'price' => $request->price,
            'rating' => $request->rating ?? 0.00
        ]);

        // Attach events to the package
        $package->packageEvents()->attach($request->event_ids);

        return redirect()->route('admin.packages.index')->with('success', 'Package created successfully!');
    }

    public function adminEdit($id)
    {
        $package = Package::with(['packageEvents.event.category'])->findOrFail($id);
        $events = Event::with('category')->get();
        $decorators = \App\Models\Decorator::all();
        return view('admin.packages.edit', compact('package', 'events', 'decorators'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $package = Package::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'decorator_id' => 'required|exists:decorators,decorator_id',
            'price' => 'required|numeric',
            'rating' => 'nullable|numeric|min:0|max:5',
            'event_ids' => 'required|array',
            'event_ids.*' => 'exists:events,event_id'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $imageName = str_replace('public/', '', $imagePath);
            $package->image = $imageName;
        }

        $package->update([
            'title' => $request->title,
            'description' => $request->description,
            'decorator_id' => $request->decorator_id,
            'price' => $request->price,
            'rating' => $request->rating ?? $package->rating
        ]);

        // Sync events with the package
        $package->packageEvents()->sync($request->event_ids);

        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully!');
    }

    public function adminDestroy($id)
    {
        $package = Package::findOrFail($id);
        $package->packageEvents()->detach();
        $package->delete();
        return redirect()->route('admin.packages.index')->with('success', 'Package deleted successfully!');
    }
}