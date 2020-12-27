@extends('layout.dash')
@section('css')
    <style>
        td{
            vertical-align: middle !important;
        }
        .thumb-index{
            height: 50px;
            width: 50px;
            object-fit: cover;
            object-position: center;
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
                                    <a href="{{ route('admin.employee.add') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Employee</a>
                                </div>
                            </div>
                            <div class="table-responsive mt-3">
                                <table id="empTable" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>User Role</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1; @endphp
                                        @foreach ($user as $emp)    
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>
                                                    @if (!empty($emp->profile_photo_path))
                                                        <img src="{{ asset('storage/'.$emp->profile_photo_path) }}" alt="" class="rounded-circle thumb-index">
                                                    @else
                                                        <img src="{{ asset('img/dummy-profile.svg') }}" alt="" class="thumb-index">
                                                    @endif
                                                </td>
                                                <td>{{ $emp->name }}</td>
                                                <td>{{ $emp->email }}</td>
                                                <td>{{ $emp->role->name }}</td>
                                                @php 
                                                    if($emp->status == 'Active'){
                                                        $color = 'success';
                                                    }else {
                                                        $color = 'danger';
                                                    }
                                                @endphp
                                                <td>
                                                    <label class="label-status bg-{{ $color }}">{{ $emp->status }}</label>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.employee.edit', $emp->id) }}" class="btn btn-info btn-circle" data-tooltip="tooltip" title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="{{ route('admin.employee.details', $emp->id) }}" class="btn btn-success btn-circle" data-tooltip="tooltip" title="Details">
                                                        <i class="fas fa-search"></i>
                                                    </a>
                                                    <a href="{{ route('admin.employee.delete', $emp->id) }}" class="btn btn-danger btn-circle delete-confirm" data-tooltip="tooltip" title="Delete">
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
    $(function () {
        $('#empTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
        });
    });
</script>
@endsection