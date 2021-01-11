<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Goal;
use App\Models\Job;
use App\Models\Leave;
use App\Models\Project;
use App\Models\ProjectUpdate;
use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id == 1) {
            $department     = Department::all();
            $job            = Job::all();
            $user           = User::all();
            $project        = Project::all();
            $leave_pending  = Leave::where('status', 'pending')->orderByDesc('created_at')->take(5)->get();

            $status = ['not started', 'in progress', 'on hold', 'canceled', 'finished'];
            $record = [];
            foreach ($status as $key => $value) {
                $record['data'][] = Project::where('status',$value)->count();
            }
            $record['label'] = $status;
            $record['chart_data'] = json_encode($record);

            $record_leave = [];
            $result = CarbonPeriod::create('2021-01-01', '1 month', '2021-12-01');
            $year = date("Y");
            foreach ($result as $dt) {
                $record_leave['label'][] = $dt->format("F");
                $record_leave['data_approve'][] = Leave::where('status', 'approved')->whereMonth('from_date', $dt->format("m"))->whereYear('from_date', $year)->count();
                $record_leave['data_reject'][] = Leave::where('status', 'rejected')->whereMonth('from_date', $dt->format("m"))->whereYear('from_date', $year)->count();
            }
            $record_leave['leave_data'] = json_encode($record_leave);
        
            $data = [
                'departments'   => $department,
                'jobs'          => $job,
                'users'         => $user,
                'projects'      => $project,
                'leaves'        => $leave_pending,
            ];
            return view('admin.home')->with($data)->with($record)->with($record_leave);
        }else if(Auth::user()->role_id == 2){
            $pu = ProjectUpdate::whereHas('project.members', function($query) {
                $query->where('user_id', '=', Auth::user()->id);
            })->orderByDesc('created_at')->get();

            $auth = Auth::user()->id;
            $pg = Goal::where('user_id', $auth)->get();

            $record_leave = [];
            $result = CarbonPeriod::create('2021-01-01', '1 month', '2021-12-01');
            $year = date("Y");
            foreach ($result as $dt) {
                $record_leave['label'][] = $dt->format("F");
                $record_leave['data_approve'][] = Leave::where([
                    'user_id'   => $auth,
                    'status'    => 'approved',
                ])->whereMonth('from_date', $dt->format("m"))->whereYear('from_date', $year)->count();
                $record_leave['data_reject'][] = Leave::where([
                    'user_id'   => $auth,
                    'status'    => 'rejected',
                ])->whereMonth('from_date', $dt->format("m"))->whereYear('from_date', $year)->count();
            }
            $record_leave['leave_data'] = json_encode($record_leave);

            $data = [
                'updates'   => $pu,
                'pg'        => $pg,
            ];
            return view('home')->with($data)->with($record_leave);
        }
    }
}
