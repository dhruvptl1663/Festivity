<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Bookmark;

class MainController extends Controller
{
    //
    public function index()
    {
        return view('index');
    }

    public function events()
    {
        return view('events');
    }

    public function packages()
    {
        return view('packages');
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function login()
    {
        return view('login');
    }

    public function signup()
    {
        return view('signup');
    }

    public function profile()
    {
        return view('profile');
    }

   
    public function eventdetails($id)
    {
        $event = Event::findOrFail($id);
        $isBookmarked = auth()->check() 
            ? Bookmark::where('user_id', auth()->id())
                ->where('event_id', $id)
                ->exists()
            : false;
    
        return view('eventdetails', compact('event', 'isBookmarked'));
    }


}
