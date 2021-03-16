<div class="modal fade" id="autoModal" tabindex="-1" aria-labelledby="autoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="autoModalLabel">Auto Generate Payslip</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('admin.payslip.autogenerate') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="from_date">From Date</label>
                        <input type="date" class="form-control" id="from_date" name="from_date">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="to_date">To Date</label>
                        <input type="date" class="form-control" id="to_date" name="to_date">
                    </div>
                </div>
                <div class="form-group">
                    <label for="payment">Payment</label>
                    <select id="payment" class="form-control" name="payment">
                        <option disabled selected>Choose...</option>
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Generate</button>
            </div>
        </form>
      </div>
    </div>
  </div>