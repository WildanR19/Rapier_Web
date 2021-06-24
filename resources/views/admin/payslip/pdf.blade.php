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
            color: #FF8A65;
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
                <td class="font-weight-bold">Role</td>
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