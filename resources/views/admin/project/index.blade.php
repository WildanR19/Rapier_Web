@extends('layout.dash')

@section('content')
<div class="content">
    <div class="row">
        @foreach ($smallbox as $sb)
            {!! $sb !!}
        @endforeach
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col text-right">
                    <a href="{{ route('admin.projects.add') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Project</a>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-striped" id="projectTable">
                    <thead>
                        <tr>
                            <th style="width: 1%">#</th>
                            <th>Project Name</th>
                            <th style="width: 25%">Team Members</th>
                            <th>Deadline</th>
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
                                    <ul class="list-inline">
                                        @foreach ($teammember as $tm)
                                            @if($tm->project_id == $pj->id)    
                                                @php
                                                    if (!empty($tm->user->profile_photo_path)) {
                                                        $url = url('/storage/'.$tm->user->profile_photo_path);
                                                    }else{
                                                        $url = url('/img/dummy-profile.svg');
                                                    }
                                                @endphp
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar thumb-index" src="{{ $url }}">
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $pj->deadline }}</td>
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
