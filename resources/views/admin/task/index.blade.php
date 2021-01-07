@extends('layout.dash')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col text-right">
                                    <a href="{{ route('admin.tasks.add') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Add New Task
                                    </a>
                                </div>
                            </div>
                            <div class="table-responsive mt-3">
                                <table id="jobTable" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Task</th>
                                            <th style="width: 15%">Assigned To</th>
                                            <th style="width: 15%">Assigned By</th>
                                            <th>Due Date</th>
                                            <th>Status</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1; @endphp
                                        @foreach ($tasks as $task)    
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $task->title }}</td>
                                                <td><img alt="Avatar" class="table-avatar thumb-index-sm" src="{{ (!empty($task->user->profile_photo_path)) ? url('/storage/'.$task->user->profile_photo_path) : url('/img/dummy-profile.svg') }}"> {{ $task->user->name }}</td>
                                                <td><img alt="Avatar" class="table-avatar thumb-index-sm" src="{{ (!empty($task->created_by()->first()->profile_photo_path)) ? url('/storage/'.$task->created_by()->first()->profile_photo_path) : url('/img/dummy-profile.svg') }}"> {{ $task->created_by()->first()->name }}</td>
                                                <td>{{ $task->due_date }}</td>
                                                <td>
                                                    <span class="badge badge-{{ ($task->status == 'incomplete') ? 'danger' : 'success' }}">{{ $task->status }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.tasks.edit', $task->id) }}" class="btn btn-info btn-circle" data-tooltip="tooltip" title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="{{ route('admin.tasks.delete', $task->id) }}" class="btn btn-danger btn-circle delete-confirm" data-tooltip="tooltip" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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