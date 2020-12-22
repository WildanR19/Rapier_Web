<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Job;
use App\Models\Role;
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
            'dept' => $dept,
            'role' => $role,
            'job' => $job,
        ];
        return view('admin.employee.add')->with($data);
    }

    public function store(Request $request)
    {
        $user_data =new User();
        $user_data->name = $request->name;
        $user_data->email = $request->email;
        $user_data->password = Hash::make($request->password);
        $user_data->role_id = $request->role;
        $user_data->created_at = now();
        $user_data->updated_at = now();
        $user_data->save();
        
        DB::table('employee_details')->insert([
            'user_id'       => $user_data->id,
            'address'       => $request->address,
            'gender'        => $request->gender,
            'job_id'        => $request->job,
            'department_id' => $request->dept,
            'join_date'     => $request->join_date,
            'last_date'     => $request->last_date,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);
        // redirect to index employee
        return redirect()->route('dash.employee');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return back()->with('success','Data deleted successfully');
    }

    public function details()
    {
        return view('admin.employee.details');
    }
}
