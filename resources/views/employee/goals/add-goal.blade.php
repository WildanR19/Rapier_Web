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
                <form action="">
                    <div class="form-group row">
                        <label for="goal-target" class="col-sm-3 col-form-label"><em>Target Goal</em></label>
                        <div class="col-sm-3">
                            <input type="text" name="" id="goal-target" class="form-control" placeholder="Value to Reach Goal">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="goal-name" class="col-sm-3 col-form-label"><em>Name</em></label>
                        <div class="col-sm-9">
                            <input type="text" name="" id="goal-name" class="form-control" placeholder="Name of the Goal">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="goal-metrics" class="col-sm-3 col-form-label"><em>Metrics</em></label>
                        <div class="col-sm-3">
                            <input type="text" name="" id="goal-metrics" class="form-control" placeholder="Units of the Value">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="goal-lowest" class="col-sm-6 col-form-label">Lowest Value</label>
                                <div class="col-sm-6">
                                    <input type="number" name="" class="form-control" id="goal-lowest" placeholder="Value to be 0%">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="goal-highest" class="col-sm-6 col-form-label">Highest Value</label>
                                <div class="col-sm-6">
                                    <input type="number" name="" class="form-control" id="goal-highest" placeholder="Value to be 100%">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- </div>
        <div class="modal-footer"> -->
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">
                            Add Goal
                        </button>
                        <!-- <button type="button" class="btn btn-primary">Create Project</button> -->
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
