<div class="modal fade" id="chartModal" tabindex="-1" aria-labelledby="chartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row mt-4">
                    <div class="col-auto">
                        <div class="image">
                            <img src="" class="img-circle elevation-2" alt="User Image" width="80px" style="background-color: #0B92AB;" id="imgTeam">
                        </div>
                    </div>
                    <div class="col my-auto">
                        <div>
                            <h5 id="nameTeam"></h5>
                            <i id="roleTeam"></i>
                        </div>
                    </div>
                    <div class="col text-right">
                        <input type="text" class="knobTeam" value="" data-width="90" data-height="90" data-fgColor="#0B92AB" readonly data-thickness=".2">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col my-auto titleUpdate">
                        100% on time payroll payment
                    </div>
                    <div class="col my-auto">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 75%; background-color: #59BECD; color: #FFC045;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" id="prog1">XX%</div>
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        _/_
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col my-auto titleUpdate">
                        100% accuracy on total compensation calculation
                    </div>
                    <div class="col my-auto">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 40%; background-color: #59BECD; color: #FFC045;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" id="prog2">XX%</div>
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        _/_
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col my-auto titleUpdate">
                        Review & renew company regulation
                    </div>
                    <div class="col my-auto">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 50%; background-color: #59BECD; color: #FFC045;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" id="prog3">50%</div>
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        2/4
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col my-auto titleUpdate">
                        Zero finding in GA related stock opname each year
                    </div>
                    <div class="col my-auto">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 100%; background-color: #59BECD; color: #FFC045;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" id="prog4">100%</div>
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        0/0
                    </div>
                </div>
                <div class="row mt-5 justify-content-center">
                    <button class="btn bg-oren rounded shadow-sm" id="btnBackToTeam" onclick="backToTeam()"><strong><i>Back to
                                Team Chart</i></strong></button>
                </div>
            </div>
        </div>
    </div>
</div>
