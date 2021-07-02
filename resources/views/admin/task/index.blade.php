@extends('layout.dash')

@section('content')
<div class="content">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col text-right">
                    <a href="{{ route('task.add') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New Task</a>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-striped table-sm" id="projectTable">
                    <thead>
                        <tr>
                            <th style="width: 1%">#</th>
                            <th>Task</th>
                            <th>Project</th>
                            <th>Assigned To</th>
                            <th>Assigned By</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>
                                    <a href="{{ route('task.details', $task->id) }}">{{ $task->title }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.projects.details', $task->project_id) }}">{{ $task->project_name }}</a>
                                </td>
                                <td>
                                    <img alt="Avatar" class="table-avatar thumb-index-sm" src="{{ (!empty($task->profile_photo_path)) ? url('/storage/'.$task->profile_photo_path) : url('/img/dummy-profile.svg') }}"> {{ $task->name }}
                                </td>
                                <td>
                                    <img alt="Avatar" class="table-avatar thumb-index-sm" src="{{ (!empty($task->created_by_image)) ? url('/storage/'.$task->created_by_image) : url('/img/dummy-profile.svg') }}"> {{ $task->created_by_name }}
                                </td>
                                <td>{{ date("d-m-Y", strtotime($task->due_date)) }}</td>
                                <td class="project-state">
                                    <span class="badge badge-{{ $task->status == 'incomplete' ? 'danger' : 'success' }}">{{ $task->status }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('task.edit', $task->id) }}" class="btn btn-info btn-circle" data-tooltip="tooltip" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    @if (Auth::user()->role_id == 1)    
                                        <a href="{{ route('task.delete', $task->id) }}" class="btn btn-danger btn-circle delete-confirm" data-tooltip="tooltip" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    @endif
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
