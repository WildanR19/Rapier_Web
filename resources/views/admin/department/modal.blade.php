<div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addDepartmentModalLabel">Add New Department</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.department.store')}}" method="POST" id="addForm">
                @csrf
                {{-- user table --}}
                <div class="form-group">
                  <label for="InputName">Name</label>
                  <input type="text" class="form-control" id="InputName" name="name">
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" form="addForm">Save</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="editDepartmentModal" tabindex="-1" aria-labelledby="editDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editDepartmentModalLabel">Edit Department</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="deptdata">
          <div class="modal-body">
              <div class="form-group">
                <input type="hidden" id="color_id" name="color_id" value="">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn" data-dismiss="modal">Cancel</button>
            <input type="submit" id="submit" class="btn btn-primary" value="Save">
          </div>
        </form>
      </div>
    </div>
</div>