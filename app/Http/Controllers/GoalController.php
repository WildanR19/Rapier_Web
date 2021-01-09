<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class GoalController extends Controller
{
    public function index()
    {
        $goal = Goal::all();
        $data = [
            'goals' => $goal,
        ];
        return view('admin.goal.index')->with($data);
    }

    public function add()
    {
        $emp        = User::all();

        $data = [
            'emp'       => $emp,
        ];
        return view('admin.goal.add')->with($data);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'         => 'required|string',
            'description'   => 'nullable',
            'due_date'      => 'required|date',
            'assigned'      => 'required',
            'status'        => 'required',
            'priority'      => 'required',
        ]);

        $goal = new Goal();
        $goal->title            = $request->title;
        $goal->description      = $request->description;
        $goal->due_date         = $request->due_date;
        $goal->user_id          = $request->assigned;
        $goal->status           = $request->status;
        $goal->priority         = $request->priority;
        $goal->progress_percent = '0';
        $goal->save();

        Alert::success('Success', 'Your data has been added.');
        return redirect()->route('admin.goals');
    }

    public function destroy($id)
    {
        Goal::where('id', $id)->delete();
        Alert::success('Deleted', 'Your data has been deleted.');
        return back();
    }

    public function edit($id)
    {
        $goals      = Goal::where('id', $id)->first();
        $emp        = User::all();

        $data = [
            'goals'     => $goals,
            'emp'       => $emp,
        ];
        return view('admin.goal.edit')->with($data);
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'title'         => 'required|string',
            'description'   => 'nullable',
            'due_date'      => 'required|date',
            'assigned'      => 'required',
            'status'        => 'required',
            'priority'      => 'required',
            'progress'      => 'required',
        ]);

        $task = Goal::findOrFail($request->id);
        $task->title            = $request->title;
        $task->description      = $request->description;
        $task->due_date         = $request->due_date;
        $task->user_id          = $request->assigned;
        $task->status           = $request->status;
        $task->priority         = $request->priority;
        $task->progress_percent = $request->progress;
        $task->save();

        Alert::success('Success', 'Your data has been updated.');
        return redirect()->route('admin.goals');
    }
}
