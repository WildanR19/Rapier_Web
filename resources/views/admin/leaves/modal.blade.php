<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="rejectModalLabel">Leave Reject Reason</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formReject">
        <div class="modal-body">
          <div class="row">
              <div class="col-md-12">
                  <input type="hidden" id="leave_id" name="leave_id" value="">
                  <div class="form-group">
                      <label for="reason">Reject Reason (optional)</label>
                      <textarea name="reason" id="reason" rows="3" class="form-control"></textarea>
                  </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger" id="submitReject">Reject</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exportModalLabel">Filtering Export Leaves Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.leaves.export') }}" method="Get">
        <div class="modal-body">
          <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                    <label for="InputEmp">Choose Employee</label>
                    <select id="inputEmp" class="form-control" name="employee">
                        <option disabled selected>Choose...</option>
                        @foreach ($emp as $e)
                            <option value="{{ $e->id }}">{{ $e->name }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="InputMonth">Month</label>
                      <select id="inputMonth" class="form-control" name="month">
                        <option disabled selected>Choose...</option>
                        @for ($m=1; $m<=12; $m++)
                          <option value="{{ $m }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                        @endfor
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="InputYear">Year</label>
                      <select id="inputYear" class="form-control" name="year">
                        <option disabled selected>Choose...</option>
                        @php $years = null; @endphp
                        @foreach ($leave as $lv)
                          @if (date('Y', strtotime($lv->from_date)) != $years)
                            @php $years = date('Y', strtotime($lv->from_date)); @endphp
                            <option value="{{ $years }}">{{ $years }}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success"><i class="fas fa-print"></i> Export</button>
        </div>
      </form>
    </div>
  </div>
</div>