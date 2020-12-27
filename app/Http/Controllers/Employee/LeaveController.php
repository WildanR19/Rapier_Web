<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LeaveController extends Controller
{
    public function index()
    {
        $user       = Auth::user();
        $leave      = Leave::where('user_id', $user->id)->orderByDesc('created_at')->get();
        $leaveType  = LeaveType::all();

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
            'leave'         => $leave,
            'leavetype'     => $leaveType,
        ];
        return view('employee.leave.index')->with($data);
    }

    public function store(Request $request)
    {
        $leave = new Leave();

        $leave->user_id         = Auth::user()->id;
        $leave->leave_type_id   = $request->type;
        $leave->duration        = $request->duration;
        $leave->from_date       = $request->fromdate;
        $leave->to_date         = $request->todate;
        $leave->reason          = $request->reason;
        $leave->status          = 'pending';
        $leave->save();

        Alert::success('Success', 'Your leave has been assign.');
        return back();
    }

    public function update($id)
    {
    	$leave = Leave::find($id);

	    return response()->json([
	      'data' => $leave
	    ]);
    }

    public function edit(Request $request, $id)
    {
        Leave::where('id', $id)
                ->where('user_id', $request->user_id)
                ->update([
                    'leave_type_id' => $request->type,
                    'duration'      => $request->duration,
                    'from_date'     => $request->fromdate,
                    'to_date'       => $request->todate,
                    'reason'        => $request->reason,
                ]);
        Alert::success('Updated', 'Your data has been updated.');
        return response()->json([ 'success' => true ]);
    }

    public function destroy($id)
    {
        Leave::find($id)->delete();
        Alert::success('Cancel', 'Your leave has been canceled.');
        return back();
    }
}
