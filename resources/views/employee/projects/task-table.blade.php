<div class="card">
    <div class="card-body">
        <div class="table-responsive mt-3">
            <table class="table table-hover" id="taskTable">
                <thead>
                    <tr>
                        <th style="width: 1%">#</th>
                        <th>Task</th>
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
                                @if ($task->user_id == Auth::user()->id)
                                    <a href="{{ route('task.details', $task->id) }}">{{ $task->title }}</a>
                                @else
                                    <a>{{ $task->title }}</a>    
                                @endif
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
                                @if ($task->user_id == Auth::user()->id)
                                    <a href="{{ route('task.edit', $task->id) }}" class="btn btn-info btn-circle" data-tooltip="tooltip" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
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