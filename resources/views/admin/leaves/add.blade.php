@extends('layout.dash')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <style>
        ul{
            list-style-type: disc;        
            padding-inline-start: 40px;
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
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <h4 class="mb-3">Assign Leave</h4>
                        <form action="{{ route('admin.leaves.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="InputEmp">Choose Employee</label>
                                <select id="inputEmp" class="form-control" name="employee">
                                    <option disabled selected>Choose...</option>
                                    @foreach ($emp as $e)
                                        <option value="{{ $e->id }}">{{ $e->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="leaveType">Leave Type</label>
                                <select id="leaveType" class="form-control" name="type">
                                    <option disabled selected>Choose...</option>
                                    @foreach ($type as $t)
                                        <option value="{{ $t->id }}">{{ $t->type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="leaveType">Select Duration</label>
                                <div class="radio-list">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="duration" id="duration_full" value="full day">
                                        <label class="form-check-label" for="duration_full">Full Day</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="duration" id="duration_half" value="half day">
                                        <label class="form-check-label" for="duration_half">Half Day</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="InputDate">From Date</label>
                                    <input type="date" class="form-control" id="InputDate" name="fromdate">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="InputToDate">To Date</label>
                                    <input type="date" class="form-control" id="InputToDate" name="todate">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="status">Status</label>
                                    <select id="status" class="form-control" name="status">
                                        <option disabled selected>Choose...</option>
                                        <option value="approved">Approved</option>
                                        <option value="pending">Pending</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="InputReason">Reason</label>
                                <textarea class="form-control" id="InputReason" rows="3" name="reason"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<!-- InputMask -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
@endsection