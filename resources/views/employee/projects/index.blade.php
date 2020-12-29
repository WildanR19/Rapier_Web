@extends('layout.dash')

@section('content')
<section>
    {{-- <h2 class="mb-4">Projects</h2> --}}
    <div class="row no-gutters justify-content-between mb-4">
        <a href="" class="btn btn-secondary d-inline-flex align-items-center" data-toggle="modal" data-target="#create-new-project">
            <em>Create New Project</em>
        </a>
        <form action="">
            <div class="form-control px-3 py-2" style="height: auto;">
                <!-- <button type="submit"> -->
                <i class="fas fa-search"></i>
                <!-- </button> -->
                <input type="search" name="" id="" class="border-0" style="outline: none;" placeholder="Search Projects">
            </div>
        </form>
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
                <div>
                    <span class="text-primary">2</span> <em>Total Update(s)</em></div>
            </div>

            <div class="row no-gutters align-items-center justify-content-between">
                <div>
                    <ul class="row no-gutters list-assigned p-0">
                        <li><a href="" data-toggle="modal" data-target="#member-list"><img src="{{ asset('img/dummy-profile.svg') }}"></a></li>
                        <li><a href="" data-toggle="modal" data-target="#member-list"><img src="{{ asset('img/dummy-profile.svg') }}"></a></li>
                        <li><a href="" data-toggle="modal" data-target="#member-list"><img src="{{ asset('img/dummy-profile.svg') }}"></a></li>
                        <li><a href="" data-toggle="modal" data-target="#member-list"><img src="{{ asset('img/dummy-profile.svg') }}"></a></li>
                    </ul>
                </div>
                <div><a href="{{ route('dash.projects.detail') }}" class="btn btn-primary"><em>See Details</em></a></div>
            </div>
        </li>

        <li class="card w-100 p-4 mb-4">
            <div class="row no-gutters justify-content-between mb-3">
                <h6 class="text-pending"><em>Pending</em></h6>
                <div>
                    Due <span class="text-primary">Tuesday, 01 Dec 2020</span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-auto">
                    <img src="{{ asset('img/dummy-profile.svg') }}" class="img-project-card">
                </div>
                <div class="col">
                    <h4>Individual Development Plan Completion (company level)</h4>
                    <h6 class="text-gray">Submitted by <span class="text-primary">Manager 1</span></h6>
                </div>
            </div>
            <p class="mb-5">Gathering all functions, all individual's development plan based on 360 review and
                discussions with Head of HR and Line Manager of each</p>

            <div class="row no-gutters justify-content-between mb-2 text-bold">
                <div>
                    <span class="text-primary">34</span> <em>Assigned Member(s)</em>
                </div>
                <div>
                    <span class="text-primary">27</span> <em>Total Update(s)</em></div>
            </div>

            <div class="row no-gutters align-items-center justify-content-between">
                <div>
                    <ul class="row no-gutters list-assigned p-0">
                        <li><a href="" data-toggle="modal" data-target="#member-list"><img src="{{ asset('img/dummy-profile.svg') }}"></a></li>
                        <li><a href="" data-toggle="modal" data-target="#member-list"><img src="{{ asset('img/dummy-profile.svg') }}"></a></li>
                        <li><a href="" data-toggle="modal" data-target="#member-list"><img src="{{ asset('img/dummy-profile.svg') }}"></a></li>
                        <li><a href="" data-toggle="modal" data-target="#member-list"><img src="{{ asset('img/dummy-profile.svg') }}"></a></li>
                        <li><a href="" data-toggle="modal" data-target="#member-list"><img src="{{ asset('img/dummy-profile.svg') }}"></a></li>
                        <li class="text-gray"><a href="" data-toggle="modal" data-target="#member-list"><em>and 29 more</em></a></li>
                    </ul>
                </div>
                <div><a href="{{ route('dash.projects.detail') }}" class="btn btn-primary"><em>See Details</em></a></div>
            </div>
        </li>
    </ul>
</section>

<!-- Modal -->
@include('employee.projects.modal-create-project')
@include('employee.projects.modal-member-list')
@endsection
