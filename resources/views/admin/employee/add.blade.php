@extends('layout.dash')
@section('css')
    <style>
        ul{
            list-style-type: disc;        
            padding-inline-start: 40px;
        }
        .img-thumbnail{
            height: 150px;
            width: 150px;
            object-fit: cover;
            object-position: center;
        }
    </style>
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('admin.employee.store') }}" method="POST" enctype="multipart/form-data">
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
                                <div class="form-group col-md-6">
                                    <label for="InputDepartment">Department</label>
                                    <select id="inputDepartment" class="form-control" name="dept">
                                        <option disabled selected>Choose...</option>
                                        @foreach ($dept as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="InputJob">Job</label>
                                    <select id="inputJob" class="form-control" name="job">
                                        <option disabled selected>Choose...</option>
                                        @foreach ($job as $j)
                                            <option value="{{ $j->id }}">{{ $j->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="InputPhone">Phone</label>
                                    <input type="text" class="form-control" id="InputPhone" name="phone" placeholder="08xxxx">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="InputGender">Gender</label>
                                    <select id="inputGender" class="form-control" name="gender">
                                        <option disabled selected>Choose...</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="others">Other</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
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
                                    <label for="InputStatus">Employee Status
                                        <button type="button" class="btn btn-sm btn-primary rounded-circle" data-tooltip="tooltip" title="Add new employee status" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i></button>
                                    </label>
                                    <select id="inputStatus" class="form-control" name="status">
                                        <option disabled selected>Choose...</option>
                                        @foreach ($status as $stat)
                                            <option value="{{ $stat->id }}">{{ $stat->status_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="InputJoinDate">Joining Date</label>
                                    <input type="date" class="form-control" id="InputJoinDate" name="join_date">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="InputLastDate">Last Date</label>
                                    <input type="date" class="form-control" id="InputLastDate" name="last_date">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="InputPicture">Profile Picture</label>
                                <div>
                                    <img src="{{ asset('img/dummy-profile.svg') }}" alt="Profile Picture" class="img-thumbnail" id="thumbnail">
                                    <small class="align-bottom">*Max 2MB</small>
                                </div>
                                <input type="file" id="InputPicture" name="photo">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.employee.modal')
@endsection
@section('js')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    $('#thumbnail').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#InputPicture").change(function() {
            readURL(this);
        });
    </script>
@endsection