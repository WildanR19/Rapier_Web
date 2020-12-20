<div class="modal fade" id="payslipModal" tabindex="-1" aria-labelledby="payslipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-right mb-3">
                    <img src="{{ asset('img/logo-with-text.svg') }}" alt="Logo" width="150px">
                </div>
                <h3>21 October 2020 - 21 November 2020</h3>
                <div class="row mt-3">
                    <div class="col">
                        <div class="row">
                            <div class="col font-weight-bold">Name</div>
                            <div class="col">{{ Auth::user()->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col font-weight-bold">Employee ID</div>
                            <div class="col">XXXXXXXXXXXXXXX</div>
                        </div>
                        <div class="row">
                            <div class="col font-weight-bold">Department</div>
                            <div class="col">Human Resources Department</div>
                        </div>
                        <div class="row">
                            <div class="col font-weight-bold">Role</div>
                            <div class="col">HR Operations & IRGA Lead</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col font-weight-bold">Employee Status</div>
                            <div class="col">Permanent Employee</div>
                        </div>
                        <div class="row">
                            <div class="col font-weight-bold">PTKP Status</div>
                            <div class="col">-</div>
                        </div>
                        <div class="row">
                            <div class="col font-weight-bold">Joined Since</div>
                            <div class="col">15 August 2020</div>
                        </div>
                        <div class="row">
                            <div class="col font-weight-bold">Length Of Employment</div>
                            <div class="col">2 Months XX Days</div>
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
                                    <td>Basic Salary</td>
                                    <td>Rp  XX.000.000</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total Income</th>
                                    <td>Rp  XX.000.000</td>
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
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total Deduction</th>
                                    <td>Rp  XX.000.000</td>
                                </tr>
                                <tr>
                                    <th>Take Home Pay</th>
                                    <td>Rp  XX.000.000</td>
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
