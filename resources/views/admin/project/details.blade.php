@extends('layout.dash')

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .img-member{
            height: 40px;
            width: 40px;
            object-fit: cover;
            object-position: center;
        }
    </style>
@endsection
@section('content')

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#overview" data-toggle="tab">Overview</a></li>
                  <li class="nav-item"><a class="nav-link" href="#members" data-toggle="tab">Members</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tasks" data-toggle="tab">Tasks</a></li>
                  <li class="nav-item"><a class="nav-link" href="#files" data-toggle="tab">Files</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                </ul>
              </div>
            </div>
            <div class="tab-content">
              <div class="active tab-pane" id="overview">
                <div class="row">
                    <div class="col-md-12">
                        <div class="callout callout-info">
                            <div class="d-flex justify-content-between">
                                <h4>Project - <b>{{ $project->project_name }}</b></h4>
                                <div class="dropdown">
                                    <button class="btn btn-default text-capitalize" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $project->status }} <i class="fas fa-circle"></i></button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <a class="dropdown-item" href="#">Action</a>
                                      <a class="dropdown-item" href="#">Another action</a>
                                      <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                      <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="fas fa-tasks"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Tasks</span>
                          <span class="info-box-number">0</span>
          
                          <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                      <div class="info-box bg-success">
                        <span class="info-box-icon"><i class="fas fa-comments"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Members</span>
                          @php
                            $cemp = $user->count();
                            $ctm = $teammember->count();
                            $tmpercent = ($ctm/$cemp)*100;
                          @endphp
                          <span class="info-box-number">{{ $ctm }}</span>
          
                          <div class="progress">
                            <div class="progress-bar" style="width: {{ $tmpercent }}%"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                      <div class="info-box bg-warning">
                        <span class="info-box-icon"><i class="far fa-calendar"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Days Left</span>
                          @php
                            $dl = strtotime($project->deadline);
                            $now = strtotime(now());
                            $count = floor(($dl-$now) / (60 * 60 * 24));
                            $start = strtotime($project->start_date);
                            $diff = floor(($dl-$start) / (60 * 60 * 24));
                            $percent = 100-(($count/$diff)*100);
                          @endphp
                          <span class="info-box-number">{{ $count }}</span>
          
                          <div class="progress">
                            <div class="progress-bar" style="width: {{ $percent }}%"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                      <div class="info-box bg-danger">
                        <span class="info-box-icon"><i class="fas fa-exclamation-triangle"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Completion</span>
                          <span class="info-box-number">0</span>
          
                          <div class="progress">
                            <div class="progress-bar" style="width: 0%"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>

              <div class="tab-pane" id="members">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Members</h5>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teammember as $tm)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('storage/'.$tm->user->profile_photo_path) }}" alt="{{ $tm->user->name }}" class="img-member rounded-circle"> {{ $tm->user->name }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.projects.member.delete', $tm->id) }}" class="btn btn-sm btn-danger delete-confirm"><i class="fas fa-times"></i> Remove</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">Add Project Members</div>
                            <div class="card-body">
                                <form action="{{ route('admin.projects.member.add') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $project->id }}">
                                    <div class="form-group">
                                        <label for="member">Project Member</label>
                                        <select class="select2 form-control" multiple="multiple" data-placeholder="Select Member" id="member" name="member[]">
                                            @foreach ($emp as $member)
                                                <option value="{{ $member->id }}">{{ $member->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
              </div>

              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <div class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <div class="time-label">
                    <span class="bg-danger">
                      10 Feb. 2014
                    </span>
                  </div>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <div>
                    <i class="fas fa-envelope bg-primary"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="far fa-clock"></i> 12:05</span>

                      <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                      <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                        quora plaxo ideeli hulu weebly balihoo...
                      </div>
                      <div class="timeline-footer">
                        <a href="#" class="btn btn-primary btn-sm">Read more</a>
                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                      </div>
                    </div>
                  </div>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <div>
                    <i class="fas fa-user bg-info"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                      <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                      </h3>
                    </div>
                  </div>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <div>
                    <i class="fas fa-comments bg-warning"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                      <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                      <div class="timeline-body">
                        Take me to your leader!
                        Switzerland is small and neutral!
                        We are more like Germany, ambitious and misunderstood!
                      </div>
                      <div class="timeline-footer">
                        <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                      </div>
                    </div>
                  </div>
                  <!-- END timeline item -->
                  <!-- timeline time label -->
                  <div class="time-label">
                    <span class="bg-success">
                      3 Jan. 2014
                    </span>
                  </div>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <div>
                    <i class="fas fa-camera bg-purple"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                      <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                      <div class="timeline-body">
                        <img src="http://placehold.it/150x100" alt="...">
                        <img src="http://placehold.it/150x100" alt="...">
                        <img src="http://placehold.it/150x100" alt="...">
                        <img src="http://placehold.it/150x100" alt="...">
                      </div>
                    </div>
                  </div>
                  <!-- END timeline item -->
                  <div>
                    <i class="far fa-clock bg-gray"></i>
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="files">
                <form class="form-horizontal">
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName2" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
    </div>
</div>
@endsection

@section('js')
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(".select2").select2({
            allowClear: false,
            minimumResultsForSearch: 5,
            theme: 'bootstrap4'
        });
    </script>
@endsection