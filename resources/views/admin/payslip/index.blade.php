@extends('layout.dash')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('admin.payslip.basic') }}" class="btn btn-outline-primary"><i class="fas fa-plus"></i> New Basic Salary</a>
                                <a href="{{ route('admin.payslip.add') }}" class="btn btn-outline-primary"><i class="fas fa-plus"></i> New Payslip</a>
                            </div>
                            <div class="col text-right">
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#autoModal"><i class="fas fa-plus"></i> Auto Generate Payslip</button>
                            </div>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table table-striped" id="projectTable">
                                <thead>
                                    <tr>
                                        <th style="width: 1%">#</th>
                                        <th>Employee</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no=1; @endphp
                                    @foreach ($pays as $pay)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td><img alt="Avatar" class="table-avatar thumb-index-sm" src="{{ (!empty($pay->user->profile_photo_path)) ? url('/storage/'.$pay->user->profile_photo_path) : url('/img/dummy-profile.svg') }}"> {{ $pay->user->name }}</td>
                                            <td>{{ $pay->for_date }}</td>
                                            <td>{{ $pay->to_date }}</td>
                                            <td class="text-capitalize">{{ $pay->payment }}</td>
                                            <td class="project-state">
                                                @php
                                                    $status = $pay->status;
                                                    if ($status == 'paid_off') {
                                                        $color = 'success';
                                                    }elseif ($status == 'in progress') {
                                                        $color = 'info';
                                                    }else{
                                                        $color = 'danger';
                                                    }
                                                @endphp
                                                <span class="badge badge-{{$color}}">{{ $pay->status }}</span>
                                            </td>
                                            <td>
                                                @if ($pay->status == 'in progress')    
                                                    <a href="{{ route('admin.payslip.edit', $pay->id) }}" class="btn btn-info btn-circle" data-tooltip="tooltip" title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                @endif
                                                <a href="{{ route('admin.payslip.delete', $pay->id) }}" class="btn btn-danger btn-circle delete-confirm" data-tooltip="tooltip" title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                                @if ($pay->status != 'cancel')
                                                    <a href="{{ route('admin.payslip.pdf', $pay->id) }}" class="btn btn-success btn-circle" data-tooltip="tooltip" title="Print To PDF">
                                                        <i class="fas fa-print"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
    
</section>
{{-- modal --}}
@include('admin.payslip.modal')
@endsection
@section('js')
    <script>
        // datatable
        $(function () {
            $('#projectTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
            });
        });
    </script>
@endsection
