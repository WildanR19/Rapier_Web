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
          <table class="table table-sm" id="modal_table">
            <thead class="thead-light">
              <tr>
                  <th>Name</th>
                  <th>Color</th>
                  <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($type as $tp)
                  <tr>
                      <td class="text-capitalize">{{ $tp->type_name }}</td>
                      <td class="text-{{ $tp->color }}">{{ $tp->color }}</td>
                      <td><a href="{{ route('admin.leaves.delete.type', $tp->id) }}" class="btn btn-sm btn-outline-danger">Remove</a></td>
                  </tr>
              @endforeach
            </tbody>
          </table>
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