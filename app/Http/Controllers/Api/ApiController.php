<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ProjectActivity;
use App\Http\Controllers\Controller;
use App\Http\Widget\Widget;
use App\Models\BasicPay;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Employee_detail;
use App\Models\EmployeeStatus;
use App\Models\Holiday;
use App\Models\Job;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\Payslip;
use App\Models\Project;
use App\Models\ProjectActivity as ModelsProjectActivity;
use App\Models\ProjectCategory;
use App\Models\ProjectMember;
use App\Models\ProjectUpdate;
use App\Models\Role;
use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\TaskComment;
use App\Notifications\LeavesNotification;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->where('status', 'active')->first();
        $response = [];
        if($user){
            if(password_verify($request->password, $user->password)){
                $response['status'] = true;
                $response['message'] = 'Login Success';
                $response['data'] = [
                    'user_id'   => $user->id,
                    'name'      => $user->name,
                    'email'     => $user->email,
                    'role_id'   => $user->role_id,
                    'pp_path'   => $user->profile_photo_path
                ];
                $json = json_encode($response, JSON_PRETTY_PRINT);
                echo $json;
            }else{
                return $this->error("Wrong Password");
            }
        }else{
            return $this->error("Email is not registered");
        }
    }

    public function home_dashboard()
    {
        $emp = User::count();
        $dept = Department::count();
        $job = Job::count();
        $project = Project::count();
        return response()->json([
            'status' => true, 
            'message' => 'Data Available',
            'data'  => [
                'total_employee' => $emp,
                'total_department'  => $dept,
                'total_job'  => $job,
                'total_project'  => $project
            ]
        ]);
    }

    // Employee
    public function user_list()
    {
        $data = DB::table('users as u')
                ->Join('employee_details as ed', 'u.id', '=', 'ed.user_id')
                ->join('jobs as j', 'ed.job_id', '=', 'j.id')
                ->select('u.id', 'u.name', 'u.email', 'u.role_id', 'u.status', 'u.profile_photo_path', 'j.name as job')
                ->groupBy('u.id')
                ->get();
        return response()->json([
            'status' => true, 
            'message' => 'Data Available',
            'data'  => $data
        ]);
    }

    public function user_list_byID($id)
    {
        $data = DB::table('users as u')
                ->where('u.id', $id)
                ->Join('employee_details as ed', 'u.id', '=', 'ed.user_id')
                ->join('jobs as j', 'ed.job_id', '=', 'j.id')
                ->select('u.id', 'u.name', 'u.email', 'u.role_id', 'u.status', 'u.profile_photo_path', 'j.name as job')
                ->groupBy('u.id')
                ->first();
        return response()->json([
            'status' => true, 
            'message' => 'Data Available',
            'data'  => $data
        ]);
    }

    public function user_add()
    {
        $dept   = Department::select('id','name')->get();
        $role   = Role::select('id','name')->get();
        $job    = Job::select('id','name')->get();
        $status = EmployeeStatus::select('id','status_name')->get();
        return response()->json([
            'data_dept'  => $dept,
            'data_role'  => $role,
            'data_job'   => $job,
            'data_status'=> $status,
        ]);
    }

    public function user_store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'name'      => 'required|string|min:5|max:50',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8',
            'role'      => 'required|integer',
            'address'   => 'required',
            'dept'      => 'required|integer',
            'job'       => 'required|integer',
            'phone'     => 'required|regex:/(08)[0-9]{10}/|max:14',
            'gender'    => 'required',
            'join_date' => 'required|date',
            'status'    => 'required|integer',
            'photo'     => 'nullable|file|image|mimes:jpeg,png,jpg,svg|max:1024',
        ]);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }else{

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
            $ed->phone          = $request->phone;
            $ed->gender         = $request->gender;
            $ed->job_id         = $request->job;
            $ed->department_id  = $request->dept;
            $ed->join_date      = $request->join_date;
            $ed->last_date      = $request->last_date;
            $ed->status_id      = $request->status;
            $ed->save();

            return response()->json([
                'status' => true,
                'message' => 'Register Success',
                'data'  => [
                    'user_id'   => $user_data->id,
                    'name'   => $user_data->name,
                    'email'   => $user_data->email,
                ]
            ]);
        }

    }

    public function user_destroy($id)
    {
        $user = User::find($id);
        Storage::disk('public')->delete($user->profile_photo_path);
        $user->delete();
        return response()->json([ 'status' => true, 'message' => 'User has been deleted', ]);
    }

    public function user_update($id)
    {
        $user   = User::where('id', $id)->first();
        $ed     = Employee_detail::where('user_id', $id)->first();
        return response()->json([
            'data_user'  => $user,
            'data_ed'    => $ed,
        ]);
    }

    public function user_edit(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'name'      => 'required|string|min:5|max:50',
            'email'     => 'required|email',
            'role'      => 'required|integer',
            'address'   => 'required',
            'phone'     => 'required|regex:/(08)[0-9]{10}/|max:14',
            'dept'      => 'required|integer',
            'job'       => 'required|integer',
            'gender'    => 'required',
            'join_date' => 'required|date',
            'last_date' => 'nullable',
            'status'    => 'required|integer',
            'photo'     => 'nullable|file|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }else{

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
                Storage::disk('public')->delete($emp->profile_photo_path);
                $path = Storage::disk('public')->put('profile-photos', new File(request()->file('photo')));
                $emp->profile_photo_path  = $path;
            }
            $emp->save();

            Employee_detail::where('user_id', $request->id)
            ->update([
                'address'       => $request->address,
                'phone'         => $request->phone,
                'gender'        => $request->gender,
                'job_id'        => $request->job,
                'department_id' => $request->dept,
                'join_date'     => $request->join_date,
                'last_date'     => $request->last_date,
                'status_id'     => $request->status,
            ]);

            return response()->json([ 'status' => true, 'message' => 'Update Success' ]);
        }
    }

    public function employee_detail($id)
    {
        $data = Employee_detail::where('user_id', $id)->first();
        return response()->json([
            'status' => true,
            'message' => 'Data Available',
            'data' => $data
        ]);
    }

    public function employee_status()
    {
        $data = EmployeeStatus::all();
        return response()->json([
            'status' => true,
            'message' => 'Data Available',
            'data' => $data
        ]);
    }

    public function update_password(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'current_password'  => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }else{
            $profile = User::findOrFail($id);
            if (Hash::check($request->current_password, $profile->password)) {
                $profile->password = Hash::make($request->password);
                $profile->save();
                return response()->json([ 'status' => true, 'message' => 'Update Success' ]);
            }else{
                return $this->error("Current password is incorrect!");;
            }
        }
    }

    public function user_list_by_project($id)
    {
        $data = ProjectMember::where('project_id', $id)
                ->leftJoin('users as u', 'u.id', '=', 'project_members.user_id')
                ->select('project_members.user_id', 'u.name')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data Available',
            'data' => $data
        ]);
    }

    // Role
    public function role_list()
    {
        $data = Role::all();
        return response()->json([
            'status' => true,
            'message' => 'Data Available',
            'data' => $data
        ]);
    }

    // department
    public function dept_list()
    {
        $data = DB::table('departments as d')
                ->leftJoin('employee_details as ed', 'd.id', '=', 'ed.department_id' )
                ->select('d.id', 'd.name', DB::raw('count(ed.department_id) as total'))
                ->groupBy("d.id")
                ->get();
        return response()->json([
            'status' => true, 
            'message' => 'Data Available',
            'data'  => $data,
        ]);
    }

    public function dept_store(Request $request)
    {

        $validasi = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);
        
        if ($validasi->fails()) {

            $val = $validasi->errors()->all();
            return $this->error($val[0]);

        }else{

            Department::create([
                'name' => $request->name,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Add Data Success',
            ]);

        }
        
    }

    public function dept_edit(Request $request, $id)
    {
        Department::updateOrCreate(
            [ 'id' => $id ],
            [ 'name' => $request->name, ],
        );
        return response()->json([ 'status' => true, 'message' => 'Edit Success', ]);
    }

    public function dept_destroy($id)
    {
        Department::find($id)->delete();
        return response()->json([ 'status' => true, 'message' => 'Data has been deleted', ]);
    }

    // Job
    public function job_list()
    {
        // $data = Job::all();
        $data = DB::table('jobs as j')
                ->leftJoin('employee_details as ed', 'j.id', '=', 'ed.job_id' )
                ->select('j.id', 'j.name', DB::raw('count(ed.job_id) as total'))
                ->groupBy("j.id")
                ->get();
        return response()->json([
            'status' => true,
            'message' => "Data Available",
            'data'  => $data
        ]);
    }

    public function job_store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }else{
            Job::create([ 'name' => $request->name ]);
            return response()->json([
                'status' => true,
                'message' => 'Add Data Success',
            ]);
        }
        
    }

    public function job_edit(Request $request, $id)
    {
        Job::updateOrCreate(
            [ 'id' => $id ],
            [ 'name' => $request->name, ],
        );
        return response()->json([ 'status' => true, 'message' => 'Edit Success' ]);
    }

    public function job_destroy($id)
    {
        Job::find($id)->delete();
        return response()->json([ 'status' => true, 'message' => 'Data has been deleted', ]);
    }

    // Leave
    public function leave_type()
    {
        $data = LeaveType::all();
        return response()->json([
            'status' => true,
            'message' => "Data Available",
            'data'  => $data
        ]);
    }

    public function leave_list()
    {
        $data = Leave::latest()->get();

        return response()->json([
            'status' => true,
            'message' => "Data Available",
            'data'  => $data
        ]);
    }

    public function pending_leave_list()
    {
        $data = Leave::where('status', 'pending')->latest()->get();

        return response()->json([
            'status' => true,
            'message' => "Data Available",
            'data'  => $data
        ]);
    }

    public function leave_list_user($id)
    {
        $data = Leave::where('user_id', $id)->latest()->get();
        return response()->json([
            'status' => true,
            'message' => "Data Available",
            'data'  => $data
        ]);
    }

    public function pending_leave_list_user($id)
    {
        $data = Leave::where('user_id', $id)->where('status', 'pending')->latest()->get();
        return response()->json([
            'status' => true,
            'message' => "Data Available",
            'data'  => $data
        ]);
    }

    public function leave_add()
    {
        $emp = User::select('id','name')->get();
        $type = LeaveType::select('id', 'type_name')->get();
        return response()->json([
            'data_emp'  => $emp,
            'data_type'  => $type,
        ]);
    }

    public function leave_store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'employee'  => 'required',
            'type'      => 'required',
            'duration'  => 'required',
            'fromdate'  => 'required',
            'todate'    => 'required',
            'status'    => 'required',
            'reason'    => 'required',
        ]);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }else{
            Leave::create([
                'user_id'       => $request->employee,
                'leave_type_id' => $request->type,
                'duration'      => $request->duration,
                'from_date'     => $request->fromdate,
                'to_date'       => $request->todate,
                'reason'        => $request->reason,
                'status'        => $request->status,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Add Data Success',
            ]);
        }
    }

    public function leave_edit(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'employee'  => 'required',
            'type'      => 'required',
            'duration'  => 'required',
            'fromdate'  => 'required',
            'todate'    => 'required',
            'status'    => 'required',
            'reason'    => 'required',
        ]);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }else{
            Leave::updateOrCreate([
                'id'            => $id,
                'user_id'       => $request->employee,
                'leave_type_id' => $request->type,
                'duration'      => $request->duration,
                'from_date'     => $request->fromdate,
                'to_date'       => $request->todate,
                'reason'        => $request->reason,
                'status'        => $request->status,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Update Data Success',
            ]);
        }
    }

    public function leave_approve($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->update(['status' => 'approved']);
        
        // $user = User::findOrFail($leave->user_id);
        // $leaveData = [
        //     'leave_id'  => $id,
        //     'type'      => 'leave_accept',
        //     'username'  => Auth::user()->name,
        // ];
        // $user->notify(new LeavesNotification($leaveData));
        return response()->json([ 'status' => true, 'message' => 'Approved' ]);
    }

    public function leave_reject(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'reason'  => 'required',
        ]);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }else{
            Leave::where('id',$id)->update(['status' => 'rejected', 'reject_reason' => $request->reason]);
            // $leave = Leave::findOrFail($id);

            // $user = User::findOrFail($leave->user_id);
            // $leaveData = [
            //     'leave_id'  => $id,
            //     'type'      => 'leave_reject',
            //     'username'  => Auth::user()->name,
            // ];

            // $user->notify(new LeavesNotification($leaveData));
            return response()->json([ 'status' => true, 'message' => 'Rejected' ]);
        }
    }

    public function leave_add_type(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'type'      => 'required|string',
        ]);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }else{
            LeaveType::create([ 'type_name' => $request->type ]);
            return response()->json([ 'status' => true, 'message' => 'Add Type Success' ]);
        }
    }

    public function leave_destroy_type($id)
    {
        LeaveType::where('id', $id)->delete();
        return response()->json([ 'status' => true, 'message' => 'Data has been deleted', ]);
    }

    public function leave_destroy($id)
    {
        Leave::find($id)->delete();
        return response()->json([ 'status' => true, 'message' => 'Data has been deleted', ]);
    }

    // Payslip
    public function payslip_list()
    {
        $data = DB::table('payslips as p')
                ->join('users as u', 'p.user_id', '=', 'u.id')
                ->Join('employee_details as ed', 'u.id', '=', 'ed.user_id')
                ->join('jobs as j', 'ed.job_id', '=', 'j.id')
                ->join('basic_pays as bp', 'p.basic_id', '=', 'bp.id')
                ->select('p.*', 'u.name as emp_name', 'j.name as job', 'bp.amount as salary')
                ->groupBy('p.id')
                ->latest()
                ->get();
        return response()->json([
            'status' => true,
            'message' => "Data Available",
            'data'  => $data
        ]);
    }

    public function payslip_list_user($id)
    {
        $data = DB::table('payslips as p')
                ->join('users as u', 'p.user_id', '=', 'u.id')
                ->Join('employee_details as ed', 'u.id', '=', 'ed.user_id')
                ->join('jobs as j', 'ed.job_id', '=', 'j.id')
                ->where('p.user_id', $id)
                ->select('p.*', 'u.name as emp_name', 'j.name as job')
                ->groupBy('p.id')
                ->latest()
                ->get();
        return response()->json([
            'status' => true,
            'message' => "Data Available",
            'data'  => $data
        ]);
    }

    public function payslip_add()
    {
        $user = User::select('id','name')->get();
        $basic = BasicPay::select('id','job_id','amount')->get();
        return response()->json([
            'data_user' => $user,
            'data_basic'=> $basic,
        ]);
    }

    public function payslip_store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'user'      => 'required',
            'salary'    => 'required',
            'from_date' => 'required',
            'to_date'   => 'required',
            'allowance' => 'nullable|integer',
            'deduction' => 'nullable|integer',
            'overtime'  => 'nullable|integer',
            'other'     => 'nullable|integer',
            'payment'   => 'required',
            'status'    => 'required',
        ]);
        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }else{
            Payslip::create([
                'user_id'   => $request->user,
                'for_date'  => $request->from_date,
                'to_date'   => $request->to_date,
                'basic_id'  => $request->salary,
                'allowances'=> $request->allowance,
                'deductions'=> $request->deduction,
                'overtimes' => $request->overtime,
                'others'    => $request->other,
                'payment'   => $request->payment,
                'status'    => $request->status,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Add Data Success',
            ]);
        }
    }

    public function payslip_edit(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'from_date' => 'required',
            'to_date'   => 'required',
            'allowance' => 'nullable|integer',
            'deduction' => 'nullable|integer',
            'overtime'  => 'nullable|integer',
            'other'     => 'nullable|integer',
            'payment'   => 'required',
            'status'    => 'required',
        ]);
        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }else{
            Payslip::where('id', $id)
                    ->update([
                        'for_date'  => $request->from_date,
                        'to_date'   => $request->to_date,
                        'allowances'=> $request->allowance,
                        'deductions'=> $request->deduction,
                        'overtimes' => $request->overtime,
                        'others'    => $request->other,
                        'payment'   => $request->payment,
                        'status'    => $request->status,
                    ]);
            return response()->json([
                'status' => true,
                'message' => 'Update Data Success',
            ]);
        }
    }

    public function payslip_getSalary(User $user)
    {
        $data = BasicPay::where('job_id', $user->employee_detail->job->id)->select('id','job_id','amount')->get();
        return response()->json([ 'data' => $data ]);
    }

    public function payslip_basic()
    {
        $bj = BasicPay::select('job_id')->get()->toArray();
        $job = Job::whereNotIn('id', $bj)->select('id','name')->get();
        $data = DB::table("basic_pays as bp")
                    ->join("jobs as j", "bp.job_id", '=', 'j.id')
                    ->select("bp.id", "bp.amount", "j.name")
                    ->groupBy("bp.id")
                    ->get();
        return response()->json([ 
            'status' => true,
            'message' => "Data Available",
            'data'  => $data,
            'job_data' => $job
        ]);
    }

    public function payslip_basic_add(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'salary'    => 'required',
            'job'       => 'required'
        ]);
        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }else{
            $basic = new BasicPay();
            $basic->job_id  = $request->job;
            $basic->amount  = $request->salary;
            $basic->save();
            return response()->json([
                'status' => true,
                'message' => 'Add Data Success',
            ]);
        }
    }

    public function payslip_basic_destroy($id)
    {
        BasicPay::where('id', $id)->delete();
        return response()->json([ 'status' => true, 'message' => 'Data has been deleted', ]);
    }

    public function payslip_destroy($id)
    {
        Payslip::where('id', $id)->delete();
        return response()->json([ 'status' => true, 'message' => 'Data has been deleted', ]);
    }

    public function payslip_autoGenerate(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'from_date' => 'required',
            'to_date'   => 'required',
            'payment'   => 'required'
        ]);
        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }else{
            $users = User::all();
            foreach ($users as $user) {
                Payslip::create([
                    'user_id'   => $user->id,
                    'for_date'  => $request->from_date,
                    'to_date'   => $request->to_date,
                    'basic_id'  => $user->employee_detail->job->basic_pay->id,
                    'payment'   => $request->payment,
                ]);
            }
            return response()->json([ 'status' => true, 'message' => 'Payslip has been generated', ]);
        }
    }

    public function payslip_createPDF($id) 
    {
        $payslip = Payslip::findOrFail($id);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadview('admin.payslip.pdf', compact('payslip'));
        $pdf->setPaper("a4", "landscape");
        return $pdf->stream('payslip.pdf');
    }

    // Holiday
    public function event_list($month)
    {
        $data = Holiday::whereMonth('start', $month)->orderBy('start', 'asc')->get();

        return response()->json([
            'status' => true,
            'message' => "Data Available",
            'data' => $data
        ]);
    }

    public function event_add(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'start' => 'required',
            'end'   => 'required',
            'title'   => 'required'
        ]);
        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }else{
            Holiday::create([
                'start'     => $request->start,
                'end'       => $request->end,
                'title'     => $request->title
            ]);
            return response()->json([ 'status' => true, 'message' => 'Added Successfully' ]);
        }
    }

    public function event_destroy($id)
    {
        Holiday::where('id', $id)->delete();
        return response()->json([ 'status' => true, 'message' => 'Data has been deleted', ]);
    }

    // Attendance
    // public function attend_list()
    // {
    //     $attendances = Attendance::all();
    //     $getYear = Attendance::select(DB::raw('YEAR(created_at) as year'))->distinct()->orderBy('year', 'asc')->get();
    //     $years = $getYear->pluck('year');

    //     $bulan = request()->segment(3);
    //     $tahun = request()->segment(4);
    //     $hari = cal_days_in_month(CAL_GREGORIAN,$bulan,$tahun);

    //     $datamaster = User::all();
        
    //     $datas = "";
    //     foreach($datamaster as $master){
    //         $bulanis1 = "";
    //         for($i=1;$i<=$hari;$i++){
    //             $cek1 = Attendance::where('user_id',$master->id)->whereDay('clock_in_time', $i)->whereMonth('clock_in_time', $bulan)->whereYear('clock_in_time', $tahun)->count();
    //             $current = date("Y-m-d");
    //             if($cek1 > 0){
    //                 $dataBulan1 = "true";
    //             }else if($i > date("d") && $bulan >= date("m")){
    //                 $dataBulan1 = "-";
    //             }else{
    //                 $dataBulan1 = "false";
    //             }
    //             $bulanis1 = $bulanis1.$dataBulan1;
    //         }
    //         // $datass = "<tr><th>".$master->name."</th>
    //         //         ".$bulanis1."
    //         //     </tr>";
    //         // $datas = $datas.$datass;
    //     }
        
    //     return response()->json([
    //         'data_attendance'   => $attendances,
    //         'data_year'         => $years,
    //         // 'data_data'         => $datas
    //     ]);
    // }

    // Project
    public function project_list()
    {
        $data = DB::table('projects as p')
                    ->join('users as u', 'p.submitted_by', '=', 'u.id')
                    ->groupBy('p.id')
                    ->select('p.*', 'u.name as submitted_by_name')
                    ->latest()
                    ->get();

        return response()->json([
            'status' => true,
            'message' => "Data Available",
            'data' => $data
        ]);
    }

    public function ongoing_project_list()
    {
        $data = DB::table('projects as p')
                    ->where('p.status', 'in progress')
                    ->join('users as u', 'p.submitted_by', '=', 'u.id')
                    ->groupBy('p.id')
                    ->select('p.*', 'u.name as submitted_by_name')
                    ->latest()
                    ->get();

        return response()->json([
            'status' => true,
            'message' => "Data Available",
            'data' => $data
        ]);
    }

    public function project_list_user($id)
    {
        $data = Project::whereHas('members', function(Builder $query) use ($id) {
            $query->where('user_id', '=', $id);
        })->latest()->get();

        return response()->json([
            'status' => true,
            'message' => "Data Available",
            'data' => $data
        ]);
    }

    public function ongoing_project_list_user($id)
    {
        $data = Project::where('status', 'in progress')
                ->whereHas('members', function(Builder $query) use ($id) {
                    $query->where('user_id', '=', $id);
                })->latest()->get();

        return response()->json([
            'status' => true,
            'message' => "Data Available",
            'data' => $data
        ]);
    }

    public function project_member($id)
    {
        $data = DB::table('project_members as pm')
                    ->where('pm.project_id', $id)
                    ->join('users as u', 'pm.user_id', '=', 'u.id')
                    ->groupBy('pm.id')
                    ->select('pm.*', 'u.name as user_name', 'u.profile_photo_path')
                    ->get();
        return response()->json([
            'status' => true,
            'message' => "Data Available",
            'data' => $data
        ]);
    }

    public function project_category()
    {
        $data = ProjectCategory::all();
        return response()->json([
            'status' => true,
            'message' => "Data Available",
            'data' => $data
        ]);
    }

    public function project_add()
    {
        $emp = User::select('id','name')->get();
        $category = ProjectCategory::select('id','category_name')->get();
        
        return response()->json([
            'data_emp'   => $emp,
            'data_category'  => $category,
        ]);
    }

    public function project_store(Request $request, $userId)
    {
        $validasi = Validator::make($request->all(), [
            'project_name'  => 'required|string',
            'category'      => 'required|integer',
            'start_date'    => 'required|date',
            'deadline'      => 'required|date',
            'member'        => 'required',
            'summary'       => 'nullable',
            'note'          => 'nullable',
        ]);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }else{
            if (now() < $request->start_date) {
                $status = "not started";
            }else{
                $status = "in progress";
            }
            $project = new Project();
            $project->project_name      = $request->project_name;
            $project->category_id       = $request->category;
            $project->start_date        = $request->start_date;
            $project->deadline          = $request->deadline;
            $project->status            = $status;
            $project->project_summary   = $request->summary;
            $project->notes             = $request->note;
            $project->submitted_by      = $userId;
            $project->save();

            $user = $request->member;
            foreach ($user as $users) {
                $member = new ProjectMember();
                $member->user_id    = $users;
                $member->project_id = $project->id;
                $member->save();
            }
            return response()->json([
                'status' => true,
                'message' => 'Add Data Success',
            ]);
        }
    }

    public function project_add_cat(Request $request)
    {
        ProjectCategory::create(['category_name' => $request->category]);
        return response()->json([ 'status' => true, 'message' => 'Add Data Success', ]);
    }

    public function project_destroy_cat($id)
    {
        ProjectCategory::where('id', $id)->delete();
        return response()->json([ 'status' => true, 'message' => 'Data has been deleted', ]);
    }

    public function project_destroy($id)
    {
        Project::where('id', $id)->delete();
        return response()->json([ 'status' => true, 'message' => 'Data has been deleted', ]);
    }

    public function project_update(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'project_name'  => 'required|string',
            'category'      => 'required|integer',
            'start_date'    => 'required|date',
            'deadline'      => 'required|date',
            'member'        => 'required',
            'summary'       => 'nullable',
            'note'          => 'nullable',
            'status'        => 'required'
        ]);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }else{
            $project = Project::findOrFail($id);
            $project->project_name      = $request->project_name;
            $project->category_id       = $request->category;
            $project->start_date        = $request->start_date;
            $project->deadline          = $request->deadline;
            $project->status            = $request->status;
            $project->project_summary   = $request->summary;
            $project->notes             = $request->note;
            $project->save();

            $user = $request->member;
            foreach ($user as $users) {
                DB::insert(DB::raw("insert into project_members (user_id, project_id) select * from (select '$users', '$id') as temp
                where not exists ( select user_id, project_id from project_members where user_id='$users' and project_id='$id' )"));
            }
            return response()->json([
                'status' => true,
                'message' => 'Data has been updated'
            ]);
        }
    }

    public function project_member_destroy($id)
    {
        ProjectMember::where('id', $id)->delete();
        return response()->json([ 'status' => true, 'message' => 'Member removed', ]);
    }

    public function project_member_add(Request $request)
    {
        $user = $request->member;
        foreach ($user as $users) {
            $member = new ProjectMember();
            $member->user_id    = $users;
            $member->project_id = $request->id;
            $member->save();
        }
        return response()->json([ 'status' => true, 'message' => 'Member added', ]);
    }

    public function project_activity_list($id)
    {
        $data = DB::table('project_updates as pu')->where('pu.project_id', $id)
                    ->join('users as u', 'pu.user_id', '=', 'u.id')
                    ->groupBy('pu.id')
                    ->select('pu.*', 'u.name as user_name', 'u.profile_photo_path')
                    ->latest()
                    ->get();
        return response()->json([
            'status' => true,
            'message' => "Data Available",
            'data' => $data
        ]);
    }

    public function pa_list($id)
    {
        $data = ModelsProjectActivity::where('project_id', $id)->latest()->get();
        return response()->json([
            'status' => true,
            'message' => "Data Available",
            'data' => $data
        ]);
    }

    public function project_activity_download($id)
    {
        $file = ProjectUpdate::where('id', $id)->first();
        $path = public_path().'/storage/'.$file->file;
        return Response::download($path);
    }

    public function project_activity_destroy($id)
    {
        $project = ProjectUpdate::find($id);
        Storage::disk('public')->delete($project->file);
        $project->delete();
        return response()->json([
            'status' => true,
            'message' => "Data Available",
        ]);
    }

    public function project_activity_submit(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'comment'   => 'required',
            'file'      => 'nullable|max:10240',
        ]);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }else{
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
            $project->user_id = $request->user_id;
            $project->save();

            return response()->json([
                'status' => true,
                'message' => 'Data has been added'
            ]);
        }
    }

    // Goal
    public function goal_list()
    {
        $data = DB::table('goals as g')
                    ->join('users as u', 'g.user_id', '=', 'u.id')
                    ->groupBy('g.id')
                    ->select('g.*', 'u.name as user_name', 'u.profile_photo_path')
                    ->latest()
                    ->get();

        return response()->json([
            'status' => true,
            'message' => "Data Available",
            'data' => $data
        ]);
    }

    public function goal_list_user($id)
    {
        $data = DB::table('goals as g')
                    ->where('g.user_id', $id)
                    ->join('users as u', 'g.user_id', '=', 'u.id')
                    ->groupBy('g.id')
                    ->select('g.*', 'u.name as user_name')
                    ->latest()
                    ->get();

        return response()->json([
            'status' => true,
            'message' => "Data Available",
            'data' => $data
        ]);
    }

    // Task
    public function task_list($id)
    {
        $role = User::where('id', $id)->select('role_id')->first();
        
        if ($role->role_id != 1) {
            $data = Task::leftJoin('projects as p', 'p.id', '=', 'tasks.project_id')
                    ->join('users as u', 'u.id', '=', 'tasks.user_id')
                    ->leftJoin('users as creator', 'creator.id', '=', 'tasks.created_by')
                    ->join('task_category as tc', 'tc.id', '=', 'tasks.task_category_id')
                    ->where('tasks.user_id', $id)
                    ->select('tasks.*', 'u.name', 'u.profile_photo_path', 'creator.name as created_by_name', 'creator.profile_photo_path as created_by_image', 'p.project_name', 'tc.category_name')
                    ->latest()->get();
        } else {
            $data = Task::leftJoin('projects as p', 'p.id', '=', 'tasks.project_id')
                    ->join('users as u', 'u.id', '=', 'tasks.user_id')
                    ->leftJoin('users as creator', 'creator.id', '=', 'tasks.created_by')
                    ->join('task_category as tc', 'tc.id', '=', 'tasks.task_category_id')
                    ->select('tasks.*', 'u.name', 'u.profile_photo_path', 'creator.name as created_by_name', 'creator.profile_photo_path as created_by_image', 'p.project_name', 'tc.category_name')
                    ->latest()->get();
        }
        return response()->json([
            'status' => true,
            'message' => "Data Available",
            'data' => $data
        ]);
    }

    public function task_store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'project'       => 'required|integer|gt:0',
            'category'      => 'required|integer|gt:0',
            'title'         => 'required',
            'description'   => 'nullable',
            'start_date'    => 'required|date',
            'due_date'      => 'required|date',
            'priority'      => 'required',
            'creator'       => 'required|integer|gt:0',
            'assigned'      => 'required|integer|gt:0',
        ]);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }else{
            // if (Auth::user()->role_id == 1) {
            //     $this->validate($request, [
            //         'assigned'      => 'required',
            //     ]);
            // }

            $task = new Task();
            $task->title = $request->title;
            $task->description = $request->description;
            $task->start_date = $request->start_date;
            $task->due_date = $request->due_date;

            $creator = User::where('id', $request->creator)->first();
            $user = User::where('id', $request->assigned)->first();
            $username = ($creator->role_id == 1) ? $user->name : $creator->name;
            if ($creator->role_id == 1) {
                $task->user_id = $request->assigned;
                $activity = $creator->name . " added new task assigned to " . $username;
            } else {
                $task->user_id = $request->creator;
                $activity = $creator->name . " added new task";
            }
            $task->project_id = $request->project;
            $task->task_category_id = $request->category;
            $task->priority = $request->priority;
            $task->created_by = $request->creator;
            $task->save();

            $widget = new Widget();
            $widget->calculateProjectProgressPercent($request->project);

            ProjectActivity::addToActivity($request->project, $activity);
            return response()->json([
                'status' => true,
                'message' => 'Add Data Success',
            ]);
        }
    }

    public function task_category()
    {
        $data = TaskCategory::all();
        return response()->json([
            'status' => true,
            'message' => "Data Available",
            'data' => $data
        ]);
    }

    public function task_add_cat(Request $request)
    {
        TaskCategory::create(['category_name' => $request->category]);
        return response()->json([ 'status' => true, 'message' => 'Add Data Success', ]);
    }

    public function task_destroy_cat($id)
    {
        TaskCategory::where('id', $id)->delete();
        return response()->json([ 'status' => true, 'message' => 'Data has been deleted', ]);
    }

    
    public function task_comment_list($id)
    {
        $data = DB::table('task_comments as tc')->where('tc.task_id', $id)
                    ->join('users as u', 'tc.user_id', '=', 'u.id')
                    ->groupBy('tc.id')
                    ->select('tc.*', 'u.name as user_name', 'u.profile_photo_path')
                    ->latest()
                    ->get();
        return response()->json([
            'status' => true,
            'message' => "Data Available",
            'data' => $data
        ]);
    }

    public function task_comment_destroy($id)
    {
        $task = TaskComment::find($id);
        Storage::disk('public')->delete($task->file);
        $task->delete();
        return response()->json([
            'status' => true,
            'message' => "Data Available",
        ]);
    }

    public function error($msg)
    {
        return response()->json([
            'status' => false,
            'message' => $msg
        ]);
    }
}
