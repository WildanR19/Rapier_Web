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
                        <h5>Add Project</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dash.projects.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="project_name">Project Name</label>
                                    <input type="text" class="form-control" id="project_name" name="project_name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="category">Project Category
                                        <button type="button" class="btn btn-sm btn-primary rounded-circle" data-tooltip="tooltip" title="Add new project category" data-toggle="modal" data-target="#addCategoryModal"><i class="fas fa-plus"></i></button>
                                    </label>
                                    <select id="category" class="form-control" name="category">
                                        <option disabled selected>Choose...</option>
                                        @foreach ($category as $cat)
                                            <option value="{{ $cat->id }}" class="text-capitalize">{{ $cat->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="deadline">Deadline</label>
                                    <input type="date" class="form-control" id="deadline" name="deadline">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="member">Project Member</label>
                                    <select class="select2 form-control" multiple="multiple" data-placeholder="Select Member" id="member" name="member[]">
                                        @foreach ($emp as $member)
                                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="status">Status</label>
                                    @php
                                        $status = ['not started', 'in progress', 'on hold', 'canceled', 'finished'];
                                    @endphp
                                    <select id="status" class="form-control" name="status">
                                        <option disabled selected>Choose...</option>
                                        @foreach ($status as $stat)
                                            <option value="{{ $stat }}" class="text-capitalize">{{ $stat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="summary">Project Summary</label>
                                <textarea class="form-control" id="summary" rows="3" name="summary"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="note">Notes</label>
                                <textarea class="form-control" id="note" rows="3" name="note"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.project.modal')
@endsection

@section('js')
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(".select2").select2({
            allowClear: false,
            minimumResultsForSearch: 5,
            theme: 'bootstrap4'
        });
    </script>
@endsection