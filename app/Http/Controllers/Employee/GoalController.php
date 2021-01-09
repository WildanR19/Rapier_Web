<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class GoalController extends Controller
{
    public function index()
    {
        $goal = Goal::all();
        $data = [
            'goals'     => $goal,
        ];
        return view('employee.goals.index')->with($data);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'         => 'required|string',
            'description'   => 'nullable',
            'duedate'      => 'required|date',
            'priority'      => 'required',
        ]);

        $goal = new Goal();
        $goal->title            = $request->title;
        $goal->description      = $request->description;
        $goal->due_date         = $request->duedate;
        $goal->user_id          = Auth::user()->id;
        $goal->priority         = $request->priority;
        $goal->progress_percent = '0';
        $goal->save();

        Alert::success('Success', 'Your data has been added.');
        return redirect()->route('dash.goals');
    }

    public function update($id)
    {
    	$goal = Goal::find($id);

	    return response()->json([
	      'data' => $goal
	    ]);
    }

    public function edit(Request $request, $id)
    {
        Goal::where('id', $id)->update([ 
            'progress_percent'    => $request->progress,
            'status'              => ($request->progress == '100')?'completed':'incomplete', 
        ]);
        Alert::success('Updated', 'Your data has been updated.');
        return response()->json([ 'success' => true ]);
    }
}
