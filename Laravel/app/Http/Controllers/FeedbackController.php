<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Event;
use App\Models\Package;
use App\Models\Decorator;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{
    /**
     * Store a newly created feedback in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,booking_id',
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        DB::beginTransaction();
        
        try {
            // Get the booking to ensure we have the right relationships
            $booking = Booking::findOrFail($request->booking_id);
            
            // Check if user owns this booking
            if ($booking->user_id != Auth::id()) {
                return redirect()->route('orders')
                    ->with('error', 'You do not have permission to leave feedback for this booking.');
            }
            
            // Check if booking is completed
            if ($booking->status != 'completed') {
                return redirect()->route('orders')
                    ->with('error', 'You can only provide feedback for completed bookings.');
            }
            
            // Check if feedback already exists
            if ($booking->hasFeedback()) {
                return redirect()->route('orders')
                    ->with('error', 'You have already provided feedback for this booking.');
            }
            
            // Create the feedback
            $feedback = new Feedback();
            $feedback->user_id = Auth::user()->user_id;
            $feedback->booking_id = $booking->booking_id;
            $feedback->rating = $request->rating;
            $feedback->comment = $request->comment;
            
            // Set the related entities based on what was booked
            if ($booking->event_id) {
                $feedback->event_id = $booking->event_id;
            }
            
            if ($booking->package_id) {
                $feedback->package_id = $booking->package_id;
            }
            
            // Get decorator_id from the event or package
            if ($booking->event_id && $booking->event && $booking->event->decorator_id) {
                $feedback->decorator_id = $booking->event->decorator_id;
            } elseif ($booking->package_id && $booking->package && $booking->package->decorator_id) {
                $feedback->decorator_id = $booking->package->decorator_id;
            }
            
            $feedback->save();
            
            // Update ratings after saving feedback
            if ($feedback->event_id) {
                $this->updateEventRating($feedback->event_id);
            }
            
            if ($feedback->package_id) {
                $this->updatePackageRating($feedback->package_id);
            }
            
            if ($feedback->decorator_id) {
                $this->updateDecoratorRating($feedback->decorator_id);
            }
            
            DB::commit();
            
            return redirect()->route('orders')->with('success', 'Thank you for your feedback!');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Feedback submission error: ' . $e->getMessage());
            return redirect()->route('orders')->with('error', 'Something went wrong. Please try again.');
        }
    }
    
    /**
     * Update the average rating for an event
     *
     * @param int $eventId
     * @return void
     */
    private function updateEventRating($eventId)
    {
        try {
            $event = Event::find($eventId);
            if (!$event) {
                Log::warning('Attempted to update rating for non-existent event ID: ' . $eventId);
                return;
            }
            
            $avgRating = Feedback::where('event_id', $eventId)->avg('rating') ?: 0;
            $event->rating = round($avgRating, 1); 
            $event->save();
            
            // If event has a decorator, update decorator rating as well
            if ($event->decorator_id) {
                $this->updateDecoratorRating($event->decorator_id);
            }
        } catch (\Exception $e) {
            Log::error('Error updating event rating: ' . $e->getMessage());
        }
    }
    
    /**
     * Update the average rating for a package
     *
     * @param int $packageId
     * @return void
     */
    private function updatePackageRating($packageId)
    {
        try {
            $package = Package::find($packageId);
            if (!$package) {
                Log::warning('Attempted to update rating for non-existent package ID: ' . $packageId);
                return;
            }
            
            $avgRating = Feedback::where('package_id', $packageId)->avg('rating') ?: 0;
            $package->rating = round($avgRating, 1); // Round to 1 decimal place
            $package->save();
            
            // If package has a decorator, update decorator rating as well
            if ($package->decorator_id) {
                $this->updateDecoratorRating($package->decorator_id);
            }
        } catch (\Exception $e) {
            Log::error('Error updating package rating: ' . $e->getMessage());
        }
    }
    
    /**
     * Update the average rating for a decorator
     *
     * @param int $decoratorId
     * @return void
     */
    private function updateDecoratorRating($decoratorId)
    {
        try {
            $decorator = Decorator::find($decoratorId);
            if (!$decorator) {
                Log::warning('Attempted to update rating for non-existent decorator ID: ' . $decoratorId);
                return;
            }
            
            // Calculate average rating from all feedback sources:
            // 1. Direct feedback to decorator
            // 2. Feedback to decorator's events
            // 3. Feedback to decorator's packages
            
            $feedbackQuery = Feedback::where(function($query) use ($decoratorId) {
                $query->where('decorator_id', $decoratorId)
                      ->orWhereHas('event', function($q) use ($decoratorId) {
                          $q->where('decorator_id', $decoratorId);
                      })
                      ->orWhereHas('package', function($q) use ($decoratorId) {
                          $q->where('decorator_id', $decoratorId);
                      });
            });
            
            $count = $feedbackQuery->count();
            $avgRating = ($count > 0) ? $feedbackQuery->avg('rating') : 0;
            
            $decorator->rating = round($avgRating, 1); // Round to 1 decimal place
            $decorator->save();
        } catch (\Exception $e) {
            Log::error('Error updating decorator rating: ' . $e->getMessage());
        }
    }
}
