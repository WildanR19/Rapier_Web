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
                <div class="col-12">
                    <div class="card mt-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.leaves.add') }}" type="button" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Assign Leave
                                </a>
                                <a href="" type="button" class="btn btn-success" data-toggle="modal" data-target="#exportModal">
                                    <i class="fas fa-print"></i> Export to Excel
                                </a>
                            </div>
                            <div class="table-responsive mt-3">
                                <table id="leaveTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 1%">#</th>
                                            <th>Employee</th>
                                            <th>Duration</th>
                                            <th>Reason</th>
                                            <th style="width: 10%">From Date</th>
                                            <th style="width: 10%">To Date</th>
                                            <th>Status</th>
                                            <th>Type</th>
                                            <th style="width: 13%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1; @endphp
                                        @foreach ($leave as $lv)    
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $lv->user->name }}</td>
                                                <td class="text-capitalize">{{ $lv->duration }}</td>
                                                <td>{{ $lv->reason }}</td>
                                                <td>{{ $lv->from_date }}</td>
                                                <td>{{ $lv->to_date }}</td>
                                                @php
                                                if (strcasecmp($lv->status, 'approved') == 0) {
                                                    $colorStatus = 'success';
                                                } else if (strcasecmp($lv->status, 'pending') == 0) {
                                                    $colorStatus = 'warning';
                                                } else {
                                                    $colorStatus = 'danger';
                                                }
                                                @endphp
                                                <td><label class="label-status bg-{{ $colorStatus }} text-capitalize">{{ $lv->status }}</label></td>
                                                <td><label class="label-status bg-{{ $lv->type->color }}">{{ $lv->type->type_name }}</label></td>
                                                <td>
                                                    @if (strcasecmp($lv->status, 'pending') == 0)
                                                        <a href="{{ route('admin.leaves.approve', $lv->id) }}" class="btn btn-success btn-circle" data-tooltip="tooltip" title="Approve"><i class="fas fa-check"></i></a>
                                                        <button class="btn btn-danger btn-circle" data-tooltip="tooltip" title="Reject" data-toggle="modal" data-target="#rejectModal" data-id="{{ $lv->id }}" id="rejectbtn">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    @endif
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

    //modal reject
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '#submitReject', function (event) {
            event.preventDefault()
            var id = $("#leave_id").val();
            var reason = $("#reason").val();

            $.ajax({
                url: 'leaves/reject/' + id,
                type: "POST",
                data: {
                    id: id,
                    reason: reason,
                },
                dataType: 'json',
                success: function (data) {
                    $('#formReject').trigger('reset');
                    $('#rejectModal').modal('hide');
                    window.location.reload(true);
                }
            });
        });

        $('body').on('click', '#rejectbtn', function (event) {
            event.preventDefault();
            var id = $(this).data('id');
            $('#rejectModal').modal('show');
            $('#leave_id').val(id);
        });
    });
</script>
@endsection