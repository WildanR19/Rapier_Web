@extends('layout.dash')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
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
                                    <div class="row mt-4">
                                        <div class="col-auto">
                                            <div class="image">
                                                <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle elevation-2" alt="User Image" width="80px">
                                            </div>
                                        </div>
                                        <div class="col my-auto">
                                            <div>
                                                <h5>{{ Auth::user()->name }}</h5>
                                                <i>{{ Auth::user()->role }}</i>
                                            </div>
                                        </div>
                                        <div class="col-auto mr-4">
                                            <strong><i>Period</i></strong><br>
                                            <strong><i>Total Leave This Period</i></strong><br>
                                            <strong><i>Total Leave Remaining</i></strong><br>
                                        </div>
                                        <div class="col-auto">
                                            2020 <br> 3.0 day(s) <br> 10.0 day(s)
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col text-right">
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#applyModal">Apply
                                                Leave</button>
                                        </div>
                                        <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=2&amp;bgcolor=%23ffffff&amp;ctz=Asia%2FJakarta&amp;src=aWQuaW5kb25lc2lhbiNob2xpZGF5QGdyb3VwLnYuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;color=%237986CB&amp;showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showTz=0" style="border-width:0" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
                                    </div>
                                </div>
                                <div id="Page_Leave_Panel" class="panel">
                                    <div class="row mt-4">
                                        <div class="col-auto">
                                            <div class="image">
                                                <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle elevation-2" alt="User Image" width="80px" style="background-color: #0B92AB;">
                                            </div>
                                        </div>
                                        <div class="col my-auto">
                                            <div>
                                                <h5>{{ Auth::user()->name }}</h5>
                                                <i>{{ Auth::user()->role }}</i>
                                            </div>
                                        </div>
                                        <div class="col-auto mr-4">
                                            <strong><i>Period</i></strong><br>
                                            <strong><i>Total Leave This Period</i></strong><br>
                                            <strong><i>Total Leave Remaining</i></strong><br>
                                        </div>
                                        <div class="col-auto">
                                            2020 <br> 3.0 day(s) <br> 10.0 day(s)
                                        </div>
                                    </div>
                                    <div class="row mt-5 table-responsive">
                                        <table class="table table-sm" id="leaveTable">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Duration</th>
                                                    <th scope="col">From Date</th>
                                                    <th scope="col">To Date</th>
                                                    <th scope="col">Reason</th>
                                                    <th scope="col">Comment</th>
                                                    <th scope="col">Reporting Manager</th>
                                                    <th scope="col">Leave Count</th>
                                                    <th scope="col">Applied On</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>Annual Leave</th>
                                                    <td>Full Day</td>
                                                    <td>10-01-2020</td>
                                                    <td>10-03-2020</td>
                                                    <td>Vacation</td>
                                                    <td></td>
                                                    <td>Manager 1</td>
                                                    <td>3.0</td>
                                                    <td>20-09-2020</td>
                                                    <td><i style="color: green;">Approved</i></td>
                                                    <td><button class="btn btn-warning btn-edit">Edit</button></td>
                                                </tr>
                                                <tr>
                                                    <th>Annual Leave</th>
                                                    <td>Full Day</td>
                                                    <td>10-10-2020</td>
                                                    <td>10-11-2020</td>
                                                    <td>Vacation</td>
                                                    <td></td>
                                                    <td>Manager 1</td>
                                                    <td>2.0</td>
                                                    <td>02-10-2020</td>
                                                    <td><i style="color:orange">Cancelled</i></td>
                                                    <td><button class="btn btn-warning btn-edit">Edit</button></td>
                                                </tr>
                                                <tr>
                                                    <th>Annual Leave</th>
                                                    <td>Full Day</td>
                                                    <td>11-11-2020</td>
                                                    <td>11-16-2020</td>
                                                    <td>Vacation</td>
                                                    <td></td>
                                                    <td>Manager 1</td>
                                                    <td>6.0</td>
                                                    <td>05-10-2020</td>
                                                    <td><i style="color: red;">Rejected</i></td>
                                                    <td><button class="btn btn-warning btn-edit">Edit</button></td>
                                                </tr>
                                                <tr>
                                                    <th>Annual Leave</th>
                                                    <td>Full Day</td>
                                                    <td>12-08-2020</td>
                                                    <td>12-12-2020</td>
                                                    <td>Vacation</td>
                                                    <td></td>
                                                    <td>Manager 1</td>
                                                    <td>4.0</td>
                                                    <td>05-10-2020</td>
                                                    <td><i style="color:green;">Approved</i></td>
                                                    <td><button class="btn btn-warning btn-edit">Edit</button></td>
                                                </tr>
                                                <tr>
                                                    <th>Annual Leave</th>
                                                    <td>Full Day</td>
                                                    <td>02-05-2021</td>
                                                    <td>02-10-2021</td>
                                                    <td>Vacation</td>
                                                    <td></td>
                                                    <td>Manager 1</td>
                                                    <td>6.0</td>
                                                    <td>05-10-2020</td>
                                                    <td><i style="color: purple;">Pending</i></td>
                                                    <td><button class="btn btn-warning btn-edit">Edit</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="col text-right">
                                            <small>*date format mm/dd/yyyy</small>
                                        </div>
                                    </div>
                                    <div class="row mt-4 mx-auto">
                                        <div class="col text-right"><button class="btn btn-warning">Apply Leave</button></div>
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
@include('leave.modal-apply')

@endsection

@section('js')
<!-- InputMask -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

<script type="text/javascript">
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
