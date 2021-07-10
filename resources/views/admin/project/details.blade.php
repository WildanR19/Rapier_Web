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
          <div class="col-12">
            <div class="card w-100 p-4">
                <div class="row mb-3">
                    <div class="col">
                        <h4>{{ $project->project_name }} <span class="text-capitalize font-italic">({{ $project->category->category_name }})</span></h4>
                        <h6 class="text-gray">Submitted by <span class="text-primary">{{ $project->user->name }}</span></h6>
                    </div>
                </div>
                <p class="mb-3">{{ $project->project_summary }}</p>
                <div class="row no-gutters align-items-center justify-content-between">
                    <div class="col-md-12">
                        <ul class="row no-gutters list-assigned-detail p-0 align-items-center">
                            @php $count = 0; @endphp
                            @foreach ($members as $member)
                                @if ($member->project_id == $project->id)
                                    @php if($count++ == 5) break; @endphp
                                    <li><a href="" data-toggle="modal" data-target="#member-list"><img src="{{ (!empty($member->user->profile_photo_path)) ? url('/storage/'.$member->user->profile_photo_path) : asset('img/dummy-profile.svg') }}" data-tooltip="tooltip" title="{{ $member->user->name }}"></a></li>
                                @endif
                            @endforeach
                            @if ($members->where('project_id', $project->id)->count() > 5)
                                <li class="ml-2"><a href="" data-toggle="modal" data-target="#member-list">and {{ ($members->where('project_id', $project->id)->count() - 5) }} more</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12">
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-{{ $project->progress_percent == 100 ? 'success' : 'warning'}}" role="progressbar" style="width: {{ $project->progress_percent }}%;" aria-valuenow="{{ $project->progress_percent }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-12">
                        @php
                            $date = strtotime($project->deadline);
                            $day = date('d M Y', $date);
                        @endphp
                        
                        <div class="d-flex justify-content-between">
                            <div>
                                {{ $project->progress_percent }}% Complete
                            </div>
                            <div>
                                Due <span class="text-primary">{{ $day }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
      </div>

      <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#task" data-toggle="tab">Task</a></li>
                    <li class="nav-item"><a class="nav-link" href="#member" data-toggle="tab">Member</a></li>
                    <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                  </ul>
                </div>
              </div>
          </div>
      </div>

      <div class="row">
          <div class="col-md-12">
            <div class="tab-content">
                <div class="active tab-pane" id="task">
                    @include('employee.projects.task-table')
                </div>
                <div class="tab-pane" id="activity">
                    @include('employee.projects.activity-table')
                </div>
                <div class="tab-pane" id="member">
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
                                        @foreach ($members as $tm)
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
              </div>
          </div>
      </div>
  </div>
</section>
@include('employee.projects.modal-member-list')
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
            $('#taskTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
            });
        });
    </script>
@endsection