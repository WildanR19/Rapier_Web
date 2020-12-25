<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LeaveController extends Controller
{
    public function index()
    {
        $leave = Leave::all();
        $count = $leave->where('status', 'pending')->count();
        return view('admin.leaves.index')->with('leave', $leave)->with('count', $count);
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
        Leave::where('id',$id)->update(['status' => 'approved']);
        Alert::success('Approved', 'Your leave has been approved.');
        return back();
    }
    public function reject(Request $request, $id)
    {
        Leave::where('id',$id)->update(['status' => 'rejected', 'reject_reason' => $request->reason]);
        Alert::error('Rejected', 'Your leave has been rejected.');
        return back();
    }
}
