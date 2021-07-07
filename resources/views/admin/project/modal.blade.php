<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addCategoryModalLabel">Add Project Category</h5>
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
                @foreach ($category as $cat)
                    <tr>
                        <td class="text-capitalize">{{ $cat->category_name }}</td>
                        <td><a href="{{ route('admin.projects.category.delete', $cat->id) }}" class="btn btn-sm btn-outline-danger">Remove</a></td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            <form action="{{ route('admin.projects.category.add') }}" method="post" id="formCat">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="inputcategory">Category Name</label>
                            <input type="text" id="inputcategory" name="category" class="form-control">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" form="formCat">Save</button>
        </div>
      </div>
    </div>
</div>