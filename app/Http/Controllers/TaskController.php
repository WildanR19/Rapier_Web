<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class TaskController extends Controller
{
    public function index()
    {
        $task = Task::all();
        $data = [
            'tasks' => $task,
        ];
        return view('admin.task.index')->with($data);
    }

    public function add()
    {
        $emp        = User::all();
        $category   = TaskCategory::all();
        $project    = Project::all();

        $data = [
            'emp'       => $emp,
            'category'  => $category,
            'projects'  => $project,
        ];
        return view('admin.task.add')->with($data);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'project'       => 'required',
            'title'         => 'required|string',
            'category'      => 'required|integer',
            'description'   => 'nullable',
            'start_date'    => 'nullable',
            'due_date'      => 'required|date',
            'assigned'      => 'required',
            'status'        => 'required',
            'priority'      => 'required',
        ]);

        $task = new Task();
        $task->project_id       = $request->project;
        $task->title            = $request->title;
        $task->description      = $request->description;
        $task->task_category_id = $request->category;
        $task->start_date       = $request->start_date;
        $task->due_date         = $request->due_date;
        $task->user_id          = $request->assigned;
        $task->created_by       = Auth::user()->id;
        $task->status           = $request->status;
        $task->priority         = $request->priority;
        $task->save();

        $taskcompleted = Task::where([
            'project_id'    => $request->project,
            'status'        => 'completed'
            ])->count();
        $taskcount = Task::where([
            'project_id'    => $request->project,
            ])->count();
        $percent = ($taskcompleted!=0) ? ($taskcount/$taskcompleted)*100 : 0;
        Project::where('id', $request->project)->update([
            'completion_percent'    => round($percent),
        ]);

        Alert::success('Success', 'Your data has been added.');
        return redirect()->route('admin.tasks');
    }

    public function addCat(Request $request)
    {
        TaskCategory::create(['category_name' => $request->category]);
        Alert::success('Success', 'Your data has been added.');
        return back();
    }

    public function destroyCat($id)
    {
        TaskCategory::where('id', $id)->delete();
        Alert::success('Deleted', 'Your data has been deleted.');
        return back();
    }

    public function ajax(Request $request)
    {
        $project_id = $request->input('project_id');

        $getuser = User::join('project_members', 'users.id', '=', 'project_members.user_id')
            ->where('project_members.project_id', $project_id)
            ->get();
        
        return response()->json($getuser);
    }

    public function destroy($id)
    {
        Task::where('id', $id)->delete();
        Alert::success('Deleted', 'Your data has been deleted.');
        return back();
    }

    public function edit($id)
    {
        $tasks      = Task::where('id', $id)->first();
        $emp        = User::all();
        $category   = TaskCategory::all();
        $project    = Project::all();

        $data = [
            'tasks'     => $tasks,
            'emp'       => $emp,
            'category'  => $category,
            'projects'  => $project,
        ];
        return view('admin.task.edit')->with($data);
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'project'       => 'required',
            'title'         => 'required|string',
            'category'      => 'required|integer',
            'description'   => 'nullable',
            'start_date'    => 'nullable',
            'due_date'      => 'required|date',
            'assigned'      => 'required',
            'status'        => 'required',
            'priority'      => 'required',
        ]);

        $task = Task::findOrFail($request->id);
        $task->project_id       = $request->project;
        $task->title            = $request->title;
        $task->description      = $request->description;
        $task->task_category_id = $request->category;
        $task->start_date       = $request->start_date;
        $task->due_date         = $request->due_date;
        $task->user_id          = $request->assigned;
        $task->status           = $request->status;
        $task->priority         = $request->priority;
        $task->save();

        $taskcompleted = Task::where([
            'project_id'    => $request->project,
            'status'        => 'completed'
            ])->count();
        $taskcount = Task::where([
            'project_id'    => $request->project,
            ])->count();
        $percent = ($taskcompleted!=0) ? ($taskcount/$taskcompleted)*100 : 0;
        Project::where('id', $request->project)->update([
            'completion_percent'    => round($percent),
        ]);

        Alert::success('Success', 'Your data has been updated.');
        return redirect()->route('admin.tasks');
    }
}
