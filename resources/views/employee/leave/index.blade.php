@extends('layout.dash')

@section('css')
{{-- FullCalendar --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<style>
    .card {
        box-shadow: 0 3px 1px rgba(0, 0, 0, 0.125), 0 3px 3px rgba(0, 0, 0, 0.2);
        margin-bottom: 1rem;
    }
    .fc-today {
        color: #000 !important;
        background: #fffadf !important;
    } 
</style>
@endsection

@section('content')
<div id="todo">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                          <ul class="nav nav-tabs nav-fill" id="custom-tabs-three-tab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="calendar-tab" data-toggle="pill" href="#sumcalendar" role="tab" aria-controls="calendar" aria-selected="true">Summary & Calendar</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="leave-tab" data-toggle="pill" href="#leave" role="tab" aria-controls="leave" aria-selected="false">Your Leave</a>
                            </li>
                          </ul>
                        </div>
                        <div class="card-body">
                          <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="calendar-tab" id="sumcalendar">
                                {!! $leave_header !!}
                                <div class="row mt-4">
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-secondary" data-toggle="modal" data-target="#applyModal">Assign
                                            Leave</button>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="calendar"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="leave" role="tabpanel" aria-labelledby="leave-tab">
                                {!! $leave_header !!}
                                <div class="row mt-5 table-responsive">
                                    <table class="table table-sm table-striped" id="leaveTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">Type</th>
                                                <th scope="col">Duration</th>
                                                <th scope="col">From Date</th>
                                                <th scope="col">To Date</th>
                                                <th scope="col">Reason</th>
                                                <th scope="col">Leave Count</th>
                                                <th scope="col">Applied On</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Reject Reason</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($leave as $leaves)    
                                                <tr>
                                                    <td><span class="badge bg-{{ $leaves->type->color }}">{{ $leaves->type->type_name }}</span></td>
                                                    <td class="text-capitalize">{{ $leaves->duration }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($leaves->from_date)) }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($leaves->to_date)) }}</td>
                                                    <td>{{ $leaves->reason}}</td>
                                                    @php
                                                        $td = strtotime($leaves->to_date);
                                                        $fd = strtotime($leaves->from_date);
                                                        $count = floor(($td-$fd) / (60 * 60 * 24))+1;
                                                        if($leaves->duration == 'half day'){
                                                            $count = $count/2;
                                                        }
                                                    @endphp
                                                    <td>{{ $count }} day(s)</td>
                                                    @php
                                                        if($leaves->status == 'approved'){
                                                            $color = 'success';
                                                            $applied = date('d-m-Y', strtotime($leaves->updated_at));
                                                        }else if($leaves->status == 'pending'){
                                                            $color = 'warning';
                                                            $applied = '';
                                                        }else{
                                                            $color = 'danger';
                                                            $applied = '';
                                                        }
                                                        @endphp
                                                    <td>{{ $applied }}</td>
                                                    <td><span class="badge bg-{{ $color }} text-capitalize">{{ $leaves->status }}</span></td>
                                                    <td>{{ $leaves->reject_reason }}</td>
                                                    <td>
                                                        @if ($leaves->status == 'pending')
                                                        <a href="" id="editLeave" class="btn btn-warning btn-circle" data-tooltip="tooltip" title="Edit" data-toggle="modal" data-target="#editModal" data-id="{{ $leaves->id }}">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                        <a href="{{ route('dash.leave.delete', $leaves->id) }}" class="btn btn-danger btn-circle delete-confirm" data-tooltip="tooltip" title="Cancel">
                                                            <i class="fas fa-times"></i>
                                                        </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="col text-right">
                                        <small>*date format d-m-y</small>
                                    </div>
                                </div>
                                <div class="row mt-4 mx-auto">
                                    <div class="col text-right"><button class="btn btn-secondary"  data-toggle="modal" data-target="#applyModal">Assign Leave</button></div>
                                    <div class="col text-left">
                                        <button class="btn btn-primary" onclick="backToCalendar()">Back To Calendar</button>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- modal -->
@include('employee.leave.modal')

@endsection

@section('js')
{{-- FullCalendar --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script type="text/javascript">
    //datatable
    $(function () {
        $('#leaveTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "order" : [],
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
            var id          = $("#leave_id").val();
            var userid      = $("#user_id").val();
            var type        = $("#type").val();
            var duration    = $("#duration").val();
            var fromdate    = $("#fromDate").val();
            var todate      = $("#toDate").val();
            var reason      = $("#reason").val();

            $.ajax({
                url: 'leave/' + id,
                type: "POST",
                data: {
                    id: id,
                    user_id: userid,
                    type: type,
                    duration: duration,
                    fromdate: fromdate,
                    todate: todate,
                    reason: reason,
                },
                dataType: 'json',
                success: function (data) {
                    $('#leavedata').trigger("reset");
                    $('#editModal').modal('hide');
                    window.location.reload(true);
                }
            });
        });
        $('body').on('click', '#editLeave', function (event) {
            event.preventDefault();
            var id = $(this).data('id');
            console.log(id)
            $.get('leave/' + id + '/edit', function (data) {
                $('#submit').val("Save Changes");
                $('#editModal').modal('show');
                $('#leave_id').val(data.data.id);
                $('#user_id').val(data.data.user_id);
                $('#type').val(data.data.leave_type_id);
                $('#duration').val(data.data.duration);
                $('#fromDate').val(data.data.from_date);
                $('#toDate').val(data.data.to_date);
                $('#reason').val(data.data.reason);
            })
        });

    });

    // fullcalendar
    $(document).ready(function () {

        var SITEURL = "{{ url('/') }}";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'prevYear,nextYear'
            },
            editable: false,
            themeSystem: 'bootstrap4',
            events: {
                url: SITEURL + "/leave",
                color: '#59becd'
            },
            displayEventTime: false,
            eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },
            selectable: false,
            selectHelper: false,
        });

    });
</script>
@endsection
