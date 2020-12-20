<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col text-center my-auto border-right">
                        <div class="image">
                            <img src="{{ asset('img/dummy-profile.svg') }}" alt="User Image" width="200px" id="imgTeam">
                        </div>
                        <div class="head mt-2">
                            <h2 id="nameTeam">Team Member 1</h2>
                            <h5 style="color: #59BECD;"><i id="roleTeam">Role</i></h5>
                            <p id="deptTeam" style="color: #6c757d;">Department</p>
                        </div>
                        <div class="foot mt-4">
                            <p>Joined Kount <br> since Oktober 2020</p>
                        </div>
                    </div>
                    <div class="col my-auto">
                        <div class="px-5">
                            <div class="contact-info">
                                <h5><i>Contact Info</i></h5>
                                <p>+62 812 3456 7890</p>
                                <p>emailaddress@domain.com</p>
                            </div>
                            <div class="birth mt-5">
                                <h5><i>Date of Birth</i></h5>
                                <p>01 January</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5 justify-content-center">
                    <button class="btn bg-oren rounded shadow-sm" id="btnBackToTeam" onclick="backToTeam()"><strong><i>Back to Org Chart</i></strong></button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editContactModal" tabindex="-1" aria-labelledby="editContactModalLabel" aria-hidden="true">
    <div class="modal-dialog edit-contact modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <h5 class="modal-title" id="editContactModalLabel">Edit Contact Info</h5>
                
                <form action="" class="pl-3 mt-4">
                    <div class="form-group row">
                        <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputPhone" placeholder="+62 812 3456 7890" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail" placeholder="emailaddress@domain.com" value="">
                        </div>
                    </div>
                </form>
                <div class="col text-center mt-4">
                    <button type="submit" class="btn btn-secondary">Apply Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>
