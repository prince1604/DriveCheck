<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckingPointController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = \App\Models\CheckingPoint::select('*')->orderBy('id', 'desc');
            return \Yajra\DataTables\Facades\DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function($row){
                    return $row->created_at ? $row->created_at->format('d M, Y') : '-';
                })
                ->addColumn('action', function($row){
                    $btn = '<button type="button" class="btn btn-sm btn-outline-primary me-2" onclick="openEditModal('.$row->id.', \''.addslashes($row->name).'\', \''.addslashes($row->police_station ?? '').'\', \''.addslashes($row->incharge_name ?? '').'\')"><i class="bx bx-edit"></i> Edit</button>';
                    $btn .= ' <form id="deleteForm'.$row->id.'" action="'.route('admin.checking-points.destroy', $row->id).'" method="POST" class="d-inline">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('.$row->id.')">
                                    <i class="bx bx-trash"></i> Delete
                                </button>
                              </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.checking_points.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:checking_points,name',
            'police_station' => 'required|string|max:255',
            'incharge_name' => 'nullable|string|max:255'
        ]);

        $checkingPoint = \App\Models\CheckingPoint::create($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true, 
                'message' => 'Checking point added successfully.',
                'data' => [
                    'id' => $checkingPoint->id,
                    'name' => $checkingPoint->name,
                    'police_station' => $checkingPoint->police_station,
                    'incharge_name' => $checkingPoint->incharge_name,
                    'created_at' => $checkingPoint->created_at->format('d M, Y')
                ]
            ]);
        }
        return redirect()->back()->with('success', 'Checking point added successfully.');
    }

    public function update(Request $request, \App\Models\CheckingPoint $checkingPoint)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:checking_points,name,' . $checkingPoint->id,
            'police_station' => 'required|string|max:255',
            'incharge_name' => 'nullable|string|max:255'
        ]);

        $checkingPoint->update($validated);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Checking point updated successfully.']);
        }
        return redirect()->back()->with('success', 'Checking point updated successfully.');
    }

    public function destroy(\App\Models\CheckingPoint $checkingPoint, Request $request)
    {
        $checkingPoint->delete();

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Checking point deleted successfully.']);
        }
        return redirect()->back()->with('success', 'Checking point deleted successfully.');
    }
}
