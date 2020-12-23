@extends('layout.dash')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            {{-- user table --}}
                            <div class="form-group">
                              <label for="InputName">Name</label>
                              <input type="text" class="form-control" id="InputName" name="name">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="InputEmail">Email address</label>
                                  <input type="email" class="form-control" id="InputEmail" name="email">
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="InputPassword">Password</label>
                                  <input type="password" class="form-control" id="InputPassword" name="password">
                                </div>
                            </div>

                            {{-- employee detail table --}}
                            <div class="form-group">
                              <label for="InputAddress">Address</label>
                              <textarea class="form-control" id="InputAddress" rows="3" name="address"></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="InputDepartment">Department</label>
                                    <select id="inputDepartment" class="form-control" name="dept">
                                        <option disabled selected>Choose...</option>
                                        @foreach ($dept as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <label for="InputJob">Jobs</label>
                                    <select id="inputJob" class="form-control" name="job">
                                        <option disabled selected>Choose...</option>
                                        @foreach ($job as $j)
                                            <option value="{{ $j->id }}">{{ $j->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <label for="InputGender">Gender</label>
                                    <select id="inputGender" class="form-control" name="gender">
                                        <option disabled selected>Choose...</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="others">Other</option>
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <label for="InputRole">Role</label>
                                    <select id="inputRole" class="form-control" name="role">
                                        <option disabled selected>Choose...</option>
                                        @foreach ($role as $r)
                                            <option value="{{ $r->id }}">{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="InputJoinDate">Joining Date</label>
                                    <input type="date" class="form-control" id="InputJoinDate" name="join_date">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="InputLastDate">Last Date</label>
                                    <input type="date" class="form-control" id="InputLastDate" name="last_date">
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
