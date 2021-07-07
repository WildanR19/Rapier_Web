<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ProjectActivity;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\ProjectUpdate;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProjectController extends Controller
{
    public function index()
    {
        $project = Project::whereHas('members', function(Builder $query) {
            $query->where('user_id', '=', Auth::user()->id);
        })->orderByDesc('created_at')->get();
        $member = ProjectMember::all();
        $data = [
            'projects'  => $project,
            'members'   =>$member,
        ];
        return view('employee.projects.index')->with($data);
    }

    public function details($id)
    {
        $project    = Project::where('id', $id)->first();
        $teammember = ProjectMember::where('project_id', $id)->get();
        $user       = User::all();
        $task       = Task::where('tasks.project_id', $id)
                        ->leftJoin('projects as p', 'p.id', '=', 'tasks.project_id')
                        ->join('users as u', 'u.id', '=', 'tasks.user_id')
                        ->leftJoin('users as creator', 'creator.id', '=', 'tasks.created_by')
                        ->select('tasks.*', 'u.name', 'u.profile_photo_path', 'creator.name as created_by_name', 'creator.profile_photo_path as created_by_image', 'p.project_name')
                        ->get();
        $activity   = ProjectActivity::activityLists($id);

        $data = [
            'project'       => $project,
            'members'       => $teammember,
            'user'          => $user,
            'tasks'         => $task,
            'activities'    => $activity
        ];
        return view('employee.projects.detail2')->with($data);
    }

    public function submit_update(Request $request)
    {
        $this->validate($request,[
            'comment'   => 'required',
            'file'      => 'nullable|max:10240',
        ]);

        $project = new ProjectUpdate();
        $project->comment = $request->comment;
        if($request->hasFile('file')){
            $file = $request->file('file');
            $filename = time()."_".$file->getClientOriginalName();
            $file->storeAs('public/project_files', $filename);
            $path = 'project_files/'.$filename;
            $project->file  = $path;
        }
        $project->project_id = $request->project_id;
        $project->user_id = Auth::user()->id;
        $project->save();
        Alert::success('Success', 'Your update has been post.');
        return back();
    }

    public function destroy($id)
    {
        $project = ProjectUpdate::find($id);
        Storage::disk('public')->delete($project->file);
        $project->delete();
        Alert::success('Success', 'Your comment has been deleted.');
        return back();
    }

    public function download($id)
    {
        $file = ProjectUpdate::where('id', $id)->first();
        $path = public_path().'/storage/'.$file->file;
        return Response::download($path);
    }
}
