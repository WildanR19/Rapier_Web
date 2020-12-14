<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-auto">
                <form>
                    <div class="form-group">
                        <input type="text" placeholder="Enter new amount" style="width: 100%;" id="newAmount" />
                    </div>
                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <strong><i>Target Goal : </i></strong>
                            <strong>X</strong>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control-file" id="formFile">
                    </div>
                    <div class="col text-center">
                    </div>
                </form>
                <div class="col text-center">
                    <button type="submit" class="btn bg-oren" onclick="updateProgress()"><strong><i>Submit</i></strong></button>
                </div>
            </div>
        </div>
    </div>
</div>
