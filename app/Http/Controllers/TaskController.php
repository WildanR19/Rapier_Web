<?php

namespace App\Http\Controllers;

use App\Helpers\ProjectActivity;
use App\Http\Widget\Widget;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\TaskComment;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TaskController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id != 1) {
            $task = Task::leftJoin('projects as p', 'p.id', '=', 'tasks.project_id')
                    ->join('users as u', 'u.id', '=', 'tasks.user_id')
                    ->leftJoin('users as creator', 'creator.id', '=', 'tasks.created_by')
                    ->where('tasks.user_id', Auth::user()->id)
                    ->select('tasks.*', 'u.name', 'u.profile_photo_path', 'creator.name as created_by_name', 'creator.profile_photo_path as created_by_image', 'p.project_name')
                    ->latest()->get();
        } else {
            $task = Task::leftJoin('projects as p', 'p.id', '=', 'tasks.project_id')
                    ->join('users as u', 'u.id', '=', 'tasks.user_id')
                    ->leftJoin('users as creator', 'creator.id', '=', 'tasks.created_by')
                    ->select('tasks.*', 'u.name', 'u.profile_photo_path', 'creator.name as created_by_name', 'creator.profile_photo_path as created_by_image', 'p.project_name')
                    ->latest()->get();
        }
        
        $data = [
            'tasks' => $task,
        ];
        return view('admin.task.index')->with($data);
    }

    public function add()
    {
        if (Auth::user()->role_id == 1) {
            $project = Project::all();
        } else {
            $project = Project::whereHas('members', function(Builder $query) {
                $query->where('user_id', '=', Auth::user()->id);
            })->latest()->get();
        }
        $category = TaskCategory::all();
        $user = User::all();
        $data = [
            'projects' => $project,
            'category' => $category,
            'users' => $user
        ];
        return view('admin.task.add')->with($data);
    }

    public function getEmployee($project)
    {
        $data = ProjectMember::where('project_id', $project)
                ->leftJoin('users as u', 'u.id', '=', 'project_members.user_id')
                ->select('project_members.user_id', 'u.name')->get();
        return $data;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'project'       => 'required',
            'category'      => 'required|integer',
            'start_date'    => 'required|date',
            'due_date'      => 'required|date',
            'title'         => 'required',
            'description'   => 'nullable',
            'priority'      => 'required'
        ]);
        if (Auth::user()->role_id == 1) {
            $this->validate($request, [
                'assigned'      => 'required',
            ]);
        }

        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->start_date = $request->start_date;
        $task->due_date = $request->due_date;

        $user = User::where('id', $request->assigned)->first();
        $username = (Auth::user()->role_id == 1) ? $user->name : Auth::user()->name;
        if (Auth::user()->role_id == 1) {
            $task->user_id = $request->assigned;
            $activity = Auth::user()->name . " added new task assigned to " . $username;
        } else {
            $task->user_id = Auth::user()->id;
            $activity = Auth::user()->name . " added new task";
        }
        $task->project_id = $request->project;
        $task->task_category_id = $request->category;
        $task->priority = $request->priority;
        $task->created_by = Auth::user()->id;
        $task->save();

        $widget = new Widget();
        $widget->calculateProjectProgressPercent($request->project);

        ProjectActivity::addToActivity($request->project, $activity);

        Alert::success('Success', 'Your data has been added.');
        return redirect()->route('dash.task');
    }

    public function details($id)
    {
        
        $task = Task::where('tasks.id', $id)
                ->leftJoin('projects as p', 'p.id', '=', 'tasks.project_id')
                ->join('users as u', 'u.id', '=', 'tasks.user_id')
                ->leftJoin('users as creator', 'creator.id', '=', 'tasks.created_by')
                ->select('tasks.*', 'u.name', 'u.profile_photo_path', 'creator.name as created_by_name', 'creator.profile_photo_path as created_by_image', 'p.project_name')
                ->first();
        $comment = TaskComment::where('task_id', $id)->latest()->get();
        $data = [
            'tasks' => $task,
            'comments' => $comment
        ];
        // return dd($task);
        return view('admin.task.detail')->with($data);
    }

    public function edit($id)
    {
        $project = Project::all();
        $task = Task::where('id', $id)->first();
        $category = TaskCategory::all();
        $data = [
            'projects' => $project,
            'task' => $task,
            'category' => $category
        ];
        return view('admin.task.edit')->with($data);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'project'       => 'required',
            'category'      => 'required|integer',
            'start_date'    => 'required|date',
            'due_date'      => 'required|date',
            'title'         => 'required',
            'description'   => 'nullable',
            'status'        => 'required',
            'priority'      => 'required'
        ]);
        $task = Task::findOrFail($request->id);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->start_date = $request->start_date;
        $task->due_date = $request->due_date;
        $task->project_id = $request->project;
        $task->task_category_id = $request->category;
        $task->priority = $request->priority;
        $task->status = $request->status;
        $task->save();

        $widget = new Widget();
        $widget->calculateProjectProgressPercent($request->project);

        if ($request->status == "completed") {
            $activity = "Task " . $task->title . " has been completed";
            ProjectActivity::addToActivity($task->project_id, $activity);
        }

        Alert::success('Success', 'Your data has been updated.');
        return redirect()->route('dash.task');
    }

    public function destroy($id)
    {
        $task = Task::where('id', $id)->first();
        $activity = Auth::user()->name . " delete task " . $task->title;
        ProjectActivity::addToActivity($task->project_id, $activity);

        Task::where('id', $id)->delete();
        Alert::success('Deleted', 'Your data has been deleted.');

        return back();
    }

    public function addCat(Request $request)
    {
        TaskCategory::create(['category_name' => $request->category_name]);
        Alert::success('Success', 'Your data has been added.');
        return back();
    }

    public function destroyCat($id)
    {
        TaskCategory::where('id', $id)->delete();
        Alert::success('Deleted', 'Your data has been deleted.');
        return back();
    }

    public function destroyComment($id)
    {
        $comment = TaskComment::find($id);
        Storage::disk('public')->delete($comment->file);
        $comment->delete();
        Alert::success('Success', 'Your comment has been deleted.');
        return back();
    }

    public function submitComment(Request $request)
    {
        $this->validate($request,[
            'comment'   => 'required',
            'file'      => 'nullable|max:10240',
        ]);

        $task = new TaskComment();
        $task->comment = $request->comment;
        if($request->hasFile('file')){
            $file = $request->file('file');
            $filename = time()."_".$file->getClientOriginalName();
            $file->storeAs('public/task_files', $filename);
            $path = 'task_files/'.$filename;
            $task->file  = $path;
        }
        $task->task_id = $request->task_id;
        $task->user_id = Auth::user()->id;
        $task->save();
        Alert::success('Success', 'Your update has been post.');
        return back();
    }

    public function fileDownload($id)
    {
        $file = TaskComment::where('id', $id)->first();
        $path = public_path().'/storage/'.$file->file;
        return Response::download($path);
    }

    public function completedStatus($id)
    {
        Task::where('id', $id)->update(['status' => 'completed']);
        
        $task = Task::where('id', $id)->first();
        $widget = new Widget;
        $widget->calculateProjectProgressPercent($task->project_id);

        $activity = "Task " . $task->title . " has been completed";
        ProjectActivity::addToActivity($task->project_id, $activity);

        Alert::success('Success', 'Task updated succesfully.');
        return back();
    }

    public function incompleteStatus($id)
    {
        Task::where('id', $id)->update(['status' => 'incomplete']);
        
        $task = Task::where('id', $id)->first();
        $widget = new Widget;
        $widget->calculateProjectProgressPercent($task->project_id);

        Alert::success('Success', 'Task updated succesfully.');
        return back();
    }
}
