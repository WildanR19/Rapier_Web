<div class="modal-header bg-dark align-items-center">
    <h5 class="modal-title">Payslip <br><span style="font-size: 1.5rem;">{{ date('j F Y', strtotime($payslip->for_date)) }} - {{ date('j F Y', strtotime($payslip->to_date)) }}</span></h5>
    <img src="{{ asset('img/logo.png') }}" alt="Logo" width="150px" class="mr-3">
</div>
<div class="modal-body">
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="row">
                <div class="col font-weight-bold">Name Employee</div>
                <div class="col">{{ Auth::user()->name }}</div>
            </div>
            <div class="row">
                <div class="col font-weight-bold">Department</div>
                <div class="col">{{ Auth::user()->employee_detail->department->name }}</div>
            </div>
            <div class="row">
                <div class="col font-weight-bold">Job</div>
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
    </div>
    <div class="row mt-5 mb-3">
        <div class="col-md-6 table-responsive">
            <table class="table">
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
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total</th>
                        @php $totalB = $payslip->allowances + $payslip->overtimes + $payslip->others; @endphp
                        <td> {{ "Rp ".number_format($totalB,2,',','.') }} (B)</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-md-6 table-responsive">
            <table class="table">
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
    <div class="col text-center">
        <a href="{{ route('dash.payslip.pdf', $payslip->id) }}" class="btn btn-primary">Download</a>
    </div>
</div>