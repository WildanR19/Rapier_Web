@extends('layout.dash')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    {!! $smallbox !!}
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
                                            <th>Duration</th>
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
                                                <td class="text-capitalize">{{ $lv->duration }}</td>
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
                                                    {{-- <a href="#" class="btn btn-info btn-circle" data-tooltip="tooltip" title="Details" id="leaveDetails" data-id="{{ $lv->id }}">
                                                        <i class="fas fa-search"></i>
                                                    </a> --}}
                                                    <a href="{{ route('admin.leaves.delete', $lv->id) }}" class="btn btn-outline-danger btn-circle delete-confirm" data-tooltip="tooltip" title="Delete">
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
    @include('admin.leaves.modal')
@endsection

@section('js')
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

    //details modal
    $(document).ready(function () {
        $('body').on('click', '#leaveDetails', function (event) {
            event.preventDefault();
            var id = $(this).data('id');
            $.get('leaves/' + id + '/details', function (data) {
                $('#detailsModal').modal('show');
                $('#name').text(data.user.name);
                $('#type').text(data.type.type_name);
                $('#fromdate').text(data.data.from_date);
                $('#todate').text(data.data.to_date);
                $('#reasonDetail').text(data.data.reason);
                $('#status').text(data.data.status);
            })
        });
    });
</script>
@endsection