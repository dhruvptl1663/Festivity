<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Decorator;
use App\Models\Event;
use App\Models\Package;
use App\Models\Booking;
use App\Models\Feedback;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DecoratorController extends Controller
{
    public function dashboard()
    {
        $decorator = Auth::guard('decorator')->user();
        $decorator_id = $decorator->decorator_id;
        
        // Get stats for the dashboard
        $totalEvents = Event::where('decorator_id', $decorator_id)->count();
        $totalPackages = Package::where('decorator_id', $decorator_id)->count();
        
        $totalBookings = Booking::whereHas('event', function($q) use ($decorator_id) {
                $q->where('decorator_id', $decorator_id);
            })
            ->orWhereHas('package', function($q) use ($decorator_id) {
                $q->where('decorator_id', $decorator_id);
            })
            ->count();
            
        $pendingBookings = Booking::where('status', 'pending')
            ->whereHas('event', function($q) use ($decorator_id) {
                $q->where('decorator_id', $decorator_id);
            })
            ->orWhere(function($query) use ($decorator_id) {
                $query->where('status', 'pending')
                    ->whereHas('package', function($q) use ($decorator_id) {
                        $q->where('decorator_id', $decorator_id);
                    });
            })
            ->count();
            
        $completedBookings = Booking::where('status', 'completed')
            ->whereHas('event', function($q) use ($decorator_id) {
                $q->where('decorator_id', $decorator_id);
            })
            ->orWhere(function($query) use ($decorator_id) {
                $query->where('status', 'completed')
                    ->whereHas('package', function($q) use ($decorator_id) {
                        $q->where('decorator_id', $decorator_id);
                    });
            })
            ->count();
            
        $cancelledBookings = Booking::where('status', 'cancelled')
            ->whereHas('event', function($q) use ($decorator_id) {
                $q->where('decorator_id', $decorator_id);
            })
            ->orWhere(function($query) use ($decorator_id) {
                $query->where('status', 'cancelled')
                    ->whereHas('package', function($q) use ($decorator_id) {
                        $q->where('decorator_id', $decorator_id);
                    });
            })
            ->count();
            
        // Calculate total earnings
        $totalEarnings = DB::table('bookings')
            ->join('events', 'bookings.event_id', '=', 'events.event_id')
            ->where('events.decorator_id', $decorator_id)
            ->where('bookings.status', 'completed')
            ->sum('advance_paid');
            
        $totalEarnings += DB::table('bookings')
            ->join('packages', 'bookings.package_id', '=', 'packages.package_id')
            ->where('packages.decorator_id', $decorator_id)
            ->where('bookings.status', 'completed')
            ->sum('advance_paid');
            
        // Get recent bookings
        $recentBookings = Booking::whereHas('event', function($q) use ($decorator_id) {
                $q->where('decorator_id', $decorator_id);
            })
            ->orWhereHas('package', function($q) use ($decorator_id) {
                $q->where('decorator_id', $decorator_id);
            })
            ->with(['user', 'event', 'package'])
            ->latest()
            ->take(5)
            ->get();
        
        // Get recent feedback
        $recentFeedback = Feedback::where('decorator_id', $decorator_id)
            ->with('user')
            ->latest()
            ->take(5)
            ->get();
            
        return view('Decorator.index', compact(
            'totalEvents', 
            'totalPackages', 
            'totalBookings', 
            'pendingBookings', 
            'completedBookings', 
            'cancelledBookings',
            'totalEarnings',
            'recentBookings',
            'recentFeedback'
        ));
    }
    
    public function profile()
    {
        $decorator = Auth::guard('decorator')->user();
        return view('Decorator.profile', compact('decorator'));
    }
    
    public function updateProfile(Request $request)
    {
        try {
            $decorator = Auth::guard('decorator')->user();
            
            // Create a validation array with only the fields that are present in the request
            $validationRules = [];
            $updates = [];
            
            // Only validate the fields that are being updated
            if ($request->has('decorator_name')) {
                $validationRules['decorator_name'] = 'required|string|max:100';
                $updates['decorator_name'] = $request->decorator_name;
            }
            
            if ($request->has('email')) {
                $validationRules['email'] = 'required|email|max:100|unique:decorators,email,' . $decorator->decorator_id . ',decorator_id';
                $updates['email'] = $request->email;
            }
            
            if ($request->hasFile('decorator_icon')) {
                $validationRules['decorator_icon'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
            } else {
                // If no new icon is uploaded, preserve the existing one
                $updates['decorator_icon'] = $decorator->decorator_icon;
            }
            
            if ($request->has('availability')) {
                $validationRules['availability'] = 'boolean';
                $updates['availability'] = $request->boolean('availability');
            }
            
            // Separate password validation to handle it properly
            $passwordUpdated = false;
            if ($request->filled('password')) {
                // Only validate if both password and confirmation are provided
                if ($request->filled('password_confirmation')) {
                    // Both fields are present, validate them
                    if ($request->password !== $request->password_confirmation) {
                        return redirect()->back()
                            ->withInput()
                            ->withErrors(['password' => 'The password confirmation does not match.']);
                    }
                    
                    if (strlen($request->password) < 6) {
                        return redirect()->back()
                            ->withInput()
                            ->withErrors(['password' => 'The password must be at least 6 characters.']);
                    }
                    
                    $passwordUpdated = true;
                } else {
                    // Password provided but no confirmation
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['password_confirmation' => 'The password confirmation field is required.']);
                }
            }
            
            // Validate the request for other fields
            $request->validate($validationRules);
            
            // Apply the updates
            foreach ($updates as $field => $value) {
                $decorator->$field = $value;
            }
            
            // Handle icon upload
            if ($request->hasFile('decorator_icon')) {
                try {
                    $file = $request->file('decorator_icon');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    
                    // Create the directory if it doesn't exist
                    $destinationPath = public_path('/images/decorators');
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0755, true);
                    }
                    
                    // Move the file to the public directory (not storage)
                    $file->move($destinationPath, $filename);
                    
                    // Store the relative path in the database
                    $decorator->decorator_icon = 'images/decorators/' . $filename;
                    
                } catch (\Exception $e) {
                    \Log::error('File upload error: ' . $e->getMessage());
                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'Failed to upload profile icon: ' . $e->getMessage());
                }
            }
            
            // Handle password update
            if ($passwordUpdated) {
                $decorator->password = Hash::make($request->password);
            }
            
            // Save changes
            $decorator->save();
            
            return redirect()->route('decorator.profile')
                ->with('success', 'Profile updated successfully');
            
        } catch (\Exception $e) {
            \Log::error('Profile update error: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update profile: ' . $e->getMessage());
        }
    }
    
    // Event management methods
    public function events()
    {
        $decorator = Auth::guard('decorator')->user();
        $events = Event::where('decorator_id', $decorator->decorator_id)
            ->with('category')
            ->latest()
            ->paginate(10);
            
        return view('Decorator.Events.index', compact('events'));
    }
    
    public function createEvent()
    {
        $categories = Category::all();
        return view('Decorator.Events.create', compact('categories'));
    }
    
    public function storeEvent(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,category_id',
            'price' => 'required|numeric|min:0',
        ]);
        
        $decorator = Auth::guard('decorator')->user();
        
        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->category_id = $request->category_id;
        $event->decorator_id = $decorator->decorator_id;
        $event->price = $request->price;
        $event->is_live = 0; // Default to not live
        $event->rating = 0; // Default rating
        
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
            
            // Store the image in storage/app/public/images/events directory
            // which will be accessible via the public/storage symbolic link
            $path = $imageFile->storeAs('images/events', $imageName, 'public');
            
            // Store the path as 'images/events/filename.ext'
            $event->image = $path;
        }
        
        $event->save();
        
        return redirect()->route('decorator.events')->with('success', 'Event created successfully and pending approval');
    }
    
    public function editEvent($event_id)
    {
        $decorator = Auth::guard('decorator')->user();
        $event = Event::where('event_id', $event_id)
            ->where('decorator_id', $decorator->decorator_id)
            ->firstOrFail();
            
        $categories = Category::all();
        
        return view('Decorator.Events.edit', compact('event', 'categories'));
    }
    
    public function updateEvent(Request $request, $event_id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,category_id',
            'price' => 'required|numeric|min:0',
        ]);
        
        $decorator = Auth::guard('decorator')->user();
        $event = Event::where('event_id', $event_id)
            ->where('decorator_id', $decorator->decorator_id)
            ->firstOrFail();
            
        $event->title = $request->title;
        $event->description = $request->description;
        $event->category_id = $request->category_id;
        $event->price = $request->price;
        $event->is_live = 0; // Reset to not live upon update
        
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            
            $imageFile = $request->file('image');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
            
            // Store the image in storage/app/public/images/events directory
            // which will be accessible via the public/storage symbolic link
            $path = $imageFile->storeAs('images/events', $imageName, 'public');
            
            // Store the path as 'images/events/filename.ext'
            $event->image = $path;
        }
        
        $event->save();
        
        return redirect()->route('decorator.events')->with('success', 'Event updated successfully and pending approval');
    }
    
    public function destroyEvent($event_id)
    {
        $decorator = Auth::guard('decorator')->user();
        $event = Event::where('event_id', $event_id)
            ->where('decorator_id', $decorator->decorator_id)
            ->firstOrFail();
            
        // Check if event has any bookings
        $hasBookings = Booking::where('event_id', $event_id)->exists();
        
        if ($hasBookings) {
            return redirect()->route('decorator.events')->with('error', 'Cannot delete event with active bookings');
        }
        
        // Delete image if exists
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }
        
        $event->delete();
        
        return redirect()->route('decorator.events')->with('success', 'Event deleted successfully');
    }
    
    // Package management methods
    public function packages()
    {
        $decorator = Auth::guard('decorator')->user();
        $packages = Package::where('decorator_id', $decorator->decorator_id)
            ->latest()
            ->paginate(10);
            
        return view('Decorator.Packages.index', compact('packages'));
    }
    
    public function createPackage()
    {
        $decorator = Auth::guard('decorator')->user();
        $events = Event::where('decorator_id', $decorator->decorator_id)
            ->where('is_live', 1) // Only include live events
            ->with('category') // Eager load the category relationship
            ->orderBy('created_at', 'desc') // Order by newest first
            ->get();
        return view('Decorator.Packages.create', compact('events'));
    }
    
    public function storePackage(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'events' => 'nullable|array',
            'events.*' => 'exists:events,event_id',
        ]);
        
        $decorator = Auth::guard('decorator')->user();
        
        $package = new Package();
        $package->title = $request->title;
        $package->description = $request->description;
        $package->decorator_id = $decorator->decorator_id;
        $package->price = $request->price;
        $package->is_live = 0; // Default to not live
        $package->rating = 0; // Default rating
        $package->status = 'pending'; // Default status
        
        $package->save();
        
        // Associate events with package if selected
        if ($request->has('events')) {
            foreach ($request->events as $event_id) {
                DB::table('package_events')->insert([
                    'package_id' => $package->package_id,
                    'event_id' => $event_id
                ]);
            }
        }
        
        return redirect()->route('decorator.packages')->with('success', 'Package created successfully and pending approval');
    }
    
    public function editPackage($package_id)
    {
        $decorator = Auth::guard('decorator')->user();
        $package = Package::where('package_id', $package_id)
            ->where('decorator_id', $decorator->decorator_id)
            ->firstOrFail();
            
        $events = Event::where('decorator_id', $decorator->decorator_id)->get();
        
        // Get associated events
        $packageEvents = DB::table('package_events')
            ->where('package_id', $package_id)
            ->pluck('event_id')
            ->toArray();
            
        return view('Decorator.Packages.edit', compact('package', 'events', 'packageEvents'));
    }
    
    public function updatePackage(Request $request, $package_id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'events' => 'nullable|array',
            'events.*' => 'exists:events,event_id',
        ]);
        
        $decorator = Auth::guard('decorator')->user();
        $package = Package::where('package_id', $package_id)
            ->where('decorator_id', $decorator->decorator_id)
            ->firstOrFail();
            
        $package->title = $request->title;
        $package->description = $request->description;
        $package->price = $request->price;
        $package->is_live = 0; // Reset to not live upon update
        $package->status = 'pending'; // Reset to pending upon update
        
        $package->save();
        
        // Update package events
        DB::table('package_events')->where('package_id', $package_id)->delete();
        
        if ($request->has('events')) {
            foreach ($request->events as $event_id) {
                DB::table('package_events')->insert([
                    'package_id' => $package->package_id,
                    'event_id' => $event_id
                ]);
            }
        }
        
        return redirect()->route('decorator.packages')->with('success', 'Package updated successfully and pending approval');
    }
    
    public function destroyPackage($package_id)
    {
        $decorator = Auth::guard('decorator')->user();
        $package = Package::where('package_id', $package_id)
            ->where('decorator_id', $decorator->decorator_id)
            ->firstOrFail();
            
        // Check if package has any bookings
        $hasBookings = Booking::where('package_id', $package_id)->exists();
        
        if ($hasBookings) {
            return redirect()->route('decorator.packages')->with('error', 'Cannot delete package with active bookings');
        }
        
        // Delete package events associations
        DB::table('package_events')->where('package_id', $package_id)->delete();
        
        $package->delete();
        
        return redirect()->route('decorator.packages')->with('success', 'Package deleted successfully');
    }
    
    // Booking management methods
    public function bookings()
    {
        $decorator = Auth::guard('decorator')->user();
        $decorator_id = $decorator->decorator_id;
        
        // Get booking counts by status
        $pendingCount = Booking::where('status', 'pending')
            ->where(function($query) use ($decorator_id) {
                $query->whereHas('event', function($q) use ($decorator_id) {
                    $q->where('decorator_id', $decorator_id);
                })
                ->orWhereHas('package', function($q) use ($decorator_id) {
                    $q->where('decorator_id', $decorator_id);
                });
            })
            ->count();
            
        $acceptedCount = Booking::where('status', 'accepted')
            ->where(function($query) use ($decorator_id) {
                $query->whereHas('event', function($q) use ($decorator_id) {
                    $q->where('decorator_id', $decorator_id);
                })
                ->orWhereHas('package', function($q) use ($decorator_id) {
                    $q->where('decorator_id', $decorator_id);
                });
            })
            ->count();
            
        $rejectedCount = Booking::where('status', 'rejected')
            ->where(function($query) use ($decorator_id) {
                $query->whereHas('event', function($q) use ($decorator_id) {
                    $q->where('decorator_id', $decorator_id);
                })
                ->orWhereHas('package', function($q) use ($decorator_id) {
                    $q->where('decorator_id', $decorator_id);
                });
            })
            ->count();
            
        $completedCount = Booking::where('status', 'completed')
            ->where(function($query) use ($decorator_id) {
                $query->whereHas('event', function($q) use ($decorator_id) {
                    $q->where('decorator_id', $decorator_id);
                })
                ->orWhereHas('package', function($q) use ($decorator_id) {
                    $q->where('decorator_id', $decorator_id);
                });
            })
            ->count();
            
        $cancelledCount = Booking::where('status', 'cancelled')
            ->where(function($query) use ($decorator_id) {
                $query->whereHas('event', function($q) use ($decorator_id) {
                    $q->where('decorator_id', $decorator_id);
                })
                ->orWhereHas('package', function($q) use ($decorator_id) {
                    $q->where('decorator_id', $decorator_id);
                });
            })
            ->count();
        
        $bookings = Booking::where(function($query) use ($decorator_id) {
                $query->whereHas('event', function($q) use ($decorator_id) {
                    $q->where('decorator_id', $decorator_id);
                });
            })
            ->orWhere(function($query) use ($decorator_id) {
                $query->whereHas('package', function($q) use ($decorator_id) {
                    $q->where('decorator_id', $decorator_id);
                });
            })
            ->with(['user', 'event', 'package'])
            ->latest()
            ->paginate(10);
            
        return view('Decorator.Bookings.index', compact('bookings', 'pendingCount', 'acceptedCount', 'rejectedCount', 'completedCount', 'cancelledCount'));
    }
    
    public function showBooking($booking_id)
    {
        $decorator = Auth::guard('decorator')->user();
        $decorator_id = $decorator->decorator_id;
        
        $booking = Booking::where('booking_id', $booking_id)
            ->where(function($query) use ($decorator_id) {
                $query->whereHas('event', function($q) use ($decorator_id) {
                    $q->where('decorator_id', $decorator_id);
                })
                ->orWhereHas('package', function($q) use ($decorator_id) {
                    $q->where('decorator_id', $decorator_id);
                });
            })
            ->with(['user', 'event', 'package'])
            ->firstOrFail();
            
        // Get feedback for this booking if exists
        $feedback = Feedback::where('booking_id', $booking_id)->first();
            
        return view('Decorator.Bookings.show', compact('booking', 'feedback'));
    }
    
    public function updateBookingStatus(Request $request, $booking_id)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected,completed,cancelled',
        ]);
        
        $decorator = Auth::guard('decorator')->user();
        $decorator_id = $decorator->decorator_id;
        
        $booking = Booking::where('booking_id', $booking_id)
            ->where(function($query) use ($decorator_id) {
                $query->whereHas('event', function($q) use ($decorator_id) {
                    $q->where('decorator_id', $decorator_id);
                })
                ->orWhereHas('package', function($q) use ($decorator_id) {
                    $q->where('decorator_id', $decorator_id);
                });
            })
            ->firstOrFail();
        
        $oldStatus = $booking->status;
        $booking->status = $request->status;
        
        // If status changed to completed, mark it as completed
        if ($request->status == 'completed') {
            $booking->is_completed = 1;
        }
        
        $booking->save();
        
        // If cancelling the booking, create a cancellation record
        if ($request->status == 'cancelled' && $oldStatus != 'cancelled') {
            DB::table('booking_cancellations')->insert([
                'booking_id' => $booking_id,
                'cancelled_by' => 'decorator',
                'reason' => $request->get('reason', 'Cancelled by decorator'),
                'refund_amount' => $booking->advance_paid * 0.5, // 50% refund policy
                'cancelled_at' => now()
            ]);
        }
        
        return redirect()->route('decorator.bookings.show', $booking_id)
            ->with('success', 'Booking status updated successfully');
    }
    
    // Feedback methods
    public function feedbacks()
    {
        $decorator = Auth::guard('decorator')->user();
        $feedbacks = Feedback::where('decorator_id', $decorator->decorator_id)
            ->with(['user', 'event', 'package', 'booking'])
            ->latest()
            ->paginate(10);
            
        return view('Decorator.Feedbacks.index', compact('feedbacks'));
    }
}