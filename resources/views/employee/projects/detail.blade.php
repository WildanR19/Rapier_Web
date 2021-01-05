@extends('layout.dash')

@section('content')
<section>
    {{-- <h2 class="mb-4">Projects</h2> --}}
    <div class="row no-gutters mb-4">
        <div class="col">
            <a href="{{ route('dash.projects') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> <em>Back to All Projects</em></a>
        </div>
        <div class="col text-right">
            @if ($projects->submitted_by == auth()->user()->id)    
                <a href="{{ route('dash.projects.edit',$projects->id) }}" class="btn btn-secondary"><i class="fas fa-edit"></i> <em>Edit</em></a>
                <a href="{{ route('dash.projects.delete',$projects->id) }}" class="btn btn-danger delete-confirm"><i class="fas fa-trash"></i> <em>Delete</em></a>
            @endif
        </div>
    </div>

    <ul class="row no-gutters p-0">
        <li class="card w-100 p-4 mb-4">
            <div class="row no-gutters justify-content-between mb-3">
                @php
                $status = ['not started','in progress','on hold','canceled','finished'];
                    if ($projects->status == $status[0]){
                        $text = 'dark';
                    }else if($projects->status == $status[1]){
                        $text = 'progress';
                    }else if($projects->status == $status[2]){
                        $text = 'pending';
                    }else if($projects->status == $status[3]){
                        $text = 'danger';
                    }else{
                        $text = 'success';
                    }
                @endphp
                <h6 class="text-{{$text}}"><em>{{ $projects->status }}</em></h6>
                <div>
                    @php
                        $date = strtotime($projects->deadline);
                        $day = date('l, d M Y', $date);
                    @endphp
                    Due <span class="text-primary">{{ $day }}</span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-auto">
                    <img src="{{ (!empty($projects->user->profile_photo_path)) ? url('/storage/'.$projects->user->profile_photo_path) : asset('img/dummy-profile.svg') }}" class="img-project-card">
                </div>
                <div class="col">
                    <h4>{{ $projects->project_name }} <span class="text-capitalize font-italic">({{ $projects->category->category_name }})</span></h4>
                    <h6 class="text-gray">Submitted by <span class="text-primary">{{ $projects->user->name }}</span></h6>
                </div>
            </div>
            <p class="mb-3">{{ $projects->project_summary }}</p>

            <div class="row no-gutters mb-3">
                <div class="col-md-12">
                    <p>Notes :</p>
                </div>
                <div class="col-md-12">
                    <p>{{ $projects->notes }}</p>
                </div>
            </div>

            <div class="row no-gutters mb-2 text-bold">
                <div>
                    <span class="text-primary">{{ $projects->members->count() }}</span> <em>Assigned Member(s)</em>
                </div>
            </div>

            <div class="row no-gutters align-items-center justify-content-between">
                <div>
                    <ul class="row no-gutters list-assigned p-0">
                        @foreach ($members as $member)
                            @if ($member->project_id == $projects->id)
                                <li><a href="" data-toggle="modal" data-target="#member-list"><img src="{{ (!empty($member->user->profile_photo_path)) ? url('/storage/'.$member->user->profile_photo_path) : asset('img/dummy-profile.svg') }}"></a></li>
                            @endif
                        @endforeach
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
