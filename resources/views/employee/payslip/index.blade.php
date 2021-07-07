@extends('layout.dash')

@section('css')
<style>
    /* thead{
        background: #efefef;
    }
    tfoot{
        background: #efefef;
    }
    th{
        color: #59becd;
    } */
</style>
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="con-page">
                            {{-- <div class="row mt-4">
                                <div class="col-auto" style="float: left">
                                    <div class="image">
                                        <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle elevation-2" alt="User Image" width="80px" style="background-color: #0B92AB;">
                                    </div>
                                </div>
                                <div class="col my-auto" style="float: right">
                                    <div>
                                        <h5>{{ Auth::user()->name }}</h5>
                                        <i>{{ Auth::user()->employee_detail->job->name }}</i>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col table-responsive">
                                    <table id="payslipTable" class="table nowrap table-hover">
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
                                                        <button class="btn btn-primary" data-toggle="modal" data-target="#payslipModal" data-url="{{ url('payslip',['id'=>$pay->id])}}" id="openmodal">Open</button>
                                                        <a href="{{ route('dash.payslip.pdf', $pay->id) }}" class="btn btn-primary">Download</a>
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
            <!-- /.col-md-6 -->
        </div>
    </div>
</section>
<!-- modal -->
<div class="modal fade" id="payslipModal" tabindex="-1" aria-labelledby="payslipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content payslip-modal">
            
        </div>
    </div>
</div>

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

    $(document).on('click', '#openmodal', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        $('.payslip-modal').html('');
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data){
            console.log(data);  
            $('.payslip-modal').html('');    
            $('.payslip-modal').html(data);
        })
    });

</script>
@endsection