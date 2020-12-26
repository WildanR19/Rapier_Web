<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee_detail;
use App\Models\Job;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class EmployeeController extends Controller
{
    public function index()
    {
    	// Get all data user
        $user = User::all();
    	// return data to view
        return view('admin.employee.index')->with('user', $user);
    }

    public function add()
    {
        $dept = Department::all();
        $role = Role::all();
        $job = Job::all();
        $data = 
        [
            'dept'  => $dept,
            'role'  => $role,
            'job'   => $job,
        ];
        return view('admin.employee.add')->with($data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|string|min:5|max:50',
            'email'     => 'required|email',
            'password'  => 'required',
            'role'      => 'required',
            'address'   => 'required',
            'dept'      => 'required',
            'job'       => 'required',
            'gender'    => 'required',
            'join_date' => 'required|date',
            'last_date' => 'nullable',
            'photo'     => 'nullable|file|image|mimes:jpeg,png,jpg,svg|max:1024',
        ]);

        if($request->last_date < now() && !empty($request->last_date)){
            $status = 'deactive';
        }else{
            $status = 'active';
        }

        $user_data =new User();
        $user_data->name        = $request->name;
        $user_data->email       = $request->email;
        $user_data->password    = Hash::make($request->password);
        $user_data->role_id     = $request->role;
        $user_data->status      = $status;
        if($request->hasFile('photo')){
            $path = Storage::disk('public')->put('profile-photos', new File(request()->file('photo')));
            $user_data->profile_photo_path  = $path;
        }
        $user_data->save();

        $ed = new Employee_detail();
        $ed->user_id        = $user_data->id;
        $ed->address        = $request->address;
        $ed->gender         = $request->gender;
        $ed->job_id         = $request->job;
        $ed->department_id  = $request->dept;
        $ed->join_date      = $request->join_date;
        $ed->last_date      = $request->last_date;
        $ed->save();

        Alert::success('Success', 'Your data has been added.');
        return redirect()->route('admin.employee');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        Storage::disk('public')->delete($user->profile_photo_path);
        $user->delete();
        Alert::success('Deleted', 'Your data has been deleted.');
        return back()->with('success','Data deleted successfully');
    }

    public function edit($id)
    {
        $user   = User::where('id', $id)->first();
        $ed     = Employee_detail::where('user_id', $id)->first();
        $dept   = Department::all();
        $role   = Role::all();
        $job    = Job::all();
        $data = [
            'user'  => $user,
            'ed'    => $ed,
            'dept'  => $dept,
            'role'  => $role,
            'job'   => $job,
        ];
        return view('admin.employee.edit')->with($data);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|string|min:5|max:50',
            'email'     => 'required|email',
            'role'      => 'required',
            'address'   => 'required',
            'dept'      => 'required',
            'job'       => 'required',
            'gender'    => 'required',
            'join_date' => 'required|date',
            'last_date' => 'nullable',
            'photo'     => 'nullable|file|image|mimes:jpeg,png,jpg,svg|max:1024',
        ]);

        if($request->last_date < now() && !empty($request->last_date)){
            $status = 'deactive';
        }else{
            $status = 'active';
        }

        $emp = User::findOrFail($request->id);
        $emp->name      = $request->name;
        $emp->email     = $request->email;
        if(!empty($request->password)){
            $emp->password  = Hash::make($request->password);
        }
        $emp->role_id   = $request->role;
        $emp->status    = $status;
        if($request->hasFile('photo')){
            $path = Storage::disk('public')->put('profile-photos', new File(request()->file('photo')));
            $emp->profile_photo_path  = $path;
        }
        $emp->save();

        Employee_detail::where('user_id', $request->id)
        ->update([
            'address'       => $request->address,
            'gender'        => $request->gender,
            'job_id'        => $request->job,
            'department_id' => $request->dept,
            'join_date'     => $request->join_date,
            'last_date'     => $request->last_date,
        ]);

        return redirect()->route('admin.employee');
    }

    public function details($id)
    {
        $user   = User::where('id', $id)->first();
        $ed     = Employee_detail::where('user_id', $id)->first();
        $dept   = Department::all();
        $role   = Role::all();
        $job    = Job::all();
        $leave  = Leave::where('user_id', $id)->get();
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

        $card = '
        <div class="row">
            <div class="col-md-6 border-right col-in">
                <h5 class="description-header">Tasks Done</h5>
                <div class="row font-larger">
                    <div class="col-md-4 px-2"><i class="fas fa-tasks text-success"></i></div>
                    <div class="col-md-8 px-2 text-right">0</div>
                </div>
            </div>
            <div class="col-md-6 col-in">
                <h5 class="description-header">Leaves Taken</h5>
                <div class="row font-larger">
                    <div class="col-md-4 px-2"><i class="nav-icon fas fa-calendar-times text-warning"></i></div>
                    <div class="col-md-8 px-2 text-right">'.$leaveCount.'</div>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6 border-right col-in">
                <h5 class="description-header">LEAVES REMAINING</h5>
                <div class="row font-larger">
                    <div class="col-md-4 px-2"><i class="nav-icon fas fa-calendar-times text-danger"></i></i></div>
                    <div class="col-md-8 px-2 text-right">'.$leaveRemaining.'</div>
                </div>
            </div>
        </div>';
            
        foreach($leaveType as $lt){
            $countLeaveType = Leave::where('user_id', $id)->where('leave_type_id', $lt->id)->get();
            $leaveTypeCount = 0;
            foreach($countLeaveType as $lv){
                $tda = strtotime($lv->to_date);
                $fda = strtotime($lv->from_date);
                $counta = floor(($tda-$fda) / (60 * 60 * 24))+1;
                if($lv->duration == 'half day'){
                    $counta = $counta/2;
                }
                $leaveTypeCount += $counta;
            }
            $leaveTab[] = '<li class="nav-item"><p class="nav-link">'.$lt->type_name.' <span class="float-right badge bg-'.$lt->color.' badge">'.$leaveTypeCount.'</span></p></li>';
        }

        $data = [
            'user'      => $user,
            'ed'        => $ed,
            'dept'      => $dept,
            'role'      => $role,
            'job'       => $job,
            'leave'     => $leave,
            'card'      => $card,
            'leaveTab'  => $leaveTab,
        ];
        return view('admin.employee.details')->with($data);
    }
}
