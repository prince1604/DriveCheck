<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        
        $totalMyChecks = \App\Models\VehicleCheck::where('user_id', $userId)->count();
        $todayMyChecks = \App\Models\VehicleCheck::where('user_id', $userId)
                                ->whereDate('created_at', \Carbon\Carbon::today())
                                ->count();

        // Chart Data (Last 7 Days)
        $dates = collect();
        $checkCounts = collect();
        
        for ($i = 6; $i >= 0; $i--) {
            $date = \Carbon\Carbon::today()->subDays($i);
            $dates->push($date->format('d M'));
            $checkCounts->push(\App\Models\VehicleCheck::where('user_id', $userId)->whereDate('created_at', $date)->count());
        }

        // Checks by Shift
        $morningChecks = \App\Models\VehicleCheck::where('user_id', $userId)->where('shift_type', 'Morning')->count();
        $eveningChecks = \App\Models\VehicleCheck::where('user_id', $userId)->where('shift_type', 'Evening')->count();
        $nightChecks = \App\Models\VehicleCheck::where('user_id', $userId)->where('shift_type', 'Night')->count();
        $shiftData = [$morningChecks, $eveningChecks, $nightChecks];

        // Recent Checks
        $recentChecks = \App\Models\VehicleCheck::with('checkingPoint')
                            ->where('user_id', $userId)
                            ->latest()
                            ->take(6)
                            ->get();

        return view('employee.dashboard', compact(
            'totalMyChecks', 'todayMyChecks', 'dates', 'checkCounts',
            'shiftData', 'recentChecks'
        ));
    }

    public function performance()
    {
        $userId = auth()->id();
        
        // Calculate performance metrics
        $thisWeek = \Carbon\Carbon::now()->startOfWeek();
        $weeklyChecks = \App\Models\VehicleCheck::where('user_id', $userId)
                        ->where('created_at', '>=', $thisWeek)
                        ->count();
                        
        // Set a dummy weekly target
        $weeklyTarget = 100;
        $completionPercentage = min(100, round(($weeklyChecks / $weeklyTarget) * 100));

        // Get recent checks timeline
        $timelineChecks = \App\Models\VehicleCheck::with('checkingPoint')
                            ->where('user_id', $userId)
                            ->latest()
                            ->take(5)
                            ->get();

        return view('employee.performance', compact('weeklyChecks', 'weeklyTarget', 'completionPercentage', 'timelineChecks'));
    }

    public function dutyRoster()
    {
        $user = auth()->user();
        
        $currentShift = $user->assigned_shift ?? 'Unassigned';
        $assignedPoint = $user->assigned_checking_point_id 
                            ? \App\Models\CheckingPoint::find($user->assigned_checking_point_id)->name 
                            : 'Not Assigned';
                            
        $dutyStatus = 'Off Duty';
        $statusColor = 'secondary';
        
        if ($user->duty_start_time && $user->duty_end_time) {
            $dutyStatus = 'On Duty';
            $statusColor = 'success';
        }
        
        return view('employee.duty-roster', compact('currentShift', 'assignedPoint', 'dutyStatus', 'statusColor'));
    }

    public function updateDutyRoster(Request $request)
    {
        $request->validate([
            'duty_start_time' => 'required',
            'duty_end_time' => 'required',
            'assigned_shift' => 'required|string',
        ]);

        $user = auth()->user();
        $user->duty_start_time = $request->duty_start_time;
        $user->duty_end_time = $request->duty_end_time;
        $user->assigned_shift = $request->assigned_shift;
        $user->save();

        return response()->json(['success' => true]);
    }

    public function profile()
    {
        $user = auth()->user();
        return view('employee.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'employee_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'policestation' => 'nullable|string|max:255',
            'mobile_no' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {
                if (str_starts_with($user->profile_photo, 'profile_photos/') && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->profile_photo)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($user->profile_photo);
                } elseif (file_exists(public_path($user->profile_photo))) {
                    @unlink(public_path($user->profile_photo));
                }
            }
            
            $fileName = time() . '_' . $request->file('profile_photo')->getClientOriginalName();
            $request->file('profile_photo')->move(public_path('uploads/profile_photos'), $fileName);
            $validated['profile_photo'] = 'uploads/profile_photos/' . $fileName;
        }

        $user->update($validated);

        return redirect()->route('employee.profile')->with('success', 'Profile updated successfully.');
    }

    public function destroyAccount()
    {
        $user = auth()->user();
        auth()->logout();
        $user->delete();
        
        return redirect()->route('login')->with('success', 'Your account has been deleted.');
    }
}
