<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $employeeCount = \App\Models\User::where('user_type_id', 2)->count();
        $activeEmployees = \App\Models\User::where('user_type_id', 2)->where('is_active', true)->count();
        $totalPoints = \App\Models\CheckingPoint::count();
        $totalChecks = \App\Models\VehicleCheck::count();
        $todayChecks = \App\Models\VehicleCheck::whereDate('created_at', \Carbon\Carbon::today())->count();

        // Chart Data (Last 7 Days)
        $dates = collect();
        $checkCounts = collect();
        
        for ($i = 6; $i >= 0; $i--) {
            $date = \Carbon\Carbon::today()->subDays($i);
            $dates->push($date->format('d M'));
            $checkCounts->push(\App\Models\VehicleCheck::whereDate('created_at', $date)->count());
        }

        // Checks by Shift
        $morningChecks = \App\Models\VehicleCheck::where('shift_type', 'Morning')->count();
        $eveningChecks = \App\Models\VehicleCheck::where('shift_type', 'Evening')->count();
        $nightChecks = \App\Models\VehicleCheck::where('shift_type', 'Night')->count();
        $shiftData = [$morningChecks, $eveningChecks, $nightChecks];

        // Checks by Point
        $pointStats = \App\Models\VehicleCheck::selectRaw('checking_point_id, count(*) as total')
                        ->with('checkingPoint')
                        ->groupBy('checking_point_id')
                        ->orderByDesc('total')
                        ->take(5)
                        ->get();
                        
        $pointLabels = collect();
        $pointData = collect();
        foreach($pointStats as $stat) {
            $pointLabels->push($stat->checkingPoint->name ?? 'Unknown');
            $pointData->push($stat->total);
        }

        // Recent Checks
        $recentChecks = \App\Models\VehicleCheck::with(['user', 'checkingPoint'])
                            ->latest()
                            ->take(6)
                            ->get();

        return view('admin.dashboard', compact(
            'employeeCount', 'activeEmployees', 'totalPoints', 
            'totalChecks', 'todayChecks', 'dates', 'checkCounts',
            'shiftData', 'pointLabels', 'pointData', 'recentChecks'
        ));
    }

    public function reports()
    {
        // Generate Heatmap data: Last 7 days, Checks per shift
        $morningShiftData = [];
        $eveningShiftData = [];
        $nightShiftData = [];

        for ($i = 6; $i >= 0; $i--) {
            $dateObj = \Carbon\Carbon::today()->subDays($i);
            $dateStr = $dateObj->format('d M');
            
            $morningCount = \App\Models\VehicleCheck::whereDate('created_at', $dateObj)->where('shift_type', 'Morning')->count();
            $eveningCount = \App\Models\VehicleCheck::whereDate('created_at', $dateObj)->where('shift_type', 'Evening')->count();
            $nightCount = \App\Models\VehicleCheck::whereDate('created_at', $dateObj)->where('shift_type', 'Night')->count();

            // ApexCharts heatmap requires {x: 'category', y: value} format
            $morningShiftData[] = ['x' => $dateStr, 'y' => $morningCount];
            $eveningShiftData[] = ['x' => $dateStr, 'y' => $eveningCount];
            $nightShiftData[] = ['x' => $dateStr, 'y' => $nightCount];
        }

        $heatmapData = [
            [
                'name' => 'Morning Shift',
                'data' => $morningShiftData
            ],
            [
                'name' => 'Evening Shift',
                'data' => $eveningShiftData
            ],
            [
                'name' => 'Night Shift',
                'data' => $nightShiftData
            ]
        ];

        $policeStations = \App\Models\CheckingPoint::select('police_station')->distinct()->pluck('police_station')->filter()->values();

        return view('admin.reports', compact('heatmapData', 'policeStations'));
    }

    public function checkExport(Request $request)
    {
        $query = \App\Models\VehicleCheck::query();

        if ($request->filled('start_date')) {
            $query->whereDate('shift_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('shift_date', '<=', $request->end_date);
        }
        if ($request->filled('shift_type')) {
            $query->where('shift_type', $request->shift_type);
        }
        if ($request->filled('police_station')) {
            $query->whereHas('checkingPoint', function($q) use ($request) {
                $q->where('police_station', $request->police_station);
            });
        }

        return response()->json(['count' => $query->count()]);
    }

    public function exportReport(Request $request)
    {
        $query = \App\Models\VehicleCheck::with(['user', 'checkingPoint'])->orderBy('shift_date', 'desc')->orderBy('checking_time', 'desc');

        if ($request->filled('start_date')) {
            $query->whereDate('shift_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('shift_date', '<=', $request->end_date);
        }
        if ($request->filled('shift_type')) {
            $query->where('shift_type', $request->shift_type);
        }
        if ($request->filled('police_station')) {
            $query->whereHas('checkingPoint', function($q) use ($request) {
                $q->where('police_station', $request->police_station);
            });
        }

        $records = $query->get();
        
        if ($records->isEmpty()) {
            return back()->with('error', 'No records found for the selected time period and criteria.');
        }

        $title = $request->input('report_title', 'Vehicle Checking Custom Report');

        if ($request->export_format === 'csv') {
            $filename = str_replace(' ', '_', strtolower($title)) . '_' . date('Ymd_His') . '.csv';
            
            $headers = [
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$filename",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            ];

            $callback = function() use ($records) {
                $file = fopen('php://output', 'w');
                fputcsv($file, ['ID', 'Date', 'Time', 'Shift', 'Vehicle No', 'Person Name', 'Employee ID', 'Police Station', 'Checking Point', 'Recorded By']);

                foreach ($records as $row) {
                    fputcsv($file, [
                        $row->id,
                        \Carbon\Carbon::parse($row->shift_date)->format('d M, Y'),
                        \Carbon\Carbon::parse($row->checking_time)->format('h:i A'),
                        $row->shift_type,
                        $row->vehicle_no,
                        $row->person_name,
                        $row->employee_id_no ?? '-',
                        $row->checkingPoint->police_station ?? '-',
                        $row->checkingPoint->name ?? '-',
                        $row->user->name ?? '-'
                    ]);
                }
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }

        if ($request->export_format === 'pdf') {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.reports.pdf', compact('records', 'title', 'request'))
                        ->setPaper('a4', 'landscape');
            return $pdf->stream(str_replace(' ', '_', strtolower($title)) . '_' . date('Ymd_His') . '.pdf');
        }

        return back();
    }

    public function dutyRoster()
    {
        $employees = \App\Models\User::where('user_type_id', 2)->get();
        
        foreach ($employees as $emp) {
            $emp->current_shift = $emp->assigned_shift ?? 'Unassigned';
            $emp->assigned_point = $emp->assigned_checking_point_id 
                                ? \App\Models\CheckingPoint::find($emp->assigned_checking_point_id)->name 
                                : 'Not Assigned';
                                
            if ($emp->duty_start_time && $emp->duty_end_time) {
                $emp->duty_status = 'On Duty';
                $emp->status_color = 'success';
            } else {
                $emp->duty_status = 'Off Duty';
                $emp->status_color = 'secondary';
            }
        }
                        
        $checkingPoints = \App\Models\CheckingPoint::all();

        return view('admin.duty-roster', compact('employees', 'checkingPoints'));
    }

    public function updateDutyRoster(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:users,id',
            'duty_start_time' => 'required',
            'duty_end_time' => 'required',
            'assigned_shift' => 'required|string',
            'assigned_checking_point_id' => 'nullable|exists:checking_points,id',
            'roster_name' => 'nullable|string|max:255',
        ]);

        $user = \App\Models\User::find($request->employee_id);
        if ($user) {
            $user->duty_start_time = $request->duty_start_time;
            $user->duty_end_time = $request->duty_end_time;
            $user->assigned_shift = $request->assigned_shift;
            if ($request->has('assigned_checking_point_id')) {
                $user->assigned_checking_point_id = $request->assigned_checking_point_id;
            }
            if ($request->has('roster_name')) {
                $user->roster_name = $request->roster_name;
            }
            $user->save();
        }

        return response()->json(['success' => true]);
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function employees(Request $request)
    {
        if ($request->ajax()) {
            $data = \App\Models\User::where('user_type_id', 2)->select('*')->orderBy('id', 'desc');
            return \Yajra\DataTables\Facades\DataTables::of($data)
                ->addColumn('profile', function($row) {
                    $html = '<div class="d-flex align-items-center">';
                    if ($row->profile_photo) {
                        if (str_starts_with($row->profile_photo, 'profile_photos/')) {
                            $url = asset('storage/' . $row->profile_photo);
                        } else {
                            $url = asset($row->profile_photo);
                        }
                        $html .= '<div class="avatar avatar-sm me-3"><img src="'.$url.'" alt="Avatar" class="rounded-circle" style="object-fit: cover;"></div>';
                    } else {
                        $html .= '<div class="avatar avatar-sm me-3"><span class="avatar-initial rounded-circle bg-label-primary">'.strtoupper(substr($row->name, 0, 1)).'</span></div>';
                    }
                    $html .= '<div class="d-flex flex-column"><span class="fw-bold text-dark">'.htmlentities($row->name ?? '').'</span><small class="text-muted">'.htmlentities($row->email ?? '').'</small></div></div>';
                    return $html;
                })
                ->addColumn('emp_id', function($row) {
                    return '<span class="fw-bold">'.htmlentities($row->employee_id ?? '').'</span>';
                })
                ->addColumn('police_station', function($row) {
                    return htmlentities($row->policestation ?? '-');
                })
                ->addColumn('mobile', function($row) {
                    return htmlentities($row->mobile_no ?? '-');
                })
                ->addColumn('status', function($row) {
                    $checked = $row->is_active ? 'checked' : '';
                    return '<div class="form-check form-switch"><input class="form-check-input status-toggle" type="checkbox" data-id="'.$row->id.'" '.$checked.'></div>';
                })
                ->addColumn('action', function($row) {
                    $jsEmpId = htmlspecialchars(addslashes($row->employee_id), ENT_QUOTES, 'UTF-8');
                    $jsName = htmlspecialchars(addslashes($row->name), ENT_QUOTES, 'UTF-8');
                    $jsEmail = htmlspecialchars(addslashes($row->email), ENT_QUOTES, 'UTF-8');
                    $jsPolice = htmlspecialchars(addslashes($row->policestation ?? ''), ENT_QUOTES, 'UTF-8');
                    $jsMobile = htmlspecialchars(addslashes($row->mobile_no ?? ''), ENT_QUOTES, 'UTF-8');
                    
                    return '<div class="d-flex align-items-center">
                                <button type="button" onclick="openEditModal('.$row->id.', \''.$jsEmpId.'\', \''.$jsName.'\', \''.$jsEmail.'\', \''.$jsPolice.'\', \''.$jsMobile.'\')" class="btn btn-sm btn-outline-primary me-2"><i class="bx bx-edit"></i> Edit</button>
                                <form action="'.route('admin.employees.destroy', $row->id).'" method="POST" class="d-inline delete-form">
                                    '.csrf_field().'
                                    '.method_field('DELETE').'
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete(this)"><i class="bx bx-trash"></i> Delete</button>
                                </form>
                            </div>';
                })
                ->rawColumns(['profile', 'emp_id', 'police_station', 'mobile', 'status', 'action'])
                ->make(true);
        }

        return view('admin.employees.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'policestation' => 'required|string|max:255',
            'mobile_no' => 'required|digits:10',
            'password' => 'required|string|min:6',
        ]);

        \App\Models\User::create([
            'employee_id' => $validated['employee_id'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'policestation' => $validated['policestation'] ?? null,
            'mobile_no' => $validated['mobile_no'] ?? null,
            'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
            'user_type_id' => 2,
            'is_active' => true, // Admin created are active by default
        ]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Employee created successfully.']);
        }

        return redirect()->route('admin.employees')->with('success', 'Employee created successfully.');
    }

    public function update(Request $request, \App\Models\User $user)
    {
        if ($user->user_type_id != 2) {
            if ($request->wantsJson()) return response()->json(['message' => 'Forbidden'], 403);
            return abort(403);
        }

        $validated = $request->validate([
            'employee_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'policestation' => 'required|string|max:255',
            'mobile_no' => 'required|digits:10',
        ]);

        $user->update($validated);

        if ($request->filled('password')) {
            $user->update(['password' => \Illuminate\Support\Facades\Hash::make($request->password)]);
        }

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Employee updated successfully.']);
        }

        return redirect()->route('admin.employees')->with('success', 'Employee updated successfully.');
    }

    public function toggleStatus(\App\Models\User $user)
    {
        if ($user->user_type_id != 2) {
            return response()->json(['success' => false, 'message' => 'Invalid user.']);
        }
        
        $user->is_active = !$user->is_active;
        $user->save();

        return response()->json(['success' => true, 'is_active' => $user->is_active]);
    }

    public function destroy(\App\Models\User $user)
    {
        if ($user->user_type_id == 2) {
            $user->delete();
            return redirect()->route('admin.employees')->with('success', 'Employee deleted successfully.');
        }
        return redirect()->route('admin.employees')->with('error', 'Cannot delete this user.');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'mobile_no' => 'nullable|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:6|confirmed',
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

        if ($request->filled('password')) {
            $validated['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.profile')->with('success', 'Admin profile updated successfully.');
    }
}
