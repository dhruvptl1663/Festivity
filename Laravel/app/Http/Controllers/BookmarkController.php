<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;
use App\Models\Event;
use App\Models\Package;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookmarkController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $bookmarks = Bookmark::where('user_id', $user_id)->get();
        
     
        $eventIds = $bookmarks->where('event_id', '!=', null)
            ->pluck('event_id')
            ->toArray();
        $events = Event::whereIn('event_id', $eventIds)->get();
        
        
        $packageIds = $bookmarks->where('package_id', '!=', null)
            ->pluck('package_id')
            ->toArray();
        $packages = Package::with('packageEvents.event')->whereIn('package_id', $packageIds)->get();
        
        return view('bookmarks', compact('bookmarks', 'events', 'packages'));
    }

    public function toggle(Request $request)
    {
        // Accept either event_id or package_id
        $request->validate([
            'event_id' => 'nullable|exists:events,event_id',
            'package_id' => 'nullable|exists:packages,package_id',
        ]);

        if (!$request->event_id && !$request->package_id) {
            return response()->json([
                'error' => 'Missing identifier',
                'message' => 'No event_id or package_id provided',
                'is_bookmarked' => false
            ], 400);
        }

        try {
            // Check if user is logged in
            if (!Auth::check()) {
                return response()->json([
                    'error' => 'Authentication required',
                    'message' => 'Please login to bookmark events',
                    'is_bookmarked' => false
                ], 401);
            }

            // Determine if it's an event or package bookmark
            if ($request->package_id) {
                // Package bookmark logic
                $bookmark = Bookmark::where('user_id', Auth::id())
                    ->where('package_id', $request->package_id)
                    ->whereNull('event_id')
                    ->first();

                if ($bookmark) {
                    Bookmark::where('bookmark_id', $bookmark->bookmark_id)->delete();
                    return response()->json([
                        'status' => 'removed',
                        'is_bookmarked' => false,
                        'message' => 'Bookmark removed successfully'
                    ]);
                }

                $bookmark = new Bookmark();
                $bookmark->user_id = Auth::id();
                $bookmark->package_id = $request->package_id;
                $bookmark->event_id = null;
                // Set decorator_id from the package
                $package = \App\Models\Package::find($request->package_id);
                $bookmark->decorator_id = $package ? $package->decorator_id : null;
                $bookmark->save();

                return response()->json([
                    'status' => 'added',
                    'is_bookmarked' => true,
                    'message' => 'Bookmark added successfully'
                ]);
            } else {
                // Event bookmark logic
                $bookmark = Bookmark::where('user_id', Auth::id())
                    ->where('event_id', $request->event_id)
                    ->first();

                if ($bookmark) {
                    Bookmark::where('bookmark_id', $bookmark->bookmark_id)
                        ->delete();
                    return response()->json([
                        'status' => 'removed',
                        'is_bookmarked' => false,
                        'message' => 'Bookmark removed successfully'
                    ]);
                }

                $bookmark = new Bookmark();
                $bookmark->user_id = Auth::id();
                $bookmark->event_id = $request->event_id;
                // Set decorator_id from the event
                $event = \App\Models\Event::find($request->event_id);
                $bookmark->decorator_id = $event ? $event->decorator_id : null;
                $bookmark->save();

                return response()->json([
                    'status' => 'added',
                    'is_bookmarked' => true,
                    'message' => 'Bookmark added successfully'
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to toggle bookmark',
                'message' => $e->getMessage(),
                'is_bookmarked' => false
            ], 500);
        }
    }
}