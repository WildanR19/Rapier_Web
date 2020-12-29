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

@if (request()->segment(3) == 'add')
  <div class="modal fade" id="addTypeModal" tabindex="-1" aria-labelledby="addTypeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addTypeModalLabel">Add New Leave Type</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <form action="{{ route('admin.leaves.add.type') }}" method="post" id="formType">
                  @csrf
                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label for="type">Leave Type</label>
                              <input type="text" id="type" name="type" class="form-control">
                          </div>
                          <div class="form-group">
                              <label for="color">Color of Leave Type</label>
                              <input type="text" id="color" name="color" class="form-control">
                              <small>Please fill with color class bootstrap</small>
                          </div>
                      </div>
                  </div>
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" form="formType">Save changes</button>
          </div>
        </div>
      </div>
  </div>
@endif