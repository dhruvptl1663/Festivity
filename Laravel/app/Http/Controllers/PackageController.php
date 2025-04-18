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
        
        return view('packagedetails', compact('package', 'isBookmarked'));
    }
}