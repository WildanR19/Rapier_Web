<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function index()
    {
    	// Get all data
        $job = Job::all();
    	// return data to view
        return view('admin.job.index')->with('job', $job);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
        ]);
        Job::create([
            'name' => $request->name,
        ]);
        return back();
    }

    public function update($id)
    {
    	$job = Job::find($id);

	    return response()->json([
	      'data' => $job
	    ]);
    }

    public function edit(Request $request, $id)
    {
        Job::updateOrCreate(
            [ 'id' => $id ],
            [ 'name' => $request->name, ],
        );

        return response()->json([ 'success' => true ]);
    }

    public function destroy($id)
    {
        Job::find($id)->delete();
        return back();
    }
}
