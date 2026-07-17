<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehicleCheckController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        
        if ($request->ajax()) {
            $query = \App\Models\VehicleCheck::with(['user', 'checkingPoint'])->select('vehicle_checks.*')->orderBy('vehicle_checks.id', 'desc');
            
            if ($user->user_type_id != 1) {
                $query->where('user_id', $user->id);
            }

            if ($request->filled('vehicle_no')) {
                $query->where('vehicle_no', $request->vehicle_no);
            }
            
            if ($request->filled('police_station')) {
                $query->whereHas('checkingPoint', function($q) use ($request) {
                    $q->where('police_station', $request->police_station);
                });
            }

            // Filter by date duration
            if ($request->filled('filter_date')) {
                $today = \Carbon\Carbon::today();
                switch ($request->filter_date) {
                    case 'today':
                        $query->whereDate('shift_date', $today);
                        break;
                    case 'yesterday':
                        $query->whereDate('shift_date', $today->copy()->subDay());
                        break;
                    case 'last_7_days':
                        $query->whereDate('shift_date', '>=', $today->copy()->subDays(7));
                        break;
                    case 'last_15_days':
                        $query->whereDate('shift_date', '>=', $today->copy()->subDays(15));
                        break;
                    case 'last_30_days':
                        $query->whereDate('shift_date', '>=', $today->copy()->subDays(30));
                        break;
                    case 'this_month':
                        $query->whereMonth('shift_date', $today->month)
                              ->whereYear('shift_date', $today->year);
                        break;
                    case 'last_month':
                        $lastMonth = $today->copy()->subMonth();
                        $query->whereMonth('shift_date', $lastMonth->month)
                              ->whereYear('shift_date', $lastMonth->year);
                        break;
                    case 'custom':
                        if ($request->filled('start_date')) {
                            $query->whereDate('shift_date', '>=', $request->start_date);
                        }
                        if ($request->filled('end_date')) {
                            $query->whereDate('shift_date', '<=', $request->end_date);
                        }
                        break;
                }
            }

            // Filter by time range
            if ($request->filled('start_time')) {
                $query->whereTime('checking_time', '>=', $request->start_time);
            }
            if ($request->filled('end_time')) {
                $query->whereTime('checking_time', '<=', $request->end_time);
            }
            
            return \Yajra\DataTables\Facades\DataTables::of($query)
                ->addColumn('person_vehicle', function($row) {
                    $photoHtml = '';
                    if ($row->vehicle_photo) {
                        $url = \Illuminate\Support\Facades\Storage::url($row->vehicle_photo);
                        $photoHtml = '<div class="avatar avatar-md me-3" style="width: 50px; height: 50px;">
                                        <img src="'.$url.'" alt="Vehicle" class="rounded" style="object-fit: cover; width: 100%; height: 100%; cursor: pointer;" onclick="showImage(\''.$url.'\')">
                                      </div>';
                    } else {
                        $photoHtml = '<div class="avatar avatar-md me-3 rounded d-flex align-items-center justify-content-center bg-label-secondary" style="width: 50px; height: 50px;">
                                        <i class="bx bx-car fs-4"></i>
                                      </div>';
                    }
                    
                    return '<div class="d-flex align-items-center">
                                '.$photoHtml.'
                                <div>
                                    <div class="fw-bold text-dark">'.htmlentities($row->person_name ?? '').'</div>
                                    <div class="small text-primary fw-bold">'.htmlentities($row->vehicle_no ?? '').'</div>
                                </div>
                            </div>';
                })
                ->addColumn('emp_id', function($row) {
                    return '<span class="fw-bold text-dark">'.($row->employee_id_no ?? '-').'</span>';
                })
                ->addColumn('checking_point', function($row) {
                    $badgeColors = ['bg-label-primary', 'bg-label-success', 'bg-label-danger', 'bg-label-warning', 'bg-label-info', 'bg-label-dark'];
                    $badgeClass = $row->checkingPoint ? $badgeColors[$row->checkingPoint->id % count($badgeColors)] : 'bg-label-secondary';
                    $pointName = $row->checkingPoint ? $row->checkingPoint->name : 'N/A';
                    return '<span class="badge ' . $badgeClass . ' fw-bold">'.htmlentities($pointName).'</span>';
                })
                ->addColumn('shift_time', function($row) {
                    $date = $row->shift_date ? $row->shift_date->format('d M, Y') : '';
                    $time = $row->checking_time ? \Carbon\Carbon::parse($row->checking_time)->format('h:i A') : '';
                    return '<div class="fw-bold">'.$date.' ('.$row->shift_type.')</div>
                            <div class="small text-muted"><i class="bx bx-time-five"></i> '.$time.'</div>';
                })
                ->addColumn('remark', function($row) {
                    return '<span class="small text-muted" style="white-space: pre-line;">'.htmlentities($row->remark ?? '-').'</span>';
                })
                ->addColumn('recorded_by', function($row) {
                    $name = $row->user ? $row->user->name : 'Unknown';
                    $empId = $row->user ? ($row->user->employee_id ?? 'Admin') : 'Admin';
                    return '<div class="fw-bold">'.htmlentities($name).'</div>
                            <div class="small">'.htmlentities($empId).'</div>';
                })
                ->addColumn('action', function($row) use ($user) {
                    $photoUrl = $row->vehicle_photo ? \Illuminate\Support\Facades\Storage::url($row->vehicle_photo) : '';
                    $editBtn = '<button type="button" class="btn btn-sm btn-outline-primary me-2" onclick="openEditModal('.$row->id.', \''.$row->checking_point_id.'\', \''.addslashes($row->person_name).'\', \''.($row->shift_date ? $row->shift_date->format('Y-m-d') : '').'\', \''.$row->shift_type.'\', \''.addslashes($row->vehicle_no).'\', \''.addslashes($row->employee_id_no).'\', \''.($row->checking_time ? \Carbon\Carbon::parse($row->checking_time)->format('H:i') : '').'\', \''.addslashes($row->remark).'\', \''.$photoUrl.'\')"><i class="bx bx-edit"></i></button>';
                    
                    $destroyRoute = $user->user_type_id == 1 ? route('admin.vehicle-checks.destroy', $row->id) : route('employee.vehicle-checks.destroy', $row->id);
                    $delBtn = '<form id="deleteForm'.$row->id.'" action="'.$destroyRoute.'" method="POST" class="m-0 p-0 d-inline-flex">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('.$row->id.')"><i class="bx bx-trash"></i></button>
                               </form>';
                    return '<div class="d-flex justify-content-end align-items-center text-nowrap">'.$editBtn . $delBtn.'</div>';
                })
                ->rawColumns(['person_vehicle', 'emp_id', 'checking_point', 'shift_time', 'remark', 'recorded_by', 'action'])
                ->make(true);
        }

        $checkingPoints = \App\Models\CheckingPoint::orderBy('police_station')
            ->orderBy('name')
            ->get()
            ->groupBy(function($item) {
                return $item->police_station ?: 'Unassigned / Other';
            });
        $vehicleNumbers = \App\Models\VehicleCheck::select('vehicle_no')->distinct()->pluck('vehicle_no');

        $policeStations = \App\Models\CheckingPoint::select('police_station')
            ->whereNotNull('police_station')
            ->where('police_station', '!=', '')
            ->distinct()
            ->pluck('police_station');

        $viewName = $user->user_type_id == 1 ? 'admin.vehicle_checks.index' : 'employee.vehicle_checks.index';
        return view($viewName, compact('checkingPoints', 'user', 'vehicleNumbers', 'policeStations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'checking_point_id' => 'required|exists:checking_points,id',
            'person_name' => 'required|string|max:255',
            'shift_date' => 'required|date',
            'shift_type' => 'nullable|in:Morning,Evening,Night',
            'vehicle_no' => 'required|string|max:255',
            'employee_id_no' => 'nullable|string|max:255',
            'vehicle_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'checking_time' => 'required',
            'remark' => 'nullable|string'
        ]);

        $validated['user_id'] = auth()->id();

        // Auto-assign shift based on time
        $time = \Carbon\Carbon::parse($validated['checking_time']);
        $hour = $time->hour;
        if ($hour >= 8 && $hour < 16) {
            $validated['shift_type'] = 'Morning';
        } elseif ($hour >= 16 && $hour <= 23) {
            $validated['shift_type'] = 'Evening';
        } else {
            $validated['shift_type'] = 'Night';
        }

        if ($request->hasFile('vehicle_photo')) {
            $validated['vehicle_photo'] = $request->file('vehicle_photo')->store('vehicle_photos', 'public');
        }

        \App\Models\VehicleCheck::create($validated);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Vehicle check recorded successfully.']);
        }
        return redirect()->back()->with('success', 'Vehicle check recorded successfully.');
    }

    public function update(Request $request, \App\Models\VehicleCheck $vehicleCheck)
    {
        // Check authorization
        if (auth()->user()->user_type_id != 1 && $vehicleCheck->user_id != auth()->id()) {
            if ($request->wantsJson()) return response()->json(['message' => 'Forbidden'], 403);
            abort(403);
        }

        $validated = $request->validate([
            'checking_point_id' => 'required|exists:checking_points,id',
            'person_name' => 'required|string|max:255',
            'shift_date' => 'required|date',
            'shift_type' => 'nullable|in:Morning,Evening,Night',
            'vehicle_no' => 'required|string|max:255',
            'employee_id_no' => 'nullable|string|max:255',
            'vehicle_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'checking_time' => 'required',
            'remark' => 'nullable|string'
        ]);

        // Auto-assign shift based on time
        $time = \Carbon\Carbon::parse($validated['checking_time']);
        $hour = $time->hour;
        if ($hour >= 8 && $hour < 16) {
            $validated['shift_type'] = 'Morning';
        } elseif ($hour >= 16 && $hour <= 23) {
            $validated['shift_type'] = 'Evening';
        } else {
            $validated['shift_type'] = 'Night';
        }

        if ($request->hasFile('vehicle_photo')) {
            if ($vehicleCheck->vehicle_photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($vehicleCheck->vehicle_photo)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($vehicleCheck->vehicle_photo);
            }
            $validated['vehicle_photo'] = $request->file('vehicle_photo')->store('vehicle_photos', 'public');
        }

        $vehicleCheck->update($validated);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Vehicle check updated successfully.']);
        }
        return redirect()->back()->with('success', 'Vehicle check updated successfully.');
    }

    public function destroy(\App\Models\VehicleCheck $vehicleCheck, Request $request)
    {
        if (auth()->user()->user_type_id != 1 && $vehicleCheck->user_id != auth()->id()) {
            if ($request->wantsJson()) return response()->json(['message' => 'Forbidden'], 403);
            abort(403);
        }

        if ($vehicleCheck->vehicle_photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($vehicleCheck->vehicle_photo)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($vehicleCheck->vehicle_photo);
        }

        $vehicleCheck->delete();

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Vehicle check deleted successfully.']);
        }
        return redirect()->back()->with('success', 'Vehicle check deleted successfully.');
    }
}
