@extends('layout.dash')

@section('css')
<style>
    .card {
        box-shadow: 0 3px 1px rgba(0, 0, 0, 0.125), 0 3px 3px rgba(0, 0, 0, 0.2);
        margin-bottom: 1rem;
    }

    #containerd h4 {
        text-transform: none;
        font-size: 14px;
        font-weight: normal;
    }

    #containerd p {
        font-size: 13px;
        line-height: 16px;
    }

    @media screen and (max-width: 600px) {
        #containerd h4 {
            font-size: 2.3vw;
            line-height: 3vw;
        }

        #containerd p {
            font-size: 2.3vw;
            line-height: 3vw;
        }
    }

    .progress{
        height: 1.2rem;
    }

    .range-value {
        position: absolute;
        top: -200%;
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

    .switch-field {
        display: flex;
        margin-bottom: 36px;
        overflow: hidden;
    }

    .switch-field input {
        position: absolute !important;
        clip: rect(0, 0, 0, 0);
        height: 1px;
        width: 1px;
        border: 0;
        overflow: hidden;
    }

    .switch-field label {
        background-color: #fff;
        color: rgba(0, 0, 0, 0.6);
        font-size: 14px;
        line-height: 1;
        text-align: center;
        padding: 10px 30px;
        margin-right: -1px;
        border: 1px solid rgba(0, 0, 0, 0.2);
        transition: all 0.1s ease-in-out;
    }

    .switch-field label:hover {
        cursor: pointer;
    }

    .switch-field input:checked + label {
        background-color: #f0f0f0;
        color: #000;
        
    }

    .switch-field label:first-of-type {
        border-radius: 4px 0 0 4px;
    }

    .switch-field label:last-of-type {
        border-radius: 0 4px 4px 0;
    }
</style>
@endsection

@section('content')
<div id="todo">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h2 class="mb-4 text-dark">Goals</h2> --}}
                    <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#add-goal"><em>Add a Goal</em></a>
                </div><!-- /.col -->
            </div><!-- /.row -->
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
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mt-4">
                                <div class="col-auto">
                                    <div class="image">
                                        <img src="{{ Auth::user()->profile_photo_url }}" alt="User Image" width="80px" class="rounded-circle elevation-2">
                                    </div>
                                </div>
                                <div class="col my-auto">
                                    <div>
                                        <h5>{{ Auth::user()->name }}</h5>
                                        <i>{{ Auth::user()->employee_detail->job->name }}</i>
                                    </div>
                                </div>
                                <div class="col text-right">
                                    <input type="text" class="knob" value="" data-width="90" data-height="90" data-fgColor="#0B92AB" readonly data-thickness=".2" id="persen">
                                </div>
                            </div>
                            <div class="row">
                                <ul class="col">
                                    @foreach ($goals as $goal)    
                                        <li class="row mt-4">
                                            <div class="col align-self-center">
                                                <div class="row align-items-center">
                                                    <div class="col-12 col-md-6 titleUpdate">
                                                        {{ $goal->title }}
                                                    </div>
                                                    <div class="col-12 col-md-4 my-auto">
                                                        <div class="progress">
                                                            <div class="progress-bar" role="progressbar" style="width: {{ $goal->progress_percent }}%; background-color: #59BECD; color: #FFF;" aria-valuenow="{{ $goal->progress_percent }}" aria-valuemin="0" aria-valuemax="100">{{ $goal->progress_percent }}%</div>
                                                        </div>
                                                    </div>
                                                    <div class="col text-md-center">
                                                        <small>Due Date</small>
                                                        @php $date = strtotime($goal->due_date) @endphp
                                                        <p>{{ date("d-m-Y", $date) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto align-self-center">
                                                <a href="" id="detailGoal" class="btn btn-info btn-circle" data-tooltip="tooltip" title="Details" data-toggle="modal" data-target="#detailsModal" data-id="{{ $goal->id }}">
                                                    <i class="fas fa-search"></i>
                                                </a>
                                                <a href="" class="btn btn-warning btn-circle" data-tooltip="tooltip" title="Update" id="updateGoal" data-toggle="modal" data-target="#updateModal" data-id="{{ $goal->id }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
</div>

@include('employee.goals.modal-update')

@include('employee.goals.add-goal')

@endsection

@section('js')
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>
    $(function() {
        $('.knob').knob({
            'format': function(value) {
                return value + '%';
            }
        })
    });

    function showChartPercent() {
        var sum = 0;
        $('.progress-bar').each(function(){
            sum += parseInt($(this).attr('aria-valuenow'));
        });
        var $length = $('.progress-bar').length;
        var total = parseInt(sum / $length);
        document.getElementById("persen").value = total + '%';
        setTimeout(showChartPercent, 1000);
        $("input.knob").trigger('change');
    }
    showChartPercent();

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

    //modal update
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '#submit', function (event) {
            event.preventDefault()
            var id = $("#goal_id").val();
            var progress = $("#progress").val();

            $.ajax({
                url: 'goals/' + id,
                type: "POST",
                data: {
                    id: id,
                    progress: progress,
                },
                dataType: 'json',
                success: function (data) {
                    $('#goalupdate').trigger("reset");
                    $('#updateModal').modal('hide');
                    window.location.reload(true);
                }
            });
        });
        $('body').on('click', '#updateGoal', function (event) {
            event.preventDefault();
            var id = $(this).data('id');
            $.get('goals/' + id + '/edit', function (data) {
                $('#submit').val("Save Changes");
                $('#updateModal').modal('show');
                $('#goal_id').val(data.data.id);
                $('#progress').val(data.data.progress_percent);
            })
        });
        $('body').on('click', '#detailGoal', function (event) {
            event.preventDefault();
            var id = $(this).data('id');
            $.get('goals/' + id + '/edit', function (data) {
                $('#detailsModal').modal('show');
                $('#title-goal').html(data.data.title);
                $('#due-date-goal').html(data.data.due_date);
                $('#status-goal').html(data.data.status);
                $('#desc-goal').html(data.data.description);
                $('#priority-goal').html(data.data.priority);
                $('#completed-goal').html(data.data.completed_on);
            })
        });

    });
</script>

@endsection
