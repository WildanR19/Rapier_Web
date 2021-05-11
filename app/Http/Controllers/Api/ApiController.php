<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
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
use App\Models\ProjectCategory;
use App\Models\ProjectMember;
use App\Models\Role;
use App\Notifications\LeavesNotification;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $response = [];
        if($user){
            if(password_verify($request->password, $user->password)){
                $response['status'] = true;
                $response['message'] = 'Login Success';
                $response['data'] = [
                    'user_id'   => $user->id,
                    'name'   => $user->name,
                    'email'   => $user->email,
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

    // Employee
    public function user_list()
    {
        $data = User::all();
        return response()->json([
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
        $dept   = Department::select('id','name')->get();
        $role   = Role::select('id','name')->get();
        $job    = Job::select('id','name')->get();
        $status = EmployeeStatus::select('id','status_name')->get();
        return response()->json([
            'data_user'  => $user,
            'data_ed'    => $ed,
            'data_dept'  => $dept,
            'data_role'  => $role,
            'data_job'   => $job,
            'data_status'=> $status,
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

    // department
    public function dept_list()
    {
        $data = Department::all();
        return response()->json([
            'data'  => $data
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

    public function dept_update($id)
    {
    	$dept = Department::find($id);

	    return response()->json([
	      'data' => $dept
	    ]);
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
        $data = Job::all();
        return response()->json([
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

    public function job_update($id)
    {
    	$data = Job::find($id);

	    return response()->json([
	      'data' => $data
	    ]);
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
    public function leave_list()
    {
        $data = DB::table('leaves AS l')
                ->join('users AS u', 'u.id', '=', 'l.user_id')
                ->select('l.*', 'u.name')
                ->orderByDesc('l.created_at')
                ->get();

        return response()->json([
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

    // Holiday
    public function holiday_list()
    {
        $data = Holiday::whereMonth('start', date('m'))
                ->get(['id', 'title', 'start', 'end']);

        return response()->json(['data' => $data]);
    }

    // Payslip
    public function payslip_list()
    {
        $data = Payslip::orderByDesc('created_at')->get();
        return response()->json(['data' => $data]);
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

    public function payslip_getSalary(User $user)
    {
        $data = BasicPay::where('job_id', $user->employee_detail->job->id)->select('id','job_id','amount')->get();
        return response()->json([ 'data' => $data ]);
    }

    public function payslip_basic()
    {
        $basic = BasicPay::select('id','job_id','amount')->get();
        $bj = BasicPay::select('job_id')->get()->toArray();
        $job = Job::whereNotIn('id', $bj)->select('id','name')->get();
        return response()->json([ 
            'data_basic'    => $basic,
            'data_job'      => $job,
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
        $project = Project::orderByDesc('created_at')->get();
        $status = ['not started', 'in progress', 'on hold', 'canceled', 'finished'];
        $teammember = ProjectMember::select('id','user_id','project_id')->get();

        return response()->json([
            'data_project'   => $project,
            'data_status'  => $status,
            'data_teammember'=> $teammember,
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

    // submitted by blm fix
    public function project_store(Request $request)
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
            }elseif (now() > $request->start_date && now() < $request->deadline){
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
            $project->submitted_by      = '1';
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

    public function project_addCat(Request $request)
    {
        ProjectCategory::create(['category_name' => $request->category]);
        return response()->json([ 'status' => true, 'message' => 'Add Data Success', ]);
    }

    public function project_destroyCat($id)
    {
        ProjectCategory::where('id', $id)->delete();
        return response()->json([ 'status' => true, 'message' => 'Data has been deleted', ]);
    }

    public function project_destroy($id)
    {
        Project::where('id', $id)->delete();
        return response()->json([ 'status' => true, 'message' => 'Data has been deleted', ]);
    }

    public function project_update($id)
    {
        $project    = Project::where('id', $id)->first();
        $category   = ProjectCategory::select('id','category_name')->get();
        $emp        = User::select('id','name')->get();
        $teammember = ProjectMember::where('project_id', $id)->select('id','user_id')->get();
        
        return response()->json([
            'data_project'   => $project,
            'data_category'  => $category,
            'data_emp'       => $emp,
            'data_teammember'=> $teammember,
        ]);
    }

    public function project_edit(Request $request, $id)
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

        $project = Project::findOrFail($id);
        $project->project_name      = $request->project_name;
        $project->category_id       = $request->category;
        $project->start_date        = $request->start_date;
        $project->deadline          = $request->deadline;
        $project->status            = $request->status;
        $project->project_summary   = $request->summary;
        $project->notes             = $request->note;
        $project->save();

        return response()->json([ 'status' => true, 'message' => 'Data has been updated', ]);
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


    public function error($msg)
    {
        return response()->json([
            'status' => false,
            'message' => $msg
        ]);
    }
}
