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
        return view('admin.department.index')->with('dept', $dept);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
        ]);
        Department::create([
            'name' => $request->name,
        ]);
        return back();
    }

    public function update($id)
    {
    	$dept = Department::find($id);

	    return response()->json([
	      'data' => $dept
	    ]);
    }

    public function edit(Request $request, $id)
    {
        Department::updateOrCreate(
            [ 'id' => $id ],
            [ 'name' => $request->name, ],
        );

        return response()->json([ 'success' => true ]);
    }

    public function destroy($id)
    {
        Department::find($id)->delete();
        return back();
    }
}
