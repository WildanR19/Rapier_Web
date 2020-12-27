@extends('layout.dash')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col text-right">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDepartmentModal">
                                        <i class="fas fa-plus"></i> Add New Department
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive mt-3">
                                <table id="empTable" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Total Employee</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1; @endphp
                                        @foreach ($dept as $d)    
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $d->name }}</td>
                                                @php
                                                    $count = $d->employee_detail->count();
                                                    if ($count == 0) {
                                                        $color = 'warning';
                                                    }else {
                                                        $color = 'success';
                                                    }
                                                @endphp
                                                <td><label class="label-status bg-{{ $color }}">{{ $count }} Employee</label></td>
                                                <td>
                                                    <a href="" id="editDept" class="btn btn-info btn-circle" data-tooltip="tooltip" title="Edit" data-toggle="modal" data-target="#editDepartmentModal" data-id="{{ $d->id }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="{{ route('admin.department.delete', $d->id) }}" class="btn btn-danger btn-circle delete-confirm" data-tooltip="tooltip" title="Delete">
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

    <!-- Modal -->
    @include('admin.department.modal')
@endsection

@section('js')
<script>
    //datatable
    $(function () {
        $('#empTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
        });
    });

    //modal update
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '#submit', function (event) {
            event.preventDefault()
            var id = $("#color_id").val();
            var name = $("#name").val();

            $.ajax({
                url: 'department/' + id,
                type: "POST",
                data: {
                    id: id,
                    name: name,
                },
                dataType: 'json',
                success: function (data) {
                    $('#deptdata').trigger("reset");
                    $('#editDepartmentModal').modal('hide');
                    window.location.reload(true);
                }
            });
        });
        $('body').on('click', '#editDept', function (event) {
            event.preventDefault();
            var id = $(this).data('id');
            console.log(id)
            $.get('department/' + id + '/edit', function (data) {
                $('#submit').val("Save Changes");
                $('#editDepartmentModal').modal('show');
                $('#color_id').val(data.data.id);
                $('#name').val(data.data.name);
            })
        });
    });
</script>
@endsection