@extends('layout.dash')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
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
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1 class="m-0 text-dark">Payslip</h1> --}}
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
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
                                                <img src="{{ asset('img/dummy-profile.svg') }}" class="img-circle elevation-2" alt="User Image" width="80px" style="background-color: #0B92AB;">
                                            </div>
                                        </div>
                                        <div class="col my-auto">
                                            <div>
                                                <h5>JessEffendy</h5>
                                                <i>HR Operations & IRGA Lead</i>
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
                                                    <tr>
                                                        <td>Monthly Salary</td>
                                                        <td>21-08-2020</td>
                                                        <td>20-09-2020</td>
                                                        <td>
                                                            <button class="btn btn-secondary" data-toggle="modal" data-target="#payslipModal">Open</button>
                                                            <button class="btn btn-secondary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Monthly Salary</td>
                                                        <td>21-09-2020</td>
                                                        <td>20-10-2020</td>
                                                        <td>
                                                            <button class="btn btn-secondary" data-toggle="modal" data-target="#payslipModal">Open</button>
                                                            <button class="btn btn-secondary">Download</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Monthly Salary</td>
                                                        <td>21-10-2020</td>
                                                        <td>20-11-2020</td>
                                                        <td>
                                                            <button class="btn btn-secondary" data-toggle="modal" data-target="#payslipModal">Open</button>
                                                            <button class="btn btn-secondary">Download</button>
                                                        </td>
                                                    </tr>
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
@include('payslip.modal')

@endsection

@section('js')
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
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
</script>
@endsection