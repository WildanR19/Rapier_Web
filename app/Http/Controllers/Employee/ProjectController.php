<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\ProjectUpdate;
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
        $project = Project::where('id', $id)->first();
        $member = ProjectMember::all();
        $update = ProjectUpdate::where('project_id', $id)->orderByDesc('created_at')->get();
        $data = [
            'projects'  => $project,
            'members'   => $member,
            'updates'   => $update,
        ];
        return view('employee.projects.detail')->with($data);
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
