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
                <div class="card">
                    <div class="card-header bg-primary">
                        <h5>New Goal</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.goals.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="title">Name</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="due_date">Due Date</label>
                                    <input type="date" class="form-control" id="due_date" name="due_date">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="assigned">Assigned To</label>
                                    <select class="select2 form-control" id="assigned" name="assigned">
                                        <option value="" selected disabled></option>
                                        @foreach ($emp as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="status">Status</label>
                                    @php
                                        $status = ['completed', 'incomplete'];
                                    @endphp
                                    <select id="status" class="form-control" name="status">
                                        <option disabled selected>Select an option...</option>
                                        @foreach ($status as $stat)
                                            <option value="{{ $stat }}" class="text-capitalize">{{ $stat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Priority</label><br>
                                <div class="form-check form-check-inline text-danger">
                                    <input class="form-check-input" type="radio" name="priority" id="high" value="high" checked>
                                    <label class="form-check-label" for="high">High</label>
                                </div>
                                <div class="form-check form-check-inline text-warning">
                                    <input class="form-check-input" type="radio" name="priority" id="medium" value="medium">
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
    </script>
@endsection