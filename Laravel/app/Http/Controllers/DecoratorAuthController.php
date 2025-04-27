<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Decorator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DecoratorAuthController extends Controller
{
    /**
     * Handle a decorator login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        
        if (Auth::guard('decorator')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('decorator/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password'));
    }

    /**
     * Handle a decorator registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:decorators',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'specialization' => 'nullable|string|max:100',
        ]);

        // Handle logo upload if provided
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('decorator_logos', 'public');
        }

        $decorator = Decorator::create([
            'decorator_name' => $request->name,
            'owner_name' => $request->owner_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'description' => $request->description,
            'logo' => $logoPath,
            'specialization' => $request->specialization,
            'status' => 'pending', // New decorators start with pending status until approved by admin
        ]);

        Auth::guard('decorator')->login($decorator);

        return redirect()->route('decorator.dashboard');
    }

    /**
     * Log the decorator out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard('decorator')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/decorator/login');
    }
}
