<div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applyModalLabel">Assign a Leave Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dash.leave.assign') }}" method="POST" id="assignLeave">
                    @csrf
                    <div class="form-group row">
                        <label for="inputType" class="col-sm-3 col-form-label"><i>Type</i></label>
                        <div class="col-sm-9">
                            <select class="form-control" id="inputType" name="type">
                                <option disabled selected>Select a Leave Type</option>
                                @foreach ($leavetype as $lt)
                                    <option value="{{ $lt->id }}">{{ $lt->type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDuration" class="col-sm-3 col-form-label"><i>Duration</i></label>
                        <div class="col-sm-9">
                            <select class="form-control" id="inputDuration" name="duration">
                                <option selected disabled>Select Duration</option>
                                <option value="full day">Full Day</option>
                                <option value="half day">Half Day</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputFromDate" class="col-sm-3 col-form-label"><i>From Date</i></label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control datetimepicker-input" name="fromdate" placeholder="Begin Leave" id="inputFromDate" />
                        </div>
                        <label for="inputToDate" class="col-sm-3 col-form-label text-center"><i>To Date</i></label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control datetimepicker-input" name="todate" placeholder="End Leave" id="inputToDate" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputReason" class="col-sm-3 col-form-label"><i>Reason</i></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="3" id="inputReason" placeholder="Reason of Leave" name="reason"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary" form="assignLeave">Assign</button>
            </div>
        </div>
    </div>
</div>

{{-- <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Leave Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dash.leave.assign') }}" method="POST" id="assignLeave">
                    @csrf
                    <div class="form-group row">
                        <label for="type" class="col-sm-3 col-form-label"><i>Type</i></label>
                        <div class="col-sm-9">
                            <select class="form-control" id="type" name="type">
                                <option disabled selected>Select a Leave Type</option>
                                @foreach ($leavetype as $lt)
                                    <option value="{{ $lt->id }}">{{ $lt->type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="duration" class="col-sm-3 col-form-label"><i>Duration</i></label>
                        <div class="col-sm-9">
                            <select class="form-control" id="duration" name="duration">
                                <option selected disabled>Select Duration</option>
                                <option value="full day">Full Day</option>
                                <option value="Half day">Half Day</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fromDate" class="col-sm-3 col-form-label"><i>From Date</i></label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control datetimepicker-input" name="fromdate" placeholder="Begin Leave" id="fromDate" />
                        </div>
                        <label for="toDate" class="col-sm-3 col-form-label text-center"><i>To Date</i></label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control datetimepicker-input" name="todate" placeholder="End Leave" id="toDate" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reason" class="col-sm-3 col-form-label"><i>Reason</i></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="3" id="reason" placeholder="Reason of Leave" name="reason"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary" form="assignLeave">Assign</button>
            </div>
        </div>
    </div>
</div> --}}

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Leave Request</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="leavedata">
          <div class="modal-body">
            <input type="hidden" id="leave_id" name="leave_id" value="">
            <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
            <div class="form-group row">
                <label for="type" class="col-sm-3 col-form-label"><i>Type</i></label>
                <div class="col-sm-9">
                    <select class="form-control" id="type" name="type">
                        <option disabled selected>Select a Leave Type</option>
                        @foreach ($leavetype as $lt)
                            <option value="{{ $lt->id }}">{{ $lt->type_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="duration" class="col-sm-3 col-form-label"><i>Duration</i></label>
                <div class="col-sm-9">
                    <select class="form-control" id="duration" name="duration">
                        <option selected disabled>Select Duration</option>
                        <option value="full day">Full Day</option>
                        <option value="half day">Half Day</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="fromDate" class="col-sm-3 col-form-label"><i>From Date</i></label>
                <div class="col-sm-3">
                    <input type="date" class="form-control datetimepicker-input" name="fromdate" placeholder="Begin Leave" id="fromDate" value="" />
                </div>
                <label for="toDate" class="col-sm-3 col-form-label text-center"><i>To Date</i></label>
                <div class="col-sm-3">
                    <input type="date" class="form-control datetimepicker-input" name="todate" placeholder="End Leave" id="toDate" value="" />
                </div>
            </div>
            <div class="form-group row">
                <label for="reason" class="col-sm-3 col-form-label"><i>Reason</i></label>
                <div class="col-sm-9">
                    <textarea class="form-control" rows="3" id="reason" placeholder="Reason of Leave" name="reason"></textarea>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" id="submit" class="btn btn-primary" value="Save Changes">
          </div>
        </form>
      </div>
    </div>
</div>