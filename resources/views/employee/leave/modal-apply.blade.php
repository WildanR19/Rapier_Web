<div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applyModalLabel">Apply a Leave Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><i>Type</i></label>
                        <div class="col-sm-9">
                            <select class="form-control" id="type">
                                <option>Select a Leave Type</option>
                                <option value="Annual Leave">Annual Leave</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><i>Duration</i></label>
                        <div class="col-sm-9">
                            <select class="form-control" id="duration">
                                <option>Select Duration</option>
                                <option value="Full Day">Full Day</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><i>From Date</i></label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control datetimepicker-input" name="dates" placeholder="Begin Leave" id="fromDate" />
                        </div>
                        <label class="col-sm-3 col-form-label text-center"><i>To Date</i></label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control datetimepicker-input" name="dates" placeholder="End Leave" id="toDate" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><i>Reason</i></label>
                        <div class="col-sm-9">
                            <input class="form-control" placeholder="Reason of Leave" id="reason">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><i>Comment</i></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="3" id="comment"></textarea>
                        </div>
                    </div>
                </form>
                        <div class="col text-center">
                            <button type="submit" class="btn bg-oren" onclick="applyRequest()"><strong><i>Apply</i></strong></button>
                        </div>
            </div>
        </div>
    </div>
</div>
