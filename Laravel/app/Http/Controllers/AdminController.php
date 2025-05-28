<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch booking statistics
        $totalOrders = \App\Models\Booking::count();
        $pendingOrders = \App\Models\Booking::where('status', 'pending')->count();
        $completedOrders = \App\Models\Booking::where('status', 'completed')->count();
        $cancelledOrders = \App\Models\Booking::where('status', 'cancelled')->count();

        // Get recent bookings
        $recentBookings = \App\Models\Booking::with(['user', 'event', 'package'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Calculate total amounts based on advance paid and commissions
        $totalAmount = \App\Models\Booking::where('status', '!=', 'cancelled')
            ->sum('advance_paid');
        
        $pendingAmount = \App\Models\Booking::where('status', 'pending')
            ->sum('advance_paid');
        
        $completedAmount = \App\Models\Booking::where('status', 'completed')
            ->sum('advance_paid');
        
        $cancelledAmount = \App\Models\Booking::where('status', 'cancelled')
            ->sum('advance_paid');

        // Get total admin commissions
        $adminCommissions = \App\Models\AdminCommission::sum('amount');

        // Get monthly booking data
        $monthlyData = $this->getMonthlyBookingData();

        // Count bookings by type for pie chart
        $eventBookingsCount = \App\Models\Booking::whereNotNull('event_id')->count();
        $packageBookingsCount = \App\Models\Booking::whereNotNull('package_id')->count();

        return view('Admin.index', compact(
            'totalOrders', 'pendingOrders', 'completedOrders', 'cancelledOrders',
            'totalAmount', 'pendingAmount', 'completedAmount', 'cancelledAmount',
            'recentBookings', 'monthlyData',
            'eventBookingsCount', 'packageBookingsCount'
        ));
    }
    
    private function getMonthlyBookingData()
    {
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $data = [
            'total' => array_fill(0, 12, 0),
            'pending' => array_fill(0, 12, 0),
            'completed' => array_fill(0, 12, 0),
            'cancelled' => array_fill(0, 12, 0)
        ];
        
        // Current year
        $year = date('Y');
        
        // Get monthly counts and amounts by status
        $bookings = \App\Models\Booking::selectRaw('MONTH(created_at) as month, status, COUNT(*) as count, SUM(advance_paid) as amount')
            ->whereRaw('YEAR(created_at) = ?', [$year])
            ->groupBy('month', 'status')
            ->get();
            
        foreach ($bookings as $booking) {
            $monthIndex = $booking->month - 1; // Convert to 0-based index
            
            // Update counts
            $data['total'][$monthIndex] += $booking->count;
            
            // Update status-specific counts
            if ($booking->status == 'pending') {
                $data['pending'][$monthIndex] += $booking->count;
            } elseif ($booking->status == 'completed') {
                $data['completed'][$monthIndex] += $booking->count;
            } elseif ($booking->status == 'cancelled') {
                $data['cancelled'][$monthIndex] += $booking->count;
            }
        }
        
        return [
            'months' => $months,
            'data' => $data
        ];
    }

    public function dashboard()
    {
        return redirect()->route('admin.index');
    }

    public function profile()
    {
        $admin = Auth::guard('admin')->user();
        return view('Admin.profile', compact('admin'));
    }

    public function editProfile()
    {
        $admin = Auth::guard('admin')->user();
        return view('Admin.profile.edit', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,'.$admin->admin_id.',admin_id',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->filled('password')) {
            $admin->password_hash = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('admin.dashboard')->with('success', 'Profile updated successfully');
    }
}
