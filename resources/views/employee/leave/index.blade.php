@extends('layout.dash')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
<style>
    .card {
        box-shadow: 0 3px 1px rgba(0, 0, 0, 0.125), 0 3px 3px rgba(0, 0, 0, 0.2);
        margin-bottom: 1rem;
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
                              <a class="nav-link active" id="calendar-tab" data-toggle="pill" href="#calendar" role="tab" aria-controls="calendar" aria-selected="true">Summary & Calendar</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="leave-tab" data-toggle="pill" href="#leave" role="tab" aria-controls="leave" aria-selected="false">Your Leave</a>
                            </li>
                          </ul>
                        </div>
                        <div class="card-body">
                          <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade show active" id="calendar" role="tabpanel" aria-labelledby="calendar-tab">
                                {!! $leave_header !!}
                                <div class="row mt-4">
                                    <div class="col text-right">
                                        <button class="btn btn-secondary" data-toggle="modal" data-target="#applyModal">Assign
                                            Leave</button>
                                    </div>
                                    <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=2&amp;bgcolor=%23ffffff&amp;ctz=Asia%2FJakarta&amp;src=aWQuaW5kb25lc2lhbiNob2xpZGF5QGdyb3VwLnYuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;color=%237986CB&amp;showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showTz=0" style="border-width:0" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
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

    var SumCal_Panel = document.getElementById('SumCal_Panel');
    var Leave_Panel = document.getElementById('Leave_Panel');

    var Page_SumCal_Panel = document.getElementById('Page_SumCal_Panel');
    var Page_Leave_Panel = document.getElementById('Page_Leave_Panel');

    function backToCalendar() {
        Page_SumCal_Panel.classList.add("show_page");
        Page_Leave_Panel.classList.remove("show_page");
        SumCal_Panel.classList.add("panel-btn");
        Leave_Panel.classList.remove("panel-btn");
    }

    function backToLeave() {
        Page_SumCal_Panel.classList.remove("show_page");
        Page_Leave_Panel.classList.add("show_page");
        SumCal_Panel.classList.remove("panel-btn");
        Leave_Panel.classList.add("panel-btn");
    }

    function checkDate() {
        var myTableArray = [];
        $('table#leaveTable tr').each(function() {
            var arrayOfThisRow = [];
            var tableData = $(this).find('td');
            if (tableData.length > 0) {
                tableData.each(function() {
                    arrayOfThisRow.push($(this).text());
                });
                myTableArray.push(arrayOfThisRow);
            }
        });
        for (i = 0; i < myTableArray.length; i++) {
            var res = myTableArray[i][1].replace(/-/g, "/");
            var status = myTableArray[i][8];
            var selectedDate = new Date(res);
            var now = new Date();
            if (selectedDate < now || status == 'Rejected') {
                document.getElementsByClassName('btn-edit')[i].style.visibility = 'hidden';
            }
        }
    }
    checkDate();

</script>
@endsection
