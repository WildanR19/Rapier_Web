@extends('layout.dash')
@section('css')
    <style>
        .img-member-modal{
            width: 80px;
            height: 80px !important;
            object-fit: cover;
            object-position: center;
            border-radius: 50% !important;
        }
    </style>
@endsection
@section('content')
<section>
    {{-- <h2 class="mb-4">Projects</h2> --}}
    <div class="row no-gutters mb-4">
        <div class="col">
            <a href="{{ route('dash.projects') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> <em>Back to All Projects</em></a>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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
            <div class="legend"><span class="text-primary">{{ $updates->count() }}</span> Total Update(s)</div>
        </div>

        @foreach ($updates as $update)    
            <li class="card w-100 p-4 mb-4">
                <div class="row">
                    <div class="col">
                        <div class="row no-gutters justify-content-between">
                            <div class="col-auto">
                                <div class="row list-assigned align-items-center mb-3">
                                    <div class="col-auto">
                                        <img src="{{ (!empty($update->user->profile_photo_path)) ? url('/storage/'.$update->user->profile_photo_path) : asset('img/dummy-profile.svg') }}">
                                    </div>
                                    <div class="text-primary">{{ $update->user->name }}</div>
                                </div>
                            </div>

                            <div class="text-gray">
                                @if ($update->user_id == Auth::user()->id)
                                    <a href="{{ route('dash.projects.delete', $update->id) }}" class="text-primary delete-confirm">Delete</a>
                                @endif
                                {{ date("H.i | d M Y", strtotime($update->created_at))}}
                            </div>
                        </div>
                        <p class="mb-3">{{ $update->comment }}</p>
                        @if (!empty($update->file))    
                            <div class="row no-gutters border-left pl-4">
                                <h6><b>1</b> total attachment <a href="{{ route('dash.projects.download',$update->id) }}">Download</a></h6>
                            </div>
                        @endif
                    </div>
                </div>
            </li>
        @endforeach

        <li class="row no-gutters w-100">
            <div class="col">
                <a class="btn btn-block btn-secondary" data-toggle="modal" data-target="#submit-update"><em>Submit an Update</em></a>
            </div>
        </li>
    </ul>
</section>

@include('employee.projects.modal-submit-update')
@include('employee.projects.modal-member-list')
@endsection
