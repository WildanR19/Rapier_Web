<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\BasicPay;
use App\Models\Payslip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayslipController extends Controller
{
    public function index()
    {
        $auth = Auth::user()->id;
        $pays = Payslip::where('user_id', $auth)->orderByDesc('created_at')->get();
        $data = [
            'pays'  => $pays,
        ];
        return view('employee.payslip.index')->with($data);
    }

    public function openModal($id)
    {
        $ps = Payslip::find($id);
        $basic = BasicPay::where('id', $ps->basic_id)->first();

	    return response()->json([
          'data' => $ps,
          'basic'=> $basic,
	    ]);
    }
}
