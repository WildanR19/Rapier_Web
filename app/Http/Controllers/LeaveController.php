<?php

namespace App\Http\Controllers;

use App\Exports\LeaveExport;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\User;
use App\Notifications\LeavesNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;

class LeaveController extends Controller
{
    public function index()
    {
        $leave  = Leave::orderByDesc('created_at')->get();
        $emp    = User::all();
        $count = $leave->where('status', 'pending')->count();
        $small_box = '
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>'.$count.'</h3>
                    <p>Pending Leaves</p>
                </div>
                <div class="icon">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
            </div>
            ';
        $data = [
            'leave'     => $leave,
            'smallbox'  => $small_box,
            'emp'       => $emp,
        ];
        return view('admin.leaves.index')->with($data);
    }

    public function add()
    {
        $emp = User::all();
        $type = LeaveType::all();
        $data = [
            'emp'   => $emp,
            'type'  => $type,
        ];
        return view('admin.leaves.add')->with($data);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'employee'  => 'required',
            'type'      => 'required',
            'duration'  => 'required',
            'fromdate'  => 'required',
            'todate'    => 'required',
            'status'    => 'required',
            'reason'    => 'required',
        ]);
        Leave::create([
            'user_id'       => $request->employee,
            'leave_type_id' => $request->type,
            'duration'      => $request->duration,
            'from_date'     => $request->fromdate,
            'to_date'       => $request->todate,
            'reason'        => $request->reason,
            'status'        => $request->status,
        ]);
        Alert::success('Success', 'Your data has been added.');
        return redirect()->route('admin.leaves');
    }

    public function approve($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->update(['status' => 'approved']);
        
        $user = User::findOrFail($leave->user_id);
        $leaveData = [
            'leave_id'  => $id,
            'type'      => 'leave_accept',
            'username'  => Auth::user()->name,
        ];
        $user->notify(new LeavesNotification($leaveData));
        
        Alert::success('Approved', 'Leave has been approved.');
        return back();
    }
    public function reject(Request $request, $id)
    {
        Leave::where('id',$id)->update(['status' => 'rejected', 'reject_reason' => $request->reason]);

        $leave = Leave::findOrFail($id);
        $user = User::findOrFail($leave->user_id);
        $leaveData = [
            'leave_id'  => $id,
            'type'      => 'leave_reject',
            'username'  => Auth::user()->name,
        ];

        Alert::error('Rejected', 'Leave has been rejected.');
        $user->notify(new LeavesNotification($leaveData));

        return response()->json([ 'success' => true ]);
    }

    public function add_type(Request $request)
    {
        $this->validate($request,[
            'type'      => 'required|string',
            'color'     => 'required|string',
        ]);
        LeaveType::create([
            'type_name' => $request->type,
            'color'     => $request->color,
        ]);
        Alert::success('Success', 'Your data has been added.');
        return back();
    }

    public function destroy_type($id)
    {
        LeaveType::where('id', $id)->delete();
        Alert::success('Deleted', 'Your data has been deleted.');
        return back();
    }

    public function destroy($id)
    {
        Leave::find($id)->delete();
        Alert::success('Deleted', 'Your data has been deleted.');
        return back();
    }

    public function export(Request $request)
    {
        $user = User::where('id', $request->employee)->first()->name;
        return Excel::download(new LeaveExport($request->employee, $request->month, $request->year), 'Leaves_'.$user.'('.$request->month.'-'.$request->year.').xlsx');
    }
    
}
