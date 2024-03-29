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