<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        thead{
            background: #efefef;
        }
        tfoot{
            background: #efefef;
        }
        th{
            color: #59becd;
        }
        .pdfbody{
            position: relative;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1rem;
        }
        .inlineTable {
            display: inline-block;
        }
        /* .tablepdf {
            width: 50%;
            margin-bottom: 1rem;
            color: #212529;
            background-color: transparent;
        }
        .tablepdf th, .tablepdf td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        } */
    </style>
</head>
<body>
    <div class="pdfbody">

        <div class="text-right mb-3">
            <img src="data:image/png;base64,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" alt="Logo" width="150px">
            
        </div>
        <h3>{{ date('j F Y', strtotime($payslip->for_date)) }} - {{ date('j F Y', strtotime($payslip->to_date)) }}</h3>
        <table class="table table-sm table-borderless mt-3">
            <tr>
                <td class="font-weight-bold">Name</td>
                <td>{{ Auth::user()->name }}</td>
                <td class="font-weight-bold">Employee Status</td>
                <td>{{ Auth::user()->employee_detail->status->status_name }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">Department</td>
                <td>{{ Auth::user()->employee_detail->department->name }}</td>
                <td class="font-weight-bold">Joined Since</td>
                <td>{{ Auth::user()->employee_detail->join_date }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">Role</td>
                <td>{{ Auth::user()->employee_detail->job->name }}</td>
                <td class="font-weight-bold">Length Of Employment</td>
                <td>
                    @php
                        $join = strtotime(Auth::user()->employee_detail->join_date);
                        $now = strtotime(now());
                        $diff = ($now-$join);
                        $years = floor($diff / (365*60*60*24));
                        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                    @endphp
                    @if (!empty($years))
                        {{ $years }} Year{{ ($years > 1) ? 's' : '' }}
                    @endif
                    {{ $months }} Month{{ ($months > 1) ? 's' : '' }} 
                    {{ $days }} day{{ ($days > 1) ? 's' : '' }}
                </td>
            </tr>
        </table>
        {{-- <div class="row mt-3">
            <div class="col-md-6">
                <div class="row">
                    <div class="col font-weight-bold">Name</div>
                    <div class="col">{{ Auth::user()->name }}</div>
                </div>
                <div class="row">
                    <div class="col font-weight-bold">Department</div>
                    <div class="col">{{ Auth::user()->employee_detail->department->name }}</div>
                </div>
                <div class="row">
                    <div class="col font-weight-bold">Role</div>
                    <div class="col">{{ Auth::user()->employee_detail->job->name }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col font-weight-bold">Employee Status</div>
                    <div class="col">{{ Auth::user()->employee_detail->status->status_name }}</div>
                </div>
                <div class="row">
                    <div class="col font-weight-bold">Joined Since</div>
                    <div class="col">{{ Auth::user()->employee_detail->join_date }}</div>
                </div>
                <div class="row">
                    <div class="col font-weight-bold">Length Of Employment</div>
                    @php
                        $join = strtotime(Auth::user()->employee_detail->join_date);
                        $now = strtotime(now());
                        $diff = ($now-$join);
                        $years = floor($diff / (365*60*60*24));
                        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                    @endphp
                    <div class="col">
                        @if (!empty($years))
                            {{ $years }} Year{{ ($years > 1) ? 's' : '' }}
                        @endif
                        {{ $months }} Month{{ ($months > 1) ? 's' : '' }} 
                        {{ $days }} day{{ ($days > 1) ? 's' : '' }}
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="mt-5">
            <table class="table" style="float: left; width: 50% !important;">
                <thead>
                    <tr>
                        <th>Income</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Allowance</td>
                        <td>{{ "Rp ".number_format($payslip->allowances,2,',','.') }}</td>
                    </tr>
                    <tr>
                        <td>Overtime</td>
                        <td>{{ "Rp ".number_format($payslip->overtimes,2,',','.') }}</td>
                    </tr>
                    <tr>
                        <td>Other</td>
                        <td>{{ "Rp ".number_format($payslip->others,2,',','.') }}</td>
                    </tr>
                    <tr style="background: #efefef">
                        <th>Total</th>
                        @php $totalB = $payslip->allowances + $payslip->overtimes + $payslip->others; @endphp
                        <td> {{ "Rp ".number_format($totalB,2,',','.') }} (B)</td>
                    </tr>
                </tbody>
            </table>
            <table class="table ml-2" style="float: left; width: 50% !important;">
                <thead>
                    <tr>
                        <th>Income</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Basic Salary</td>
                        <td>{{ "Rp ".number_format($payslip->basic_pay->amount,2,',','.') }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total Income</th>
                        <td>{{ "Rp ".number_format($payslip->basic_pay->amount,2,',','.') }} (A)</td>
                    </tr>
                    <tr>
                        <th>Deduction</th>
                        <td>{{ "Rp ".number_format($payslip->deductions,2,',','.') }} (C)</td>
                    </tr>
                    <tr>
                        <th>Net Pay (A+B-C)</th>
                        @php
                            $total = $totalB + $payslip->basic_pay->amount - $payslip->deductions;
                        @endphp
                        <td>{{ "Rp ".number_format($total,2,',','.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</body>
</html>