@extends('layout.dash')
@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
            <div class="col-md-6 col-12">
                <div class="card card-info">
                    <div class="card-header">Basic Salaries</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Job</th>
                                    <th>Salary</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($basics as $basic)
                                    <tr>
                                        <td>{{ $basic->job->name }}</td>
                                        <td> {{ "Rp ".number_format($basic->amount,2,',','.') }}</td>
                                        <td>
                                            <a href="{{ route('admin.payslip.basic.delete', $basic->id) }}" class="btn btn-sm btn-danger delete-confirm"><i class="fas fa-times"></i> Remove</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card card-info">
                    <div class="card-header">New Basic Salary</div>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-ban"></i> Error!</h5>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        <form action="{{ route('admin.payslip.basic.add') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="job">Job</label>
                                <select class="form-control" id="job" name="job">
                                    <option disabled selected>Select Job...</option>
                                    @foreach ($jobs as $job)
                                        <option value="{{ $job->id }}">{{ $job->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="salary">Salary</label>
                                <input type="number" class="form-control" id="salary" name="salary" placeholder="Rp xxxxx">
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
   
@endsection