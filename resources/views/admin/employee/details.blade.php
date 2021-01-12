@extends('layout.dash')
@section('css')
    <style>
        .description-header{
            font-weight: 500;
            text-transform: uppercase;
            font-size: 14px;
            margin: 0px 0px 12px;
        }
        .widget-user .widget-user-image > img {
            height: 90px !important;
            object-fit: cover;
            object-position: center;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="card card-widget widget-user">
                        <div class="widget-user-header bg-info">
                          <h3 class="widget-user-username">{{ $user->name }}</h3>
                          <h5 class="widget-user-desc">{{ $ed->job->name }}</h5>
                        </div>
                        <div class="widget-user-image">
                          <img class="img-circle elevation-2" src="{{ $user->profile_photo_url }}" alt="User Avatar">
                        </div>
                        <div class="card-footer">
                          {!! $card !!}
                        </div>
                      </div>
                </div>
                <div class="col-md-7">
                    <div class="card card-primary card-outline card-outline-tabs">
                      <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="profile-tab" data-toggle="pill" href="#tab-profile" role="tab" aria-controls="tab-profile" aria-selected="true">Profile</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="project-tab" data-toggle="pill" href="#tab-project" role="tab" aria-controls="tab-project" aria-selected="false">Projects</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="goal-tab" data-toggle="pill" href="#tab-goal" role="tab" aria-controls="tab-goal" aria-selected="false">Goals</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="leave-tab" data-toggle="pill" href="#tab-leave" role="tab" aria-controls="tab-leave" aria-selected="false">Leaves</a>
                          </li>
                        </ul>
                      </div>
                      <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                          <div class="tab-pane fade active show" id="tab-profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row">
                                <div class="col-md-4 border-right"> <strong>Name</strong> <br>
                                    <p class="text-muted">{{ $user->name }}</p>
                                </div>
                                <div class="col-md-4 border-right"> <strong>Email</strong> <br>
                                    <p class="text-muted">{{ $user->email }}</p>
                                </div>
                                <div class="col-md-4"> <strong>Gender</strong> <br>
                                    <p class="text-muted text-capitalize">{{ $ed->gender }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4 border-right"> <strong>Department</strong> <br>
                                    <p class="text-muted">{{ $ed->department->name }}</p>
                                </div>
                                <div class="col-md-4 border-right"> <strong>Job</strong> <br>
                                    <p class="text-muted">{{ $ed->job->name }}</p>
                                </div>
                                <div class="col-md-4"> <strong>Joining Date</strong> <br>
                                    <p class="text-muted">{{ $ed->join_date }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 border-right">
                                    <strong>Employee Status</strong>
                                    <br><p class="text-muted">{{ $ed->status->status_name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Phone</strong>
                                    <br><p class="text-muted">{{ $ed->phone }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <strong>Address</strong>
                                    <br><p class="text-muted">{{ $ed->address }}</p>
                                </div>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="tab-project" role="tabpanel" aria-labelledby="project-tab">
                            <div class="table-responsive">
                                <table class="table table-striped datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Project</th>
                                            <th>Deadline</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($projects as $project)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $project->project_name }}</td>
                                                <td>{{ date('j-m-Y', strtotime($project->deadline)) }}</td>
                                                <td>
                                                    @php
                                                        $status = $project->status;
                                                        if ($status == 'not started') {
                                                            $color = 'dark';
                                                        }elseif ($status == 'in progress') {
                                                            $color = 'info';
                                                        }elseif ($status == 'on hold') {
                                                            $color = 'warning';
                                                        }elseif ($status == 'canceled') {
                                                            $color = 'danger';
                                                        }else{
                                                            $color = 'success';
                                                        }
                                                    @endphp
                                                    <span class="badge badge-{{$color}}">{{ $project->status }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> 
                          </div>
                          <div class="tab-pane fade" id="tab-goal" role="tabpanel" aria-labelledby="goal-tab">
                            <div class="table-responsive">
                                <table class="table table-striped datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Goal</th>
                                            <th>Due Date</th>
                                            <th>Progress</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($goals as $goal)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $goal->title }}</td>
                                                <td>{{ date('j-m-Y', strtotime($goal->due_date)) }}</td>
                                                <td>
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar bg-green" role="progressbar" aria-volumenow="{{ $goal->progress_percent }}" aria-volumemin="0" aria-volumemax="100" style="width: {{ $goal->progress_percent }}%">
                                                        </div>
                                                    </div>
                                                    <small>
                                                        {{ $goal->progress_percent }}% Complete
                                                    </small>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> 
                          </div>
                          <div class="tab-pane fade" id="tab-leave" role="tabpanel" aria-labelledby="leave-tab">
                            <ul class="nav flex-column">
                                @foreach ($leaveTab as $leavetab)
                                    {!! $leavetab !!}
                                @endforeach
                            </ul>
                            <div class="table-responsive mt-3">
                                <table class="table table-striped datatable">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>From Date</th>
                                            <th>To Date</th>
                                            <th>Reason</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($leave as $leaves)
                                            <tr>
                                                <td><span class="badge bg-{{ $leaves->type->color }} badge">{{ $leaves->type->type_name }}</span></td>
                                                <td>{{ $leaves->from_date }}</td>
                                                <td>{{ $leaves->to_date }}</td>
                                                <td>{{ $leaves->reason }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    //datatable
    $(function () {
        $('.datatable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "pageLength": 5,
        });
    });
</script>
@endsection