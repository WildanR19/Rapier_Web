@extends('layout.dash')
@section('css')
    <style>
        label {
            margin-bottom: 0;
        }
    </style>
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card w-100 p-4 mb-4">
                    <div class="row no-gutters justify-content-between">
                        <h6 class="text-{{ $tasks->status == 'incomplete' ? 'danger' : 'success' }}"><em>{{ ucfirst($tasks->status) }}</em></h6>
                        @if ($tasks->status == 'completed')
                            <a href="{{ route('task.incomplete', $tasks->id) }}" id="inCompletedButton" class="btn btn-outline-danger btn-sm"><i class="fa fa-times"></i> Mark as incomplete</a>
                        @else
                            <a href="{{ route('task.completed', $tasks->id) }}" id="completedButton" class="btn btn-outline-success btn-sm"><i class="fa fa-check"></i> Mark as complete</a>
                        @endif
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-auto col-12">
                            <h5>{{ $tasks->title }}</h5>
                        </div>
                        <div class="col-md-auto col-12">
                            <label class="label-status badge-secondary">{{ $tasks->category->category_name }}</label>
                            @php
                                $priority = ['low', 'medium', 'high'];
                                if ($priority[0] == $tasks->priority) {
                                    $color = 'success';
                                } elseif ($priority[1] == $tasks->priority) {
                                    $color = 'warning';
                                } else {
                                    $color = 'danger';
                                }
                            @endphp
                            <label class="label-status badge-{{$color}}">
                                <span class="text-dark">Priority > </span> {{ ucfirst($tasks->priority) }}
                            </label>
                        </div>
                        <div class="col-12">
                            <p><i class="fas fa-layer-group"></i> {{ $tasks->project_name }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3 col-6">
                            <label>Assigned To</label><br>
                            <img alt="Avatar" class="table-avatar thumb-index-sm" src="{{ (!empty($tasks->profile_photo_path)) ? url('/storage/'.$tasks->profile_photo_path) : url('/img/dummy-profile.svg') }}"> {{ $tasks->name }}
                        </div>
                        <div class="col-lg-3 col-6">
                            <label>Assigned By</label><br>
                            <img alt="Avatar" class="table-avatar thumb-index-sm" src="{{ (!empty($tasks->created_by_image)) ? url('/storage/'.$tasks->created_by_image) : url('/img/dummy-profile.svg') }}"> {{ $tasks->created_by_name }}
                        </div>
                        <div class="col-lg-3 col-6">
                            <label>Start Date</label><br>
                            <span class="text-success">{{ $tasks->start_date }}</span><br>
                        </div>
                        <div class="col-lg-3 col-6">
                            <label>Due Date</label><br>
                            <span class="text-danger">{{ $tasks->due_date }}</span><br>
                        </div>
                    </div>
                    <p style="color: #545b62">{{ $tasks->description }}</p>
                </div>
            </div>
        </div>
        <div class="row no-gutters">
            <h5>Comment</h5>
        </div>

        <div class="row">
            <div class="col-md-12">
                @foreach ($comments as $comment)    
                    <div class="card w-100 p-4 mb-4">
                        <div class="row">
                            <div class="col">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <img src="{{ (!empty($comment->user->profile_photo_path)) ? url('/storage/'.$comment->user->profile_photo_path) : asset('img/dummy-profile.svg') }}" class="img-circle img-sm">
                                    </div>
                                    <div class="col">
                                        <div class="text-primary">{{ $comment->user->name }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="text-muted">
                                    {{ date("H:i | d M Y", strtotime($comment->created_at))}}
                                </div>                        
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <p>{{ $comment->comment }}</p>
                                @if (!empty($comment->file))    
                                    <div class="row no-gutters border-left pl-4 mt-3">
                                        <h6><b>1</b> total attachment <a href="{{ route('task.comment.download',$comment->id) }}">Download</a></h6>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if ($comment->user_id == Auth::user()->id)
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <a href="{{ route('task.comment.delete', $comment->id) }}" class="btn btn-danger delete-confirm">Delete</a>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <li class="row no-gutters w-100">
            <div class="col">
                <a class="btn btn-block btn-primary" data-toggle="modal" data-target="#submit-update"><em>Submit Comment</em></a>
            </div>
        </li>

        <ul class="row no-gutters p-0">
    
        </ul>
    </div>
</section>

@include('admin.task.modal-submit-update')
@endsection
