@extends('layout.dash')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form>
                            {{-- user table --}}
                            <div class="form-group">
                              <label for="InputName">Name</label>
                              <input type="text" class="form-control" id="InputName">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="InputEmail">Email address</label>
                                  <input type="email" class="form-control" id="InputEmail">
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="InputPassword">Password</label>
                                  <input type="password" class="form-control" id="InputPassword">
                                </div>
                            </div>

                            {{-- employee detail table --}}
                            <div class="form-group">
                              <label for="InputAddress">Address</label>
                              <textarea class="form-control" id="InputAddress" rows="3"></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="InputDepartment">Department</label>
                                    <select id="inputDepartment" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <label for="InputJob">Jobs</label>
                                    <select id="inputJob" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <label for="InputGender">Gender</label>
                                    <select id="inputGender" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <label for="InputRole">Role</label>
                                    <select id="inputRole" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>Admin</option>
                                        <option>Employee</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="InputJoinDate">Joining Date</label>
                                    <input type="date" class="form-control" id="InputJoinDate">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="InputLastDate">Last Date</label>
                                    <input type="date" class="form-control" id="InputLastDate">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="InputPicture">Profile Picture</label>
                                <div>
                                    <img src="..." alt="..." class="img-thumbnail">
                                </div>
                                <input type="file" id="InputPicture">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
