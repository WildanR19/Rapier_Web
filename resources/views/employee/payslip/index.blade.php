@extends('layout.dash')

@section('css')
<style>
    thead{
        background: #efefef;
    }
    tfoot{
        background: #efefef;
    }
    th{
        color: #59becd;
    }
</style>
@endsection

@section('content')
<div id="payslip">
    <div class="content" id="showContent">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="con-page">
                                <div id="Page_Leave_Panel"  >
                                    <div class="row mt-4">
                                        <div class="col-auto">
                                            <div class="image">
                                                <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle elevation-2" alt="User Image" width="80px" style="background-color: #0B92AB;">
                                            </div>
                                        </div>
                                        <div class="col my-auto">
                                            <div>
                                                <h5>{{ Auth::user()->name }}</h5>
                                                <i>{{ Auth::user()->employee_detail->job->name }}</i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col table-responsive">
                                            <table id="payslipTable" class="table nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Payslip Group</th>
                                                        <th>Period Begins</th>
                                                        <th>Period Ends</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pays as $pay)
                                                        <tr>
                                                            <td>Monthly Salary</td>
                                                            <td>{{ $pay->for_date }}</td>
                                                            <td>{{ $pay->to_date }}</td>
                                                            <td>
                                                                <button class="btn btn-secondary" data-toggle="modal" data-target="#payslipModal" data-id="{{ $pay->id }}" id="openmodal">Open</button>
                                                                <button class="btn btn-secondary">Download</button>
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
                <!-- /.col-md-6 -->
            </div>
        </div>
    </div>
</div>

<!-- modal -->
@include('employee.payslip.modal')

@endsection

@section('js')
<script>
    $(function () {
        $('#payslipTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": true,
        });
    });

    $('body').on('click', '#openmodal', function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        $.get('payslip/' + id, function (data) {
            $('#payslipModal').modal('show');
            $('#daterange').html(data.data.for_date + '-' + data.data.to_date);
            $('#basicSalary').val(data.data.basic);
        })
        $.get('payslip/' + id, function (basic) {
            $('#basicSalary').val(data.basic.amount);
        })
    });
</script>
@endsection