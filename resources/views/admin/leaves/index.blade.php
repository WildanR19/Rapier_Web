@extends('layout.dash')
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                          <h3>{{ $count }}</h3>
          
                          <p>Pending Leaves</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-sign-out-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card mt-2">
                        <div class="card-body">
                            <div>
                                <a href="{{ route('admin.leaves.add') }}" type="button" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Assign Leave
                                </a>
                            </div>
                            <div class="table-responsive mt-3">
                                <table id="leaveTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Employee</th>
                                            <th>From Date</th>
                                            <th>To Date</th>
                                            <th>Leave Status</th>
                                            <th>Leave Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1; @endphp
                                        @foreach ($leave as $lv)    
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $lv->user->name }}</td>
                                                <td>{{ $lv->from_date }}</td>
                                                <td>{{ $lv->to_date }}</td>
                                                @php
                                                if ($lv->status == 'approved') {
                                                    $colorStatus = 'success';
                                                } else if ($lv->status == 'pending') {
                                                    $colorStatus = 'warning';
                                                } else {
                                                    $colorStatus = 'danger';
                                                }
                                                @endphp
                                                <td><label class="label-status bg-{{ $colorStatus }} text-capitalize">{{ $lv->status }}</label></td>
                                                <td><label class="label-status bg-{{ $lv->type->color }}">{{ $lv->type->type_name }}</label></td>
                                                <td>
                                                    @if ($lv->status == 'pending')
                                                        <form action="{{ route('admin.leaves.approve', $lv->id) }}" method="post" class="float-left mr-1">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success btn-circle" data-tooltip="tooltip" title="Approve">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        </form>
                                                        <button class="btn btn-danger btn-circle" data-tooltip="tooltip" title="Reject" data-toggle="modal" data-target="#rejectModal">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    @endif
                                                    <a href="#" class="btn btn-info btn-circle" data-tooltip="tooltip" title="Details">
                                                        <i class="fas fa-search"></i>
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
    @include('admin.leaves.modal')
@endsection

@section('js')
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script>
    //datatable
    $(function () {
        $('#leaveTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
        });
    });
</script>
@endsection