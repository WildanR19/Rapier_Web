<div class="modal fade" id="create-new-project" tabindex="-1" role="dialog" aria-labelledby="create-new-projectTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title">Create New Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="">
                    <div class="form-group row">
                        <label for="project-title" class="col-sm-3 col-form-label"><em>Title</em></label>
                        <div class="col-sm-9">
                            <input type="text" id="project-title" class="form-control" placeholder="Title of Project" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="project-due-date" class="col-sm-3 col-form-label"><em>Due Date</em></label>
                        <div class="col-sm-9">
                            <select name="" id="project-due-date" class="form-control">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="project-select-status" class="col-sm-3 col-form-label"><em>Select Status</em></label>
                        <div class="col-sm-9">
                            <select name="" id="project-select-status" class="form-control">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="project-description" class="col-sm-3 col-form-label"><em>Description</em></label>
                        <div class="col-sm-9">
                            <textarea name="" id="project-description" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="project-assigned-member" class="col-form-label"><em>Assigned Member(s)</em></label>
                        <input type="text" id="project-assigned-member" class="form-control" placeholder="Type a Name">
                    </div>
                    <!-- </div>
        <div class="modal-footer"> -->
                    <div class="row justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Create Project</button>
                        <!-- <button type="button" class="btn btn-primary">Create Project</button> -->
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
