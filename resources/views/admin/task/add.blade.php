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
                    <h5 class="card-header bg-primary">New Task</h5>
                    <div class="card-body">
                        <form action="{{ route('task.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="project">Project</label>
                                <select id="project" class="form-control select2-single" name="project">
                                    <option></option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}" class="text-capitalize" {{ $project->id == old('project') ? 'selected' : '' }}>{{ $project->project_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category">Task Category
                                    @if (Auth::user()->role_id == 1)
                                        <button type="button" class="btn btn-sm btn-primary rounded-circle" data-tooltip="tooltip" title="Add new task category" data-toggle="modal" data-target="#addCategoryModal"><i class="fas fa-plus"></i></button>    
                                    @endif
                                </label>
                                <select id="category" class="form-control select2-single" name="category">
                                    <option></option>
                                    @foreach ($category as $cat)
                                        <option value="{{ $cat->id }}" class="text-capitalize" {{ $cat->id == old('category') ? 'selected' : '' }}>{{ ucfirst($cat->category_name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" rows="3" name="description">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="due_date">Due Date</label>
                                    <input type="date" class="form-control" id="due_date" name="due_date" value="{{ old('due_date') }}">
                                </div>
                            </div>
                            @if (Auth::user()->role_id == 1)    
                                <div class="form-group">
                                    <label for="assigned">Assigned To</label>
                                    <select class="select2-single form-control" id="assigned" name="assigned">
                                        <option></option>
                                    </select>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="">Priority</label><br>
                                <div class="form-check form-check-inline text-danger">
                                    <input class="form-check-input" type="radio" name="priority" id="high" value="high">
                                    <label class="form-check-label" for="high">High</label>
                                </div>
                                <div class="form-check form-check-inline text-warning">
                                    <input class="form-check-input" type="radio" name="priority" id="medium" value="medium" checked>
                                    <label class="form-check-label" for="medium">Medium</label>
                                </div>
                                <div class="form-check form-check-inline text-success">
                                    <input class="form-check-input" type="radio" name="priority" id="low" value="low">
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

@section('js')
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(".select2-single").select2({
            allowClear: true,
            placeholder: "Choose...",
            theme: 'bootstrap4'
        });

        $(function () {
           $('select[name=project]').change(function () {
            var APP_URL = {!! json_encode(url('/')) !!}
               var url = APP_URL + '/task/' + $(this).val() + '/emp';

               $.get(url, function (data) {
                   var select = $('form select[name=assigned]');

                   select.empty();

                   $.each(data, function (key, value) {
                       select.append('<option value=' + value.user_id + '>' + value.name + '</option>');
                   });
               });
           });
       });
    </script>
@endsection