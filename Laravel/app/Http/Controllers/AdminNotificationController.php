<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class AdminNotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::with('user')->latest()->get();
        return view('Admin.notifications.index', compact('notifications'));
    }

    public function create()
    {
        $users = User::all();
        return view('Admin.notifications.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'title' => 'required|string|max:255',
            'message' => 'nullable|string',
        ]);

        Notification::create($validated);

        return redirect()->route('admin.notifications.index')
            ->with('success', 'Notification sent successfully');
    }

    public function show(Notification $notification)
    {
        // Load the user relationship
        $notification->load('user');
        
        // Update the read status
        $notification->update(['is_read' => true]);
        
        return view('Admin.notifications.show', compact('notification'));
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return redirect()->route('admin.notifications.index')
            ->with('error', 'Notification deleted successfully');
    }
}