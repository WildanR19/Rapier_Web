<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Add New Employee Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-sm" id="modal_table">
            <thead class="thead-light">
              <tr>
                  <th>Name</th>
                  <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($status as $st)
                  <tr>
                      <td class="text-capitalize">{{ $st->status_name }}</td>
                      <td><a href="{{ route('admin.employee.delete.status', $st->id) }}" class="btn btn-sm btn-outline-danger">Remove</a></td>
                  </tr>
              @endforeach
            </tbody>
          </table>
          <form action="{{ route('admin.employee.add.status') }}" method="post" id="formStatus">
              @csrf
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label for="status">Employee Status</label>
                          <input type="text" id="status" name="status" class="form-control">
                      </div>
                  </div>
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" form="formStatus">Submit</button>
        </div>
      </div>
    </div>
</div>