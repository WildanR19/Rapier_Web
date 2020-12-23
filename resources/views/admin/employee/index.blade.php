@extends('layout.dash')
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <!-- Sweet Alert -->
    <link href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    <style>
        .label-status {
            letter-spacing: .05em;
            border-radius: 60px;
            padding: 4px 12px;
            font-size: small;
            font-weight: 500 !important;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col text-right">
                                    <a href="{{ route('dash.employee.add') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Employee</a>
                                </div>
                            </div>
                            <div class="table-responsive mt-3">
                                <table id="empTable" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>User Role</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1; @endphp
                                        @foreach ($user as $emp)    
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $emp->name }}</td>
                                                <td>{{ $emp->email }}</td>
                                                <td>{{ $emp->role->name }}</td>
                                                <td>
                                                    @if ($emp->status == 'Active')
                                                        <label class="label-status bg-success">{{ $emp->status }}</label>
                                                    @endif
                                                    @if ($emp->status == 'Deactive')
                                                        <label class="label-status bg-danger">{{ $emp->status }}</label>
                                                    @endif
                                                </td>
                                                <td>{{ $emp->created_at }}</td>
                                                <td>
                                                    <a href="/admin/employee/update/{{ $emp->id }}" class="btn btn-info rounded-circle px-2 py-1" data-toggle="tooltip" title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="{{ route('dash.employee.details') }}" class="btn btn-success rounded-circle px-2 py-1" data-toggle="tooltip" title="Details">
                                                        <i class="fas fa-search"></i>
                                                    </a>
                                                    <a href="/admin/employee/delete/{{ $emp->id }}" class="btn btn-danger rounded-circle px-2 py-1 delete-confirm" data-toggle="tooltip" title="Delete">
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
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<!-- Sweet Alert -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    $(function () {
        $('#empTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
        });
    });
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });

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
                Swal.fire(
                    'Deleted!',
                    'Your data has been deleted.',
                    'success'
                );
                window.location.href = url;
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire('Cancelled', '', 'error')
            }
        });
    });
</script>
@endsection