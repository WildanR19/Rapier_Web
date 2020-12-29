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
                            <a class="nav-link" id="task-tab" data-toggle="pill" href="#tab-task" role="tab" aria-controls="tab-task" aria-selected="false">Tasks</a>
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
                                <div class="col-md-12">
                                    <strong>Employee Status</strong>
                                    <br><p class="text-muted">{{ $ed->status->status_name }}</p>
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
                             Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam. 
                          </div>
                          <div class="tab-pane fade" id="tab-task" role="tabpanel" aria-labelledby="task-tab">
                             Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna. 
                          </div>
                          <div class="tab-pane fade" id="tab-leave" role="tabpanel" aria-labelledby="leave-tab">
                            <ul class="nav flex-column">
                                @foreach ($leaveTab as $leavetab)
                                    {!! $leavetab !!}
                                @endforeach
                            </ul>
                            <div class="table-responsive mt-3">
                                <table class="table table-stripped">
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