@extends('layout.dash')
@section('css')
<style>
  /* Hide the file input using
opacity */
[type=file] {
    position: absolute;
    filter: alpha(opacity=0);
    opacity: 0;
}
input,
[type=file] + label {
  border: 1px solid #CCC;
  border-radius: 3px;
  text-align: left;
  padding: 8px;
  margin: 0;
  left: 0;
  position: relative;
}
[type=file] + label {
  text-align: center;
  top: 0.5em;
  /* Decorative */
  background: #FF5722;
  color: #fff;
  border: none;
  cursor: pointer;
}
[type=file] + label:hover {
  background: #fa3a00;
}
.card-primary.card-outline {
    border-top: 3px solid #FF5722;
}
</style>   
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img thumb-index-lg"
                     src="{{ Auth::user()->profile_photo_url }}"
                     alt="User profile picture">
              </div>

              <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

              <p class="text-muted text-center">{{ Auth::user()->employee_detail->job->name }}</p>

              <ul class="list-group list-group-unbordered mb-3 mt-3">
                <li class="list-group-item">
                  <b>Join Date</b> <span class="float-right">{{ date('j F, Y', strtotime(Auth::user()->employee_detail->join_date)) }}</span>
                </li>
                <li class="list-group-item">
                  <b>Project Total</b> <span class="float-right">{{ $project->count() }}</span>
                </li>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- About Me Box -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">About Me</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

              <p class="text-muted">{{ Auth::user()->employee_detail->address }}</p>

              <hr>

              <strong><i class="fas fa-phone mr-1"></i> Phone</strong>

              <p class="text-muted">{{ Auth::user()->employee_detail->phone }}</p>

              <hr>

              <strong><i class="fas fa-venus-mars mr-1"></i> Gender</strong>

              <p class="text-muted text-capitalize">{{ Auth::user()->employee_detail->gender }}</p>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profile Information</a></li>
                <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Update Password</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="profile">
                  <div class="card">
                    <form role="form" action="{{ route('dash.profile.update') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="card-body">
                        <div class="form-group">
                          <label>Profile Picture</label>
                          <div>
                              <img src="{{ asset('storage/'.Auth::user()->profile_photo_path) }}" class="img-thumbnail thumb-index-lg" id="thumbnail">
                          </div>
                          <input id="InputPicture" type="file" placeholder="Select a New Photo" name="photo"/>
                          <label for="InputPicture">Select a New Photo</label>
                          <small class="align-bottom">*Max 2MB</small>
                        </div>
                        <div class="form-group">
                          <label for="inputName">Name</label>
                          <input type="text" class="form-control col-md-8" id="inputName" value="{{ Auth::user()->name }}" name="name">
                        </div>
                        <div class="form-group">
                          <label for="inputEmail">Email address</label>
                          <input type="email" class="form-control col-md-8" id="inputEmail" value="{{ Auth::user()->email }}" name="email">
                        </div>
                      </div>
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="tab-pane" id="password">
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
                  <div class="card">
                    <form role="form" action="{{ route('dash.password.update') }}" method="POST">
                      @csrf
                      <div class="card-body">
                        <div class="form-group">
                          <label for="currentpw">Current Password</label>
                          <input type="password" class="form-control col-md-8" id="currentpw" name="password_current">
                        </div>
                        <div class="form-group">
                          <label for="newpw">New Password</label>
                          <input type="password" class="form-control col-md-8" id="newpw" name="password">
                        </div>
                        <div class="form-group">
                          <label for="confirmpw">Confirm Password</label>
                          <input type="password" class="form-control col-md-8" id="confirmpw" name="password_confirmation">
                        </div>
                      </div>
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div><!-- /.card-body -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('js')
    <script>
      $("[type=file]").on("change", function(){
        // Name of file and placeholder
        var file = this.files[0].name;
        var dflt = $(this).attr("placeholder");
        if($(this).val()!=""){
          $(this).next().text(file);
        } else {
          $(this).next().text(dflt);
        }
      });

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