@extends('layout.dash')

@section('css')
<style>
    .card {
        box-shadow: 0 3px 1px rgba(0, 0, 0, 0.125), 0 3px 3px rgba(0, 0, 0, 0.2);
        margin-bottom: 1rem;
    }

    #containerd h4 {
        text-transform: none;
        font-size: 14px;
        font-weight: normal;
    }

    #containerd p {
        font-size: 13px;
        line-height: 16px;
    }

    @media screen and (max-width: 600px) {
        #containerd h4 {
            font-size: 2.3vw;
            line-height: 3vw;
        }

        #containerd p {
            font-size: 2.3vw;
            line-height: 3vw;
        }
    }
    .img-contact{
        width: 110px;
        height: 110px;
        object-fit: cover;
        object-position: center;
        border-radius: 50% !important;
    }
</style>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                  <ul class="nav nav-tabs nav-fill" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="contacts-tab" data-toggle="pill" href="#contacts" role="tab" aria-controls="contacts" aria-selected="true">Contacts</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="myprofile-tab" data-toggle="pill" href="#myprofile" role="tab" aria-controls="myprofile" aria-selected="false">My Profile</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="contacts-tab" id="contacts">
                        <div class="row d-flex align-items-stretch">
                            @foreach ($users as $user)    
                                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                                    <div class="card bg-light">
                                        <div class="card-header text-muted border-bottom-0">
                                            @if (!empty($user->employee_detail->job->name))
                                                {{ $user->employee_detail->job->name }}
                                            @endif
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="lead"><b>{{ $user->name }}</b></h2>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                        <li class="small">
                                                            <span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: {{ !empty($user->employee_detail) ? $user->employee_detail->address : '' }}
                                                        </li>
                                                        <li class="small">
                                                            <span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone: {{ !empty($user->employee_detail) ? $user->employee_detail->phone : '' }}
                                                        </li>
                                                        <li class="small">
                                                            <span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email: {{ $user->email }}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-5 text-center">
                                                    <img src="{{ (!empty($user->profile_photo_path)) ? asset('storage/'.$user->profile_photo_path) : asset('img/dummy-profile.svg') }}" alt="" class="img-contact">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" role="tabpanel" aria-labelledby="myprofile-tab" id="myprofile">
                        <div class="row">
                            <div class="col text-center my-auto border-right">
                                <div class="image">
                                    <img src="{{ Auth::user()->profile_photo_url }}" alt="User Image" width="200px" id="imgTeam" class="rounded-circle elevation-2">
                                </div>
                                <div class="head mt-2">
                                    <h2>{{ Auth::user()->name }}</h2>
                                    <h5 style="color: #59BECD;"><i>{{ Auth::user()->employee_detail->job->name }}</i></h5>
                                </div>
                                <div class="foot mt-4">
                                    @php
                                        $date = strtotime(Auth::user()->employee_detail->join_date);
                                        $datee = date("F Y", $date);
                                    @endphp
                                    <p>Joined since {{$datee}}</p>
                                </div>
                            </div>
                            <div class="col my-auto">
                                <div class="px-5">
                                    <div>
                                        <h5><i>Contact Info</i></h5>
                                        <p><span><i class="fas fa-lg fa-phone"></i></span> {{ Auth::user()->employee_detail->phone }}</p>
                                        <p><span><i class="fas fa-lg fa-envelope"></i></span> {{ Auth::user()->email }}</p>
                                    </div>
                                    <div class="mt-5">
                                        <h5><i>Address</i></h5>
                                        <p><span><i class="fas fa-lg fa-map-marker-alt"></i></span> {{ Auth::user()->employee_detail->address }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col text-center">
                                <button id="editContact" class="btn btn-primary" data-toggle="modal" data-target="#editContactModal" data-id="{{ Auth::user()->id }}">Edit Contact Info</button>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>

@include('employee.contacts.modal')

@endsection

@section('js')
<script>
//modal update
$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '#submit', function (event) {
        event.preventDefault()
        var id = $("#user_id").val();
        var phone = $("#inputPhone").val();
        var email = $("#inputEmail").val();

        $.ajax({
            url: 'contacts/' + id,
            type: "POST",
            data: {
                id: id,
                email: email,
                phone: phone,
            },
            dataType: 'json',
            success: function (data) {
                $('#contactdata').trigger("reset");
                $('#editContactModal').modal('hide');
                window.location.reload(true);
            }
        });
    });
    $('body').on('click', '#editContact', function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        $.get('contacts/' + id + '/edit', function (data) {
            $('#submit').val("Save Changes");
            $('#editContactModal').modal('show');
            $('#user_id').val(data.data.id);
            $('#inputPhone').val(data.ed.phone);
            $('#inputEmail').val(data.data.email);
        })
    });

});
</script>

@endsection
