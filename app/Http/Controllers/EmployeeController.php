<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee_detail;
use App\Models\Job;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'name'      => 'required|string',
            'email'     => 'required|email',
            'password'  => 'required',
            'role'      => 'required',
            'address'   => 'required',
            'dept'      => 'required',
            'job'       => 'required',
            'gender'    => 'required',
            'join_date' => 'required',
        ]);

        if($request->last_date <= now() && !empty($request->last_date)){
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
        $user_data->created_at  = now();
        $user_data->updated_at  = now();
        $user_data->save();
        
        $ed = new Employee_detail();
        $ed->user_id        = $user_data->id;
        $ed->address        = $request->address;
        $ed->gender         = $request->gender;
        $ed->job_id         = $request->job;
        $ed->department_id  = $request->dept;
        $ed->join_date      = $request->join_date;
        $ed->last_date      = $request->last_date;
        $ed->created_at     = now();
        $ed->updated_at     = now();
        $ed->save();
        
        return redirect()->route('dash.employee');
    }

    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return back()->with('success','Data deleted successfully');
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        $ed = Employee_detail::where('user_id', $id)->first();
        $dept = Department::all();
        $role = Role::all();
        $job = Job::all();
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
        if($request->last_date <= now() && !empty($request->last_date)){
            $status = 'deactive';
        }else{
            $status = 'active';
        }

        $emp = User::findOrFail($request->id);
        $emp->name      = $request->name;
        $emp->email     = $request->email;
        $emp->password  = Hash::make($request->password);
        $emp->role_id   = $request->role;
        $emp->status    = $status;
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

        return redirect()->route('dash.employee');
    }

    public function details()
    {
        return view('admin.employee.details');
    }
}
