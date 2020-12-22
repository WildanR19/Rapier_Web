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
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('dash.employee.add') }}" class="btn btn-primary">Add New Employee</a>
                                </div>
                            </div>
                            <div class="table-responsive mt-3">
                                <table id="empTable" class="table">
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
                                                <td>{{ $emp->status }}</td>
                                                <td>{{ $emp->created_at }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-info rounded-circle">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-info rounded-circle">
                                                        <i class="fas fa-info"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-info rounded-circle">
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
<script>
    $(function () {
        $('#empTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": true,
        });
    });
</script>
@endsection