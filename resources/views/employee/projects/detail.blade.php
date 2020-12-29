@extends('layout.dash')

@section('content')
<section>
    {{-- <h2 class="mb-4">Projects</h2> --}}
    <div class="row no-gutters justify-content-between mb-4">
        <a href="{{ route('dash.projects') }}" class="btn btn-primary"><em>Back to All Projects</em></a>
        <a href="" class="btn btn-secondary" data-toggle="modal" data-target="#edit-project"><em>Edit Project</em></a>
    </div>

    <ul class="row no-gutters p-0">
        <li class="card w-100 p-4 mb-4">
            <div class="row no-gutters justify-content-between mb-3">
                <h6 class="text-progress"><em>On Progress</em></h6>
                <div>
                    Due <span class="text-primary">Monday, 09 Nov 2020</span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-auto">
                    <img src="{{ asset('img/dummy-profile.svg') }}" class="img-project-card">
                </div>
                <div class="col">
                    <h4>Road Recruitment to Top 5 Universities</h4>
                    <h6 class="text-gray">Submitted by <span class="text-primary">Jess Effendy</span></h6>
                </div>
            </div>
            <p class="mb-5">Event completion, attachments needed for each uni</p>

            <div class="row no-gutters justify-content-between mb-2 text-bold">
                <div>
                    <span class="text-primary">4</span> <em>Assigned Member(s)</em>
                </div>
            </div>

            <div class="row no-gutters align-items-center justify-content-between">
                <div>
                    <ul class="row no-gutters list-assigned p-0">
                        <li><img src="{{ asset('img/dummy-profile.svg') }}"></li>
                        <li><img src="{{ asset('img/dummy-profile.svg') }}"></li>
                        <li><img src="{{ asset('img/dummy-profile.svg') }}"></li>
                        <li><img src="{{ asset('img/dummy-profile.svg') }}"></li>
                    </ul>
                </div>
            </div>
        </li>

        <div class="row no-gutters">
            <div class="legend"><span class="text-primary">2</span> Total Update(s)</div>
        </div>

        <li class="card w-100 p-4 mb-4">
            <div class="row">
                <div class="col">
                    <div class="row no-gutters justify-content-between">
                        <div class="col-auto">
                            <div class="row list-assigned align-items-center mb-3">
                                <div class="col-auto">
                                    <img src="{{ asset('img/dummy-profile.svg') }}">
                                </div>
                                <div class="text-primary">Team Member 2</div>
                            </div>
                        </div>
                        <div class="text-gray">13.12 | 09 Nov 2020</div>
                    </div>
                    <p class="mb-3">First draft list for universities options. Added some notes on the possible dates. Also
                        attached some proposal sample to be sent out, please check and give comments.</p>
                    <div class="row no-gutters border-left pl-4">
                        <h6><b>2</b> total attachment(s) <a href="">Download All</a></h6>
                    </div>
                </div>
            </div>
        </li>

        <li class="card w-100 p-4 mb-4">
            <div class="row">
                <div class="col">
                    <div class="row no-gutters justify-content-between">
                        <div class="col-auto">
                            <div class="row list-assigned align-items-center mb-3">
                                <div class="col-auto">
                                    <img src="{{ asset('img/dummy-profile.svg') }}">
                                </div>
                                <div class="text-primary">Jess Effendy</div>
                            </div>
                        </div>
                        <div class="text-gray">
                            <a class="text-primary button">Delete</a>13.12 | 09 Nov 2020
                        </div>
                    </div>
                    <p>Noted. Thank you <span class="text-primary">Team Member 2</span></p>
                </div>
            </div>
        </li>

        <li class="row no-gutters w-100">
            <div class="col">
                <a class="btn btn-block btn-secondary" data-toggle="modal" data-target="#submit-update"><em>Submit an Update</em></a>
            </div>
        </li>
    </ul>
</section>

@include('employee.projects.modal-edit-project')
@include('employee.projects.modal-submit-update')
@endsection
