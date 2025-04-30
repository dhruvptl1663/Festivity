<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('Admin.index');
    }
    
    public function dashboard()
    {
        // Fetch booking statistics from database - counts only to avoid column errors
        $totalOrders = \App\Models\Booking::count();
        
        // Get counts by status
        $pendingOrders = \App\Models\Booking::where('status', 'pending')->count();
        $completedOrders = \App\Models\Booking::where('status', 'completed')->count();
        $cancelledOrders = \App\Models\Booking::where('status', 'cancelled')->count();
        
        // Use static amounts temporarily for the dashboard display
        $totalAmount = 0;
        $pendingAmount = 0;
        $completedAmount = 0;
        $cancelledAmount = 0;
        
        // Get month-wise booking data for the chart (simpler version to avoid column errors)
        $monthlyData = $this->getSimpleMonthlyData();
        
        // Get recent bookings for the table
        $recentBookings = \App\Models\Booking::with(['user', 'event', 'package'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
            
        return view('Admin.index', compact(
            'totalOrders', 'totalAmount', 'pendingOrders', 'pendingAmount',
            'completedOrders', 'completedAmount', 'cancelledOrders', 'cancelledAmount',
            'monthlyData', 'recentBookings'
        ));
    }
    
    /**
     * Get simple monthly booking data for charts (based on counts only)
     */
    private function getSimpleMonthlyData()
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
        
        // Get monthly counts by status
        $bookings = \App\Models\Booking::selectRaw('MONTH(created_at) as month, status, COUNT(*) as count')
            ->whereRaw('YEAR(created_at) = ?', [$year])
            ->groupBy('month', 'status')
            ->get();
            
        foreach ($bookings as $booking) {
            $monthIndex = $booking->month - 1; // Convert to 0-based index
            
            // Use count * 1000 as a placeholder for amounts to visualize data
            $value = $booking->count * 1000;
            
            // Update total amount for this month
            $data['total'][$monthIndex] += $value;
            
            // Update status-specific amount
            if ($booking->status == 'pending') {
                $data['pending'][$monthIndex] += $value;
            } elseif ($booking->status == 'completed') {
                $data['completed'][$monthIndex] += $value;
            } elseif ($booking->status == 'cancelled') {
                $data['cancelled'][$monthIndex] += $value;
            }
        }
        
        return [
            'months' => $months,
            'data' => $data
        ];
    }

    public function profile()
    {
        $admin = Auth::guard('admin')->user();
        return view('Admin.profile', compact('admin'));
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

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully');
    }
}
