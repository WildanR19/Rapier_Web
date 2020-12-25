@extends('layout.dash')
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1; @endphp
                                        @foreach ($dept as $d)    
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $d->name }}</td>
                                                <td>
                                                    <a href="" id="editDept" class="btn btn-info btn-circle" data-tooltip="tooltip" title="Edit" data-toggle="modal" data-target="#editDepartmentModal" data-id="{{ $d->id }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="/admin/department/delete/{{ $d->id }}" class="btn btn-danger btn-circle delete-confirm" data-tooltip="tooltip" title="Delete">
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
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
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

    //alert delete
    $(document).on('click', '.delete-confirm', function (e) {
        e.preventDefault();
        const url = $(this).attr('href');
        swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.href = url;
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire('Cancelled', '', 'error')
            }
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