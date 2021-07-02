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
            <div class="col">
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
                <div class="card w-75">
                    <h5 class="card-header bg-primary">Update Task</h5>
                    <div class="card-body">
                        <form action="{{ route('task.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $task->id }}">
                            <div class="form-group">
                                <label for="project">Project</label>
                                <select id="project" class="form-control" name="project">
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}" class="text-capitalize" {{ ($project->id == $task->project_id) ? 'selected' : '' }}>{{ $project->project_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category">Task Category
                                    @if (Auth::user()->role_id == 1)
                                        <button type="button" class="btn btn-sm btn-primary rounded-circle" data-tooltip="tooltip" title="Add new task category" data-toggle="modal" data-target="#addCategoryModal"><i class="fas fa-plus"></i></button>    
                                    @endif
                                </label>
                                <select id="category" class="form-control" name="category">
                                    @foreach ($category as $cat)
                                        <option value="{{ $cat->id }}" class="text-capitalize" {{ ($cat->id == $task->task_category_id) ? 'selected' : '' }}>{{ ucfirst($cat->category_name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" rows="3" name="description">{{ $task->description }}</textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $task->start_date }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="due_date">Due Date</label>
                                    <input type="date" class="form-control" id="due_date" name="due_date" value="{{ $task->due_date }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                @php
                                    $status = ['incomplete', 'completed'];
                                @endphp
                                <select id="status" class="form-control" name="status">
                                    @foreach ($status as $stat)
                                        <option value="{{ $stat }}" class="text-capitalize" {{ ($task->status == $stat) ? 'selected' : '' }}>{{ ucfirst($stat) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Priority</label><br>
                                <div class="form-check form-check-inline text-danger">
                                    <input class="form-check-input" type="radio" name="priority" id="high" value="high" {{ ($task->priority == 'high') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="high">High</label>
                                </div>
                                <div class="form-check form-check-inline text-warning">
                                    <input class="form-check-input" type="radio" name="priority" id="medium" value="medium" {{ ($task->priority == 'medium') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="medium">Medium</label>
                                </div>
                                <div class="form-check form-check-inline text-success">
                                    <input class="form-check-input" type="radio" name="priority" id="low" value="low" {{ ($task->priority == 'low') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="low">Low</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if (Auth::user()->role_id == 1)
    @include('admin.task.modal')
@endif
@endsection