<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectMember;
use App\Models\ProjectUpdate;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProjectController extends Controller
{
    public function index()
    {
        $project    = Project::orderByDesc('created_at')->get();

        $status = ['not started', 'in progress', 'on hold', 'canceled', 'finished'];
        
        foreach ($status as $stat) {
            if ($stat == 'not started') {
                $color = 'dark';
            }elseif ($stat == 'in progress') {
                $color = 'info';
            }elseif ($stat == 'on hold') {
                $color = 'warning';
            }elseif ($stat == 'canceled') {
                $color = 'danger';
            }else{
                $color = 'success';
            }
            $count = $project->where('status', $stat)->count();
            $small_box[] = '
            <div class="col-md-3 col-6">
                <div class="small-box bg-'.$color.'">
                    <div class="inner">
                        <h3>'.$count.'</h3>
                        <p class="text-capitalize">'.$stat.' Projects</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-layer-group"></i>
                    </div>
                </div>
            </div>';
        }

        $teammember = ProjectMember::all();

        $data       = [
            'project'   => $project,
            'smallbox'  => $small_box,
            'teammember'=> $teammember,
        ];
        return view('admin.project.index')->with($data);
    }

    public function add()
    {
        $emp = User::all();
        $category = ProjectCategory::all();
        
        $data = [
            'emp'   => $emp,
            'category'  => $category,
        ];
        return view('admin.project.add')->with($data);
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
        return redirect()->route('admin.projects');
    }

    public function addCat(Request $request)
    {
        ProjectCategory::create(['category_name' => $request->category]);
        Alert::success('Success', 'Your data has been added.');
        return back();
    }

    public function destroyCat($id)
    {
        ProjectCategory::where('id', $id)->delete();
        Alert::success('Deleted', 'Your data has been deleted.');
        return back();
    }

    public function destroy($id)
    {
        Project::where('id', $id)->delete();
        Alert::success('Deleted', 'Your data has been deleted.');
        return back();
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
        return view('admin.project.edit')->with($data);
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
        return redirect()->route('admin.projects');
    }

    public function details($id)
    {
        $project    = Project::where('id', $id)->first();
        $category   = ProjectCategory::all();
        $user       = User::all();
        $teammember = ProjectMember::where('project_id', $id)->get();
        $empEx      = $teammember->pluck('user_id');
        $emp        = User::whereNotIn('id', $empEx)->get();
        $updates    = ProjectUpdate::where('project_id', $id)->get();
        
        $data = [
            'project'   => $project,
            'user'      => $user,
            'category'  => $category,
            'emp'       => $emp,
            'teammember'=> $teammember,
            'updates'   => $updates,
        ];
        return view('admin.project.details')->with($data);
    }

    public function member_destroy($id)
    {
        ProjectMember::where('id', $id)->delete();
        return back();
    }

    public function member_add(Request $request)
    {
        $user = $request->member;
        foreach ($user as $users) {
            $member = new ProjectMember();
            $member->user_id    = $users;
            $member->project_id = $request->id;
            $member->save();
        }
        return back();
    }
}
