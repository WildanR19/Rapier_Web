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
        $input = [
            'name'          => $request->name,
            'created_at'    => now(),
            'updated_at'    => now(),
        ];
        Job::create($input);
        return back();
    }

    public function destroy($id)
    {
        Job::find($id)->delete();
        return back()->with('success','Data deleted successfully');
    }

    public function edit($id)
    {
        $job = Job::where('id',$id)->get();
        return view('edit')->with('job', $job);
        // return back();
    }
}
