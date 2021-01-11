<div class="modal fade" id="payslipModal" tabindex="-1" aria-labelledby="payslipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-right mb-3">
                    <img src="{{ asset('img/logo-with-text.svg') }}" alt="Logo" width="150px">
                </div>
                <h3>25 March 2021 - 25 April 2021</h3>
                <div class="row mt-3">
                    <div class="col">
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
                    <div class="col">
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
                    
                    <div class="col table-responsive">
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
                                    <td>Rp 50.000</td>
                                </tr>
                                <tr>
                                    <td>Overtime</td>
                                    <td>Rp 50.000</td>
                                </tr>
                                <tr>
                                    <td>Other</td>
                                    <td>Rp 50.000</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <td>Rp  150.000</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="col table-responsive">
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
                                    <td>Rp  5.000.000</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total Income</th>
                                    <td>Rp  5.000.000</td>
                                </tr>
                                <tr>
                                    <th>Deduction</th>
                                    <td>Rp 50.000</td>
                                </tr>
                                <tr>
                                    <th>Net Pay</th>
                                    <td>Rp  5.100.000</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col text-center">
                    <button type="submit" class="btn btn-secondary">Download</button>
                </div>
            </div>
        </div>
    </div>
</div>
