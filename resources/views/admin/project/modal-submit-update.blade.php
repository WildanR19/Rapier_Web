<div class="modal fade" id="submit-update" tabindex="-1" role="dialog" aria-labelledby="edit-projectTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title">Submit an Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('dash.projects.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="form-group row">
                        <label for="project-comment" class="col-sm-3 col-form-label"><em>Comment</em></label>
                        <div class="col-sm-9">
                            <textarea name="comment" id="project-comment" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="file" class="col-sm-3 col-form-label"><em>File</em></label>
                        <div class="col-sm-9">
                            <input type="file" id="file" name="file">
                            <small>*Max 10MB</small>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-secondary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
