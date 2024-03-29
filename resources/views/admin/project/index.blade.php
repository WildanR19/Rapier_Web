@extends('layout.dash')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @foreach ($smallbox as $sb)
                {!! $sb !!}
            @endforeach
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col text-right">
                        <a href="{{ route('admin.projects.add') }}" class="btn btn-outline-primary"><i class="fas fa-plus"></i> Add New Project</a>
                    </div>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-striped" id="projectTable">
                        <thead>
                            <tr>
                                <th style="width: 1%">#</th>
                                <th>Project Name</th>
                                <th>Team Members</th>
                                <th>Deadline</th>
                                <th>Progress</th>
                                <th>Status</th>
                                <th style="width: 13%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach ($project as $pj)    
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        <a>{{ $pj->project_name }}</a>
                                        <br/>
                                        <small>Created {{ $pj->created_at }}</small>
                                    </td>
                                    <td>
                                        <ul class="row no-gutters list-assigned p-0">
                                            @php $count = 0; @endphp
                                            @foreach ($teammember as $member)
                                                @if ($member->project_id == $pj->id)
                                                    @php if($count++ == 5) break; @endphp
                                                    <li><a href=""><img src="{{ (!empty($member->user->profile_photo_path)) ? url('/storage/'.$member->user->profile_photo_path) : asset('img/dummy-profile.svg') }}" data-tooltip="tooltip" title="{{ $member->user->name }}"></a></li>
                                                @endif
                                            @endforeach
                                            @if ($teammember->where('project_id', $pj->id)->count() > 5)
                                                <li class="ml-2"><a href="" onclick="return false" class="align-middle">and {{ ($teammember->where('project_id', $pj->id)->count() - 5) }} more</a></li>
                                            @endif
                                        </ul>
                                    </td>
                                    <td>{{ $pj->deadline }}</td>
                                    <td class="project_progress">
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-green" role="progressbar" aria-volumenow="{{ $pj->progress_percent }}" aria-volumemin="0" aria-volumemax="100" style="width: {{ $pj->progress_percent }}%">
                                            </div>
                                        </div>
                                        <small>
                                            {{ $pj->progress_percent }}% Complete
                                        </small>
                                    </td>
                                    <td class="project-state">
                                        @php
                                            $status = $pj->status;
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
                                        <span class="badge badge-{{$color}}">{{ $pj->status }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.projects.edit', $pj->id) }}" class="btn btn-info btn-circle" data-tooltip="tooltip" title="Edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="{{ route('admin.projects.details', $pj->id) }}" class="btn btn-success btn-circle" data-tooltip="tooltip" title="Details">
                                            <i class="fas fa-search"></i>
                                        </a>
                                        <a href="{{ route('admin.projects.delete', $pj->id) }}" class="btn btn-danger btn-circle delete-confirm" data-tooltip="tooltip" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</section>
@endsection
@section('js')
    <script>
        // datatable
        $(function () {
            $('#projectTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
            });
        });
    </script>
@endsection
