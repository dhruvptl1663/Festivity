<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->user_id.',user_id',
        ]);
        $user->update($request->only(['name', 'email']));
        return redirect()->route('profile.show')->with('success', 'Profile updated!');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'current_password' => ['required', function($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('The current password is incorrect. Please try again.');
                }
            }],
            'new_password' => [
                'required',
                'min:8',
                'confirmed',
                'different:current_password',
                function ($attribute, $value, $fail) {
                    // Check for strong password requirements
                    if (!preg_match('/[A-Z]/', $value)) {
                        $fail('The password must contain at least one uppercase letter.');
                    }
                    if (!preg_match('/[a-z]/', $value)) {
                        $fail('The password must contain at least one lowercase letter.');
                    }
                    if (!preg_match('/[0-9]/', $value)) {
                        $fail('The password must contain at least one number.');
                    }
                    if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $value)) {
                        $fail('The password must contain at least one special character.');
                    }
                }
            ],
            'new_password_confirmation' => 'required|same:new_password',
        ], [
            'current_password.required' => 'Please enter your current password.',
            'new_password.required' => 'Please enter a new password.',
            'new_password.min' => 'Password must be at least 8 characters long.',
            'new_password.confirmed' => 'The new password confirmation does not match.',
            'new_password_confirmation.required' => 'Please confirm your new password.',
            'new_password.different' => 'New password cannot be the same as your current password.',
        ]);

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Password updated successfully!');
    }
}