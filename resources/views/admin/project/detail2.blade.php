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

<section class="content">
  <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#overview" data-toggle="tab">Overview</a></li>
                  <li class="nav-item"><a class="nav-link" href="#members" data-toggle="tab">Members</a></li>
                  <li class="nav-item"><a class="nav-link" href="#updates" data-toggle="tab">Updates Timeline</a></li>
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
                                    <button class="btn btn-default text-capitalize" type="button">{{ $project->status }} <i class="fas fa-circle text-info"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
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
                      <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="fas fa-exclamation-triangle"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Total Updates</span>
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
                            <div class="card-header">Members</div>
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
                                                    @php
                                                      if (!empty($tm->user->profile_photo_path)) {
                                                          $url = url('/storage/'.$tm->user->profile_photo_path);
                                                      }else{
                                                          $url = url('/img/dummy-profile.svg');
                                                      }
                                                    @endphp
                                                    <img src="{{ $url }}" alt="{{ $tm->user->name }}" class="img-member rounded-circle"> {{ $tm->user->name }}
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

              <div class="tab-pane" id="updates">
                <div class="card">
                  <div class="card-body">
                    <div class="timeline timeline-inverse">
                      @php $previous_date = null; @endphp
                      @foreach ($updates as $update)
                        @if (date('j M, Y', strtotime($update->updated_at)) != $previous_date)
                          @php $previous_date = date('j M, Y', strtotime($update->updated_at)); @endphp
                          <div class="time-label">
                            <span class="bg-danger">
                              {{ $previous_date }}
                            </span>
                          </div>
                        @endif
                        <div>
                          <i class="fas fa-envelope bg-primary"></i>
      
                          <div class="timeline-item">
                            <span class="time"><i class="far fa-clock"></i> {{ date('H:i', strtotime($update->updated_at)) }}</span>
                            <h3 class="timeline-header"><a href="#">{{ $update->user->name }}</a> on Project <a href="#">{{ $update->project->project_name }}</a></h3>
      
                            <div class="timeline-body">
                              {{ $update->comment }}
                              @if (!empty($update->file))    
                                <div class="row no-gutters border-left pl-4">
                                    <h6><b>1</b> total attachment <a href="{{ route('admin.projects.download', $update->id)}}">Download</a></h6>
                                </div>
                              @endif
                            </div>
                            <div class="timeline-footer">
                              <a href="{{ route('dash.projects.delete', $update->id) }}" class="btn btn-danger btn-sm delete-confirm">Delete</a>
                            </div>
                          </div>
                        </div>
                      @endforeach
                      <div>
                        <i class="far fa-clock bg-gray"></i>
                      </div>
                    </div>
                    <div>
                      <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#submit-update"><em>Submit an Update</em></button>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
    </div>
  </div>a
</section>
@include('admin.project.modal-submit-update')
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

        //datatable
        $(function () {
            $('#jobTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
            });
        });
    </script>
@endsection