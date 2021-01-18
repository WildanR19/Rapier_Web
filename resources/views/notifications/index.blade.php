@extends('layout.dash')
@section('css')
<style>
    thead{
        background: #efefef;
    }
    th{
        color: #0B92AB;
    }
    .card{
        border-radius: 1rem;
        margin-bottom: 0;
    }
    .tb-projects th{
        color: #000;
    }
    .tb-projects td{
        color: #0B92AB;
        padding-left: 1rem;
    }
    td.stretch {
        width: 65%;
    }
</style>
@endsection
@section('content')
<section>
    <h2 class="mb-4">Notifications</h2>

    {{-- <div class="d-grid gap-2 d-md-block row no-gutters mb-4">
        <button class="btn btn-white" type="button">All</button>
        <button class="btn btn-white" type="button">Projects</button>
        <button class="btn btn-white" type="button">Goals</button>
        <button class="btn btn-white" type="button">Leave</button>
      </div> --}}

    <ul class="row no-gutters p-0">
        @foreach ($leaves as $leave)
            @foreach (auth()->user()->notifications as $notification)
                @if ($leave->id == $notification->data['leave_id'])    
                    <li class="card w-100 mb-4 bg-primary">
                        <div class="row no-gutters">
                            <div class="col-md-11">
                                <div class="card p-4 bg-white">
                                    <div class="row no-gutters justify-content-between mb-3">
                                        <h6 class="text-notif"><em>Leave</em></h6>
                                        <div>
                                            <span class="text-notif">{{ date('H:i | j M Y', strtotime($leave->created_at)) }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-auto">
                                            <img src="{{ (!empty($leave->user->profile_photo_path)) ? asset('storage/'.$leave->user->profile_photo_path) : asset('img/dummy-profile.svg') }}" class="img-project-card">
                                        </div>
                                        <div class="col my-auto">
                                            <h4>Leave Request By <span class="text-primary">{{ $leave->user->name }}</span></h4>
                                        </div>
                                    </div>
                                    <div class="row table-responsive">
                                        <table class="table text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Type</th>
                                                    <th>Duration</th>
                                                    <th>From Date</th>
                                                    <th>To Date</th>
                                                    <th>Reason</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $leave->type->type_name }}</td>
                                                    <td class="text-capitalize">{{ $leave->duration }}</td>
                                                    <td>{{ $leave->from_date }}</td>
                                                    <td>{{ $leave->to_date }}</td>
                                                    <td>{{ $leave->reason }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 text-center my-auto">                    
                                <div class="d-flex flex-column bd-highlight mb-3">
                                    <div class="p-2 bd-highlight">
                                        <p>Approve ?</p>
                                    </div>
                                    <div class="p-2 bd-highlight">
                                        <a href="{{ route('admin.leaves.approve', $leave->id) }}" class="btn btn-secondary btn-block">Yes</a>
                                    </div>
                                    <div class="p-2 bd-highlight">
                                        {{-- <button class="btn btn-secondary btn-block" type="button">No</button> --}}
                                        <button class="btn btn-secondary btn-block" data-toggle="modal" data-target="#rejectModal" data-id="{{ $leave->id }}" id="rejectbtn">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endif
            @endforeach
        @endforeach

        {{-- <li class="card w-100 mb-4 bg-primary">
            <div class="row no-gutters">
                <div class="col-md-11">
                    <div class="card p-4 bg-white">
                        <div class="row no-gutters justify-content-between mb-3">
                            <h6 class="text-notif"><em>Projects</em></h6>
                            <div>
                                <span class="text-notif">13:15 | 05 Oct 2020</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col my-auto">
                                <h4>New Project Request Titled <span class="text-primary">Individual Development Plan Completion (company level)</span></h4>
                                <p>Gathering all function, all individual development plan based on 360 review and discussion with Head of HR and Line Manager of each.</p>
                            </div>
                        </div>
                        <div class="row ml-3">
                            <table class="tb-projects">
                                <tbody>
                                    <tr>
                                        <th>Submitted by</th>
                                        <td>Kunthara Waluyo</td>
                                    </tr>
                                    <tr>
                                        <th>Project Due Date</th>
                                        <td>Tuesday, 01 Dec 2020</td>
                                    </tr>
                                    <tr>
                                        <th>Assigned Member(s)</th>
                                        <td>34 <span class="text-dark">Member(s)</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 text-center my-auto">                    
                    <div class="d-flex flex-column bd-highlight mb-3">
                        <div class="p-2 bd-highlight">
                            <p>Approve ?</p>
                        </div>
                        <div class="p-2 bd-highlight">
                            <button class="btn btn-secondary btn-block" type="button">Yes</button>
                        </div>
                        <div class="p-2 bd-highlight">
                            <button class="btn btn-secondary btn-block" type="button">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        
        <li class="card w-100 mb-4 bg-primary">
            <div class="row no-gutters">
                <div class="col-md-11">
                    <div class="card p-4 bg-white">
                        <div class="row no-gutters justify-content-between mb-3">
                            <h6 class="text-notif"><em>Goals</em></h6>
                            <div>
                                <span class="text-notif">13:15 | 05 Oct 2020</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-auto">
                                <img src="{{ asset('img/dummy-profile.svg') }}" class="img-project-card">
                            </div>
                            <div class="col my-auto">
                                <h4><span class="text-primary">Rina Elma </span>reported progression <span class="text-primary">Review and Renew Company Regulation</span></h4>
                            </div>
                        </div>
                        <div class="row ml-3 table-responsive-sm">
                            <table class="table table-sm table-borderless">
                                <tbody>
                                    <tr>
                                        <td class="text-notif">Former Status</td>
                                        <td class="stretch">
                                            <div class="progress rounded-pill" style="height: 20px;">
                                                <div class="progress-bar" role="progressbar" style="width: 25%; background-color: #7f7f7f; color: #fff;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="prog1">25%</div>
                                            </div>
                                        </td>
                                        <td class="text-notif">1/4</td>
                                    </tr>
                                    <tr>
                                        <td>Current Status</td>
                                        <td class="stretch">
                                            <div class="progress rounded-pill" style="height: 20px;">
                                                <div class="progress-bar" role="progressbar" style="width: 50%; background-color: #59BECD; color: #FFC045;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" id="prog1">50%</div>
                                            </div>
                                        </td>
                                        <td>1/4</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 text-center my-auto">                    
                    <div class="d-flex flex-column bd-highlight mb-3">
                        <div class="p-2 bd-highlight">
                            <p>Approve ?</p>
                        </div>
                        <div class="p-2 bd-highlight">
                            <button class="btn btn-secondary btn-block" type="button">Yes</button>
                        </div>
                        <div class="p-2 bd-highlight">
                            <button class="btn btn-secondary btn-block" type="button">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </li> --}}
    </ul>
</section>

<!-- Modal -->
@include('notifications.modal')
@endsection
@section('js')
    <script>
         //modal reject
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('click', '#submitReject', function (event) {
                event.preventDefault()
                var id = $("#leave_id").val();
                var reason = $("#reason").val();

                $.ajax({
                    url: 'leaves/reject/' + id,
                    type: "POST",
                    data: {
                        id: id,
                        reason: reason,
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('#formReject').trigger('reset');
                        $('#rejectModal').modal('hide');
                        window.location.reload(true);
                    }
                });
            });

            $('body').on('click', '#rejectbtn', function (event) {
                event.preventDefault();
                var id = $(this).data('id');
                $('#rejectModal').modal('show');
                $('#leave_id').val(id);
            });
        });
    </script>
@endsection