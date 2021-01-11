@extends('layout.dash')
@section('css')
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
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header bg-primary">
                        <h5>Add Payslip</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.payslip.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="user">Employee</label>
                                    <select id="user" class="form-control" name="user">
                                        <option disabled selected>Choose...</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" class="text-capitalize">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="salary">Salary</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">Rp</div>
                                        </div>
                                        <select id="salary" class="form-control" name="salary">
                                            <option disabled selected>xxxx</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="from_date">From Date</label>
                                    <input type="date" class="form-control" id="from_date" name="from_date">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="to_date">To Date</label>
                                    <input type="date" class="form-control" id="to_date" name="to_date">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="allowance">Allowance</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">Rp</div>
                                        </div>
                                        <input type="number" class="form-control" id="allowance" name="allowance" placeholder="xxxxx">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="deduction">Deduction</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">Rp</div>
                                        </div>
                                        <input type="number" class="form-control" id="deduction" name="deduction" placeholder="xxxxx">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="overtime">Overtime</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">Rp</div>
                                        </div>
                                        <input type="number" class="form-control" id="overtime" name="overtime" placeholder="xxxxx">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="other">Other</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">Rp</div>
                                        </div>
                                        <input type="number" class="form-control" id="other" name="other" placeholder="xxxxx">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="payment">Payment</label>
                                    <select id="payment" class="form-control" name="payment">
                                        <option disabled selected>Choose...</option>
                                        <option value="cash">Cash</option>
                                        <option value="transfer">Transfer</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="status">Status</label>
                                    <select id="status" class="form-control" name="status">
                                        <option value="paid off">Paid Off</option>
                                        <option value="in progress" selected>In Progress</option>
                                        <option value="canceled">Canceled</option>
                                    </select>
                                </div>
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
   <script>
       $(function () {
           $('select[name=user]').change(function () {

               var url = window.location.origin + '/admin/payslip/' + $(this).val() + '/salary';

               $.get(url, function (data) {
                   var select = $('form select[name= salary]');

                   select.empty();

                   $.each(data, function (key, value) {
                       select.append('<option value=' + value.id + '>' + value.amount + '</option>');
                   });
               });
           });
       });
   </script>
@endsection