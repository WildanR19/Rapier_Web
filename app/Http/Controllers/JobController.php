<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

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
        Alert::success('Success', 'Your data has been added.');
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
        Alert::success('Updated', 'Your data has been updated.');
        return response()->json([ 'success' => true ]);
    }

    public function destroy($id)
    {
        Job::find($id)->delete();
        Alert::success('Deleted', 'Your data has been deleted.');
        return back();
    }
}
