<div class="modal fade" id="add-goal" tabindex="-1" role="dialog" aria-labelledby="edit-projectTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title">Add a New Goal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('dash.goals.add') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="goal-name" class="col-sm-3 col-form-label"><em>Name</em></label>
                        <div class="col-sm-9">
                            <input type="text" name="title" id="goal-name" class="form-control" placeholder="Name of the Goal">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="goal-desc" class="col-sm-3 col-form-label"><em>Description</em></label>
                        <div class="col-sm-9">
                            <textarea name="description" id="goal-desc" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="goal-due" class="col-sm-3 col-form-label"><em>Due Date</em></label>
                        <div class="col-sm-9">
                            <input type="date" name="duedate" id="goal-due" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="goal-priority" class="col-sm-3 col-form-label"><em>Priority</em></label>
                        <div class="col-sm-9">
                            <div class="switch-field">
                                <input class="form-check-input" type="radio" name="priority" id="low" value="low">
                                <label class="form-check-label" for="low">Low</label>
                                <input class="form-check-input" type="radio" name="priority" id="medium" value="medium">
                                <label class="form-check-label" for="medium">Medium</label>
                                <input class="form-check-input" type="radio" name="priority" id="high" value="high" checked>
                                <label class="form-check-label" for="high">High</label>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-secondary">
                            Add Goal
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
