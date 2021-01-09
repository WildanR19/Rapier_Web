<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Goals</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="goalupdate">
                    @csrf
                    <input type="hidden" id="goal_id" name="goal_id" value="">
                    <div class="form-group row">
                        <label for="progress" class="col-sm-4 col-form-label"><em>Progress (%) :</em></label>
                        <div class="col-sm-8 my-auto">
                            <div class="range-value" id="rangeV"></div>
                            <input type="range" class="form-control-range" id="progress" name="progress" value="0" min="0" max="100" step="5">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <button type="submit" class="btn bg-oren" id="submit"><strong><i>Submit</i></strong></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h5 id="title-goal"></h5>
                    </div>
                    <div class="col-sm-6"><small>Due Date</small></div>
                    <div class="col-sm-6"><small>Status</small></div>
                    <div class="col-sm-6" id="due-date-goal"></div>
                    <div class="col-sm-6" id="status-goal"></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6 text-gray">Description</div>
                    <div class="col-sm-6" id="desc-goal"></div>
                    <div class="col-sm-6 text-gray">Priority</div>
                    <div class="col-sm-6" id="priority-goal"></div>
                    <div class="col-sm-6 text-gray">Completed On</div>
                    <div class="col-sm-6" id="completed-goal"></div>
                </div>
            </div>
        </div>
    </div>
</div>
