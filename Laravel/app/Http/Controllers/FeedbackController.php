<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Event;
use App\Models\Package;
use App\Models\Decorator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            // Create the feedback
            $feedback = new Feedback();
            $feedback->user_id = Auth::user()->user_id;
            $feedback->booking_id = $request->booking_id;
            $feedback->rating = $request->rating;
            $feedback->comment = $request->comment;
            
            // Set the related entities based on what was booked
            if ($request->has('event_id')) {
                $feedback->event_id = $request->event_id;
                
                // Update event rating
                $this->updateEventRating($request->event_id);
            }
            
            if ($request->has('package_id')) {
                $feedback->package_id = $request->package_id;
                
                // Update package rating
                $this->updatePackageRating($request->package_id);
            }
            
            if ($request->has('decorator_id')) {
                $feedback->decorator_id = $request->decorator_id;
                
                // Update decorator rating
                $this->updateDecoratorRating($request->decorator_id);
            }
            
            $feedback->save();
            
            DB::commit();
            
            return redirect()->route('orders')->with('success', 'Thank you for your feedback!');
        } catch (\Exception $e) {
            DB::rollback();
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
        $avgRating = Feedback::where('event_id', $eventId)->avg('rating');
        Event::where('event_id', $eventId)->update(['rating' => $avgRating]);
    }
    
    /**
     * Update the average rating for a package
     *
     * @param int $packageId
     * @return void
     */
    private function updatePackageRating($packageId)
    {
        $avgRating = Feedback::where('package_id', $packageId)->avg('rating');
        Package::where('package_id', $packageId)->update(['rating' => $avgRating]);
    }
    
    /**
     * Update the average rating for a decorator
     *
     * @param int $decoratorId
     * @return void
     */
    private function updateDecoratorRating($decoratorId)
    {
        $avgRating = Feedback::where('decorator_id', $decoratorId)->avg('rating');
        Decorator::where('decorator_id', $decoratorId)->update(['rating' => $avgRating]);
    }
}
