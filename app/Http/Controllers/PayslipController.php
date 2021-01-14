<?php

namespace App\Http\Controllers;

use App\Models\BasicPay;
use App\Models\Job;
use App\Models\Payslip;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PayslipController extends Controller
{
    public function index()
    {
        $pay = Payslip::orderByDesc('created_at')->get();
        $data = [
            'pays'  => $pay,
        ];
        return view('admin.payslip.index')->with($data);
    }

    public function add()
    {
        $user = User::all();
        $basic = BasicPay::all();
        $data = [
            'users' => $user,
            'basics'=> $basic,
        ];
        return view('admin.payslip.add')->with($data);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
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
        Alert::success('Success', 'Your data has been added.');
        return redirect()->route('admin.payslip');
    }

    public function getSalary(User $user)
    {
        return BasicPay::where('job_id', $user->employee_detail->job->id)->get();
    }

    public function basic()
    {
        $basic = BasicPay::all();
        $job = Job::all();
        $data = [
            'basics'    => $basic,
            'jobs'      => $job,
        ];
        return view('admin.payslip.basic')->with($data);
    }

    public function basic_destroy($id)
    {
        BasicPay::where('id', $id)->delete();
        return back();
    }

    public function basic_add(Request $request)
    {
        $basic = new BasicPay();
        $basic->job_id  = $request->job;
        $basic->amount  = $request->salary;
        $basic->save();
        return back();
    }

    public function destroy($id)
    {
        Payslip::where('id', $id)->delete();
        Alert::success('Success', 'Your data has been deleted.');
        return back();
    }
}
