<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\BasicPay;
use App\Models\Payslip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

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

    public function showModal($id){
        $pay = Payslip::where('id', $id)->first();
        return view('employee.payslip.modal',['payslip'=>$pay]);
    }

    public function createPDF($id) 
    {
        $payslip = Payslip::findOrFail($id);
        // return view('employee.payslip.pdf')->with('payslip', $payslip);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadview('employee.payslip.pdf', compact('payslip'));
        $pdf->setPaper("a4", "landscape");
        // return $pdf->download('payslip-pdf');
        return $pdf->stream('payslip.pdf');
    }
}
