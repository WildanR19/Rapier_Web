<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index()
    {
    	// Get all data
        $dept = Department::all();
    	// return data to view
        return view('admin.department.index', compact('dept', 'dept'));
    }

    public function store(Request $request)
    {
        $input = [
            'name'          => $request->name,
            'created_at'    => now(),
            'updated_at'    => now(),
        ];
        Department::create($input);
        return back();
    }

    public function destroy($id)
    {
        Department::find($id)->delete();
        return back()->with('success','Data deleted successfully');
    }
}
