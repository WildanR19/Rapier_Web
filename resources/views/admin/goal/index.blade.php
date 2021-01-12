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
                                    <a href="{{ route('admin.goals.add') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> New Goal
                                    </a>
                                </div>
                            </div>
                            <div class="table-responsive mt-3">
                                <table id="datatable" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th style="width: 15%">Employee</th>
                                            <th>Due Date</th>
                                            <th>Status</th>
                                            <th>Progress</th>
                                            <th style="width: 15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1; @endphp
                                        @foreach ($goals as $goal)    
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $goal->title }}</td>
                                                <td><img alt="Avatar" class="table-avatar thumb-index-sm" src="{{ (!empty($goal->user->profile_photo_path)) ? url('/storage/'.$goal->user->profile_photo_path) : url('/img/dummy-profile.svg') }}"> {{ $goal->user->name }}</td>
                                                <td>{{ $goal->due_date }}</td>
                                                <td>
                                                    <span class="badge badge-{{ ($goal->status == 'incomplete') ? 'danger' : 'success' }}">{{ $goal->status }}</span>
                                                </td>
                                                <td class="project_progress">
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar bg-green" role="progressbar" aria-volumenow="{{ $goal->progress_percent }}" aria-volumemin="0" aria-volumemax="100" style="width: {{ $goal->progress_percent }}%">
                                                        </div>
                                                    </div>
                                                    <small>
                                                        {{ $goal->progress_percent }}% Complete
                                                    </small>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.goals.edit', $goal->id) }}" class="btn btn-info btn-circle" data-tooltip="tooltip" title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="{{ route('admin.goals.delete', $goal->id) }}" class="btn btn-danger btn-circle delete-confirm" data-tooltip="tooltip" title="Delete">
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
        $('#datatable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "info": true,
            "ordering": false,
        });
    });
</script>
@endsection