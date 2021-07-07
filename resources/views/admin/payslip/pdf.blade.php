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
        .pdfbody{
            position: relative;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1rem;
        }
        .inlineTable {
            display: inline-block;
        }
        .bg-dark {
            background-color: #343a40 !important;
            color: #f8f9fa!important;
        }
    </style>
</head>
<body>
    <div class="pdfbody">
        <table class="table table-sm table-borderless mt-3 bg-dark">
            <tr>
                <td class="align-middle">
                    <h5>Payslip <br><span style="font-size: 1.5rem;">{{ date('j F Y', strtotime($payslip->for_date)) }} - {{ date('j F Y', strtotime($payslip->to_date)) }}</span></h5>
                </td>
                <td class="text-right p-4">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" width="120px" class="mt-1 mr-3">
                </td>
            </tr>
        </table>
        
        <table class="table table-sm table-borderless mt-3">
            <tr>
                <td class="font-weight-bold">Name Employee</td>
                <td>{{ $payslip->user->name }}</td>
                <td class="font-weight-bold">Employee Status</td>
                <td>{{ $payslip->user->employee_detail->status->status_name }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">Department</td>
                <td>{{ $payslip->user->employee_detail->department->name }}</td>
                <td class="font-weight-bold">Joined Since</td>
                <td>{{ $payslip->user->employee_detail->join_date }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">Job</td>
                <td>{{ $payslip->user->employee_detail->job->name }}</td>
                <td class="font-weight-bold">Length Of Employment</td>
                <td>
                    @php
                        $join = strtotime($payslip->user->employee_detail->join_date);
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