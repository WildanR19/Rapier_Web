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

        .range-value {
            position: absolute;
            top: -10%;
        }

        .range-value span {
            width: 30px;
            height: 24px;
            line-height: 24px;
            text-align: center;
            background: #0075ff;
            color: #fff;
            font-size: 12px;
            display: block;
            position: absolute;
            left: 50%;
            transform: translate(-50%, 0);
            border-radius: 6px;
        }

        .range-value span:before {
            content: "";
            position: absolute;
            width: 0;
            height: 0;
            border-top: 10px solid#0075ff;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            margin-top: -1px;
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
                        <h5>Edit Goal</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.goals.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $goals->id }}">
                            <div class="form-group">
                                <label for="title">Name</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $goals->title }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" rows="3" name="description">{{ $goals->description }}</textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="due_date">Due Date</label>
                                    <input type="date" class="form-control" id="due_date" name="due_date" value="{{ $goals->due_date }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="assigned">Assigned To</label>
                                    <select class="select2 form-control" id="assigned" name="assigned">
                                        <option value="" selected disabled></option>
                                        @foreach ($emp as $user)
                                            <option value="{{ $user->id }}" {{ ($user->id == $goals->user_id) ? 'selected' : ''}}>{{ $user->name }}</option>
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
                                            <option value="{{ $stat }}" class="text-capitalize" {{ ($goals->status == $stat) ? 'selected' : '' }}>{{ $stat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">Priority</label><br>
                                    <div class="form-check form-check-inline text-danger">
                                        <input class="form-check-input" type="radio" name="priority" id="high" value="high" {{ ($goals->priority == 'high') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="high">High</label>
                                    </div>
                                    <div class="form-check form-check-inline text-warning">
                                        <input class="form-check-input" type="radio" name="priority" id="medium" value="medium" {{ ($goals->priority == 'medium') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="medium">Medium</label>
                                    </div>
                                    <div class="form-check form-check-inline text-success">
                                        <input class="form-check-input" type="radio" name="priority" id="low" value="low" {{ ($goals->priority == 'low') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="low">Low</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="progress">Progress Percent (%)</label>
                                    <div>
                                        <input type="range" class="form-control-range" id="progress" name="progress" value="{{ $goals->progress_percent }}" min="0" max="100" step="5">
                                        <div class="range-value" id="rangeV"></div>
                                    </div>
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

        const
            range = document.getElementById('progress'),
            rangeV = document.getElementById('rangeV'),
            setValue = () => {
                const
                    newValue = Number((range.value - range.min) * 100 / (range.max - range.min)),
                    newPosition = 10 - (newValue * 0.2);
                rangeV.innerHTML = `<span>${range.value}</span>`;
                rangeV.style.left = `calc(${newValue}% + (${newPosition}px))`;
            };
        document.addEventListener("DOMContentLoaded", setValue);
        range.addEventListener('input', setValue);
    </script>
@endsection