<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookmarkController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,event_id'
        ]);

        try {
            // Check if user is logged in
            if (!Auth::check()) {
                return response()->json([
                    'error' => 'Authentication required',
                    'message' => 'Please login to bookmark events',
                    'is_bookmarked' => false
                ], 401);
            }

            // First find the bookmark
            $bookmark = Bookmark::where('user_id', Auth::id())
                ->where('event_id', $request->event_id)
                ->first();

            if ($bookmark) {
                // Delete using the bookmark_id
                Bookmark::where('bookmark_id', $bookmark->bookmark_id)
                    ->delete();
                
                return response()->json([
                    'status' => 'removed',
                    'is_bookmarked' => false,
                    'message' => 'Bookmark removed successfully'
                ]);
            }

            // Create new bookmark
            $bookmark = new Bookmark();
            $bookmark->user_id = Auth::id();
            $bookmark->event_id = $request->event_id;
            $bookmark->save();

            return response()->json([
                'status' => 'added',
                'is_bookmarked' => true,
                'message' => 'Bookmark added successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to toggle bookmark',
                'message' => $e->getMessage(),
                'is_bookmarked' => false
            ], 500);
        }
    }
}