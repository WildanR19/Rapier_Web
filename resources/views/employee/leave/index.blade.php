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
                    <div class="con-button">
                        <div class="row text-center" style="margin: 0;">
                            <div class="col btn panel-btn p-3" id="SumCal_Panel" onclick="backToCalendar()">Summary & Calendar
                            </div>
                            <div class="col btn p-3" id="Leave_Panel" onclick="backToLeave()">Your Leave</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="con-page">
                                <div id="Page_SumCal_Panel" class="panel show_page">
                                    {!! $leave_header !!}
                                    <div class="row mt-4">
                                        <div class="col text-right">
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#applyModal">Assign
                                                Leave</button>
                                        </div>
                                        <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=2&amp;bgcolor=%23ffffff&amp;ctz=Asia%2FJakarta&amp;src=aWQuaW5kb25lc2lhbiNob2xpZGF5QGdyb3VwLnYuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;color=%237986CB&amp;showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showTz=0" style="border-width:0" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
                                    </div>
                                </div>
                                <div id="Page_Leave_Panel" class="panel">
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
                                                        <td>{{ $leaves->from_date }}</td>
                                                        <td>{{ $leaves->to_date }}</td>
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
                                                        <td>{{ date('Y-m-d', strtotime($leaves->updated_at)) }}</td>
                                                        @php
                                                            if($leaves->status == 'approved'){
                                                                $color = 'success';
                                                            }else if($leaves->status == 'pending'){
                                                                $color = 'warning';
                                                            }else{
                                                                $color = 'danger';
                                                            }
                                                        @endphp
                                                        <td><span class="badge bg-{{ $color }} text-capitalize">{{ $leaves->status }}</span></td>
                                                        <td>{{ $leaves->reject_reason }}</td>
                                                        <td>
                                                            @if ($leaves->status == 'pending')
                                                            <button class="btn btn-warning btn-circle" data-tooltip="tooltip" title="Edit">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </button>
                                                            <button class="btn btn-danger btn-circle" data-tooltip="tooltip" title="Cancel">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="col text-right">
                                            <small>*date format y-m-d</small>
                                        </div>
                                    </div>
                                    <div class="row mt-4 mx-auto">
                                        <div class="col text-right"><button class="btn btn-warning">Assign Leave</button></div>
                                        <div class="col text-left">
                                            <button class="btn btn-primary" onclick="backToCalendar()">Back To Calendar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
</div>


<!-- modal -->
@include('employee.leave.modal-apply')

@endsection

@section('js')
<!-- InputMask -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

<script type="text/javascript">
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

    $(function() {
        $('input[name="dates"]').daterangepicker({
            singleDatePicker: true
            , showDropdowns: true
            , minYear: 2019
            , maxYear: parseInt(moment().format('YYYY'), 10)
            , locale: {
                format: 'MM-DD-YYYY'
            }
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

    function applyRequest() {
        var type = $('#type').val();
        var duration = $('#duration').val();
        var fd = $("input#fromDate").val();
        var td = $("input#toDate").val();
        var reason = $("#reason").val();
        var comment = $("#comment").val();
        var tdd = new Date(td);
        var fdd = new Date(fd);
        // var lc = tdd-fdd;
        var timeDiff = 0;
        if (tdd) {
            timeDiff = (tdd - fdd) / 1000;
        }
        var lc = Math.floor(timeDiff / (86400)).toFixed(1);
        $('#leaveTable tr:last').after('<tr><th>' + type + '</th><td>' + duration + '</td><td>' + fd + '</td><td>' + td + '</td><td>' + reason + '</td><td>' + comment + '</td><td>Manager 1</td><td>' + lc + '</td><td></td><td><i style="color: purple;">Pending</i></td><td><button class="btn btn-warning btn-edit">Edit</button></td></tr>');
        $('#applyModal').modal('hide');
        backToLeave();
        $(checkDate).trigger('change');
    }

</script>
@endsection
