<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->latest()->paginate(10);
        return view('notifications', compact('notifications'));
    }

    public function show(Notification $notification)
    {
        // Load the user relationship
        $notification->load('user');
        
        // Mark as read if not already
        if (!$notification->is_read) {
            $notification->update(['is_read' => true]);
        }
        
        return view('notifications.show', compact('notification'));
    }

    public function markAsRead(Notification $notification)
    {
        $notification->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return response()->json(['success' => true]);
    }
}