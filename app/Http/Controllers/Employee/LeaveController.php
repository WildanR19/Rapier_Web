<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function index()
    {
        $user   = Auth::user();
        $leave  = Leave::where('user_id', $user->id)->get();

        // $leaveCount = $leave->where('status', '!=', 'rejected')->count();
        $leaveApprove = Leave::where('user_id', $user->id)->where('status', '!=', 'rejected')->get();

        $leaveCount = 0;
        foreach($leaveApprove as $la){
            $td = strtotime($la->to_date);
            $fd = strtotime($la->from_date);
            $count = floor(($td-$fd) / (60 * 60 * 24))+1;
            if($la->duration == 'half day'){
                $count = $count/2;
            }
            $leaveCount += $count;
        }
        $leaveRemaining = 15 - $leaveCount;
        
        $leave_header = '
            <div class="row mt-4">
                <div class="col-auto">
                    <div class="image">
                        <img src="'.$user->profile_photo_url.'" class="img-circle elevation-2" alt="User Image" width="80px">
                    </div>
                </div>
                <div class="col my-auto">
                    <div>
                        <h5>'.$user->name.'</h5>
                        <i>'.$user->employee_detail->job->name.'</i>
                    </div>
                </div>
                <div class="col-auto mr-4">
                    <strong><i>Period</i></strong><br>
                    <strong><i>Total Leave This Period</i></strong><br>
                    <strong><i>Total Leave Remaining</i></strong><br>
                </div>
                <div class="col-auto">
                    '.date("Y").' <br> '.$leaveCount.' day(s) <br> '.$leaveRemaining.' day(s)
                </div>
            </div>
            ';

        $data = [
            'leave_header'  => $leave_header,
            'user'          => $user,
            'leave'         => $leave,
        ];
        return view('employee.leave.index')->with($data);
    }


}
