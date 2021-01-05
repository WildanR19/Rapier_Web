<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectMember;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function add()
    {
        $emp = User::all();
        $category = ProjectCategory::all();
        
        $data = [
            'emp'   => $emp,
            'category'  => $category,
        ];
        return view('employee.projects.add')->with($data);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'project_name'  => 'required|string',
            'category'      => 'required|integer',
            'start_date'    => 'required|date',
            'deadline'      => 'required|date',
            'member'        => 'required',
            'status'        => 'required',
            'summary'       => 'nullable',
            'note'          => 'nullable',
        ]);

        $project = new Project();
        $project->project_name      = $request->project_name;
        $project->category_id       = $request->category;
        $project->start_date        = $request->start_date;
        $project->deadline          = $request->deadline;
        $project->status            = $request->status;
        $project->project_summary   = $request->summary;
        $project->notes             = $request->note;
        $project->submitted_by      = Auth::user()->id;
        $project->save();

        $user = $request->member;
        foreach ($user as $users) {
            $member = new ProjectMember();
            $member->user_id    = $users;
            $member->project_id = $project->id;
            $member->save();
        }
        Alert::success('Success', 'Your data has been added.');
        return redirect()->route('dash.projects');
    }

    public function details($id)
    {
        $project = Project::where('id', $id)->first();
        $member = ProjectMember::all();
        $data = [
            'projects'  => $project,
            'members'   =>$member,
        ];
        return view('employee.projects.detail')->with($data);
    }

    public function destroy($id)
    {
        Project::find($id)->delete();
        Alert::success('Success', 'Your project has been deleted.');
        return redirect()->route('dash.projects');
    }

    public function edit($id)
    {
        $project    = Project::where('id', $id)->first();
        $category   = ProjectCategory::all();
        $emp        = User::all();
        $teammember = ProjectMember::where('project_id', $id)->get();
        
        $data = [
            'project'   => $project,
            'category'  => $category,
            'emp'       => $emp,
            'teammember'=> $teammember,
        ];
        return view('employee.projects.edit')->with($data);
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'project_name'  => 'required|string',
            'category'      => 'required|integer',
            'start_date'    => 'required|date',
            'deadline'      => 'required|date',
            'status'        => 'required',
            'summary'       => 'nullable',
            'note'          => 'nullable',
        ]);

        $project = Project::findOrFail($request->id);
        $project->project_name      = $request->project_name;
        $project->category_id       = $request->category;
        $project->start_date        = $request->start_date;
        $project->deadline          = $request->deadline;
        $project->status            = $request->status;
        $project->project_summary   = $request->summary;
        $project->notes             = $request->note;
        $project->save();

        Alert::success('Success', 'Your data has been updated.');
        return redirect()->route('dash.projects.details',$project->id);
    }
}
