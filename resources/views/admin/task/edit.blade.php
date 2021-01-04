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
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header bg-primary">
                        <h5>Edit Task</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.tasks.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $tasks->id }}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="project">Project</label>
                                    <select id="project" class="form-control select2" name="project">
                                        <option value="" selected disabled></option>
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}" class="text-capitalize" {{ ($tasks->project_id == $project->id) ? 'selected' : '' }}>{{ $project->project_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="category">Task Category
                                        <button type="button" class="btn btn-sm btn-primary rounded-circle" data-tooltip="tooltip" title="Add new task category" data-toggle="modal" data-target="#addCategoryModal"><i class="fas fa-plus"></i></button>
                                    </label>
                                    <select id="category" class="form-control select2" name="category">
                                        <option value="" selected disabled></option>
                                        @foreach ($category as $cat)
                                            <option value="{{ $cat->id }}" class="text-capitalize" {{ ($tasks->task_category_id == $cat->id) ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $tasks->title }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" rows="3" name="description">{{ $tasks->description }}</textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $tasks->start_date }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="due_date">Due Date</label>
                                    <input type="date" class="form-control" id="due_date" name="due_date" value="{{ $tasks->due_date }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="assigned">Assigned To</label>
                                    <select class="select2 form-control" id="assigned" name="assigned">
                                        <option value="" selected disabled></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="status">Status</label>
                                    @php
                                        $status = ['completed', 'incomplete'];
                                    @endphp
                                    <select id="status" class="form-control" name="status">
                                        <option disabled selected>Select an option...</option>
                                        @foreach ($status as $stat)
                                            <option value="{{ $stat }}" class="text-capitalize" {{ ($tasks->status == $stat) ? 'selected' : '' }}>{{ $stat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Priority</label><br>
                                <div class="form-check form-check-inline text-danger">
                                    <input class="form-check-input" type="radio" name="priority" id="high" value="high" {{ ($tasks->priority == 'high') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="high">High</label>
                                </div>
                                <div class="form-check form-check-inline text-warning">
                                    <input class="form-check-input" type="radio" name="priority" id="medium" value="medium" {{ ($tasks->priority == 'medium') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="medium">Medium</label>
                                </div>
                                <div class="form-check form-check-inline text-success">
                                    <input class="form-check-input" type="radio" name="priority" id="low" value="low" {{ ($tasks->priority == 'low') ? 'checked' : '' }}>
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
@include('admin.task.modal')
@endsection

@section('js')
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4',
                placeholder: 'Select an option...',
                allowClear: true
            });
        });

        $('#project').on('change', function (e) {
            var project_id = e.target.value;

            $.get('/admin/tasks/add/ajax-getuser?project_id=' + project_id, function (data) {

                $('#assigned').empty();

                $.each(data, function (index, value) {
                    $('#assigned').append('<option value="' + value.user_id + '">' + value.name + '</option>');
                });
            });
        });
    </script>
@endsection