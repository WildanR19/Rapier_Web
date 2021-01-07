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
                                    @foreach ($tasks as $task)    
                                        <li class="row mt-4">
                                            <div class="col align-self-center">
                                                <div class="row align-items-center">
                                                    <div class="col-12 col-md-6 titleUpdate">
                                                        {{ $task->title }}
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="progress">
                                                            <div class="progress-bar" role="progressbar" style="width: {{ $task->progress_percent }}%; background-color: #59BECD; color: #FFF;" aria-valuenow="{{ $task->progress_percent }}" aria-valuemin="0" aria-valuemax="100" id="prog1">{{ $task->progress_percent }}%</div>
                                                        </div>
                                                    </div>
                                                    <div class="col text-md-center">
                                                        <span class="badge badge-{{ ($task->status == 'incomplete') ? 'danger' : 'success' }}">{{ $task->status }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto align-self-center">
                                                <button class="btn btn-warning btn-update">Update</button>
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
@include('employee.goals.modal-chart')

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
        var hasil_val = () => {
            let arr = [];
            [0, 1, 2, 3].forEach(item => {
                arr.push(parseInt(document.getElementsByClassName(`progress-bar`)[item].getAttribute('aria-valuenow')));
            });
            var sum = arr.reduce(function(a, b) {
                return a + b;
            }, 0);
            var n = Math.round(sum / 4);
            return n;
        }
        document.getElementById("persen").value = hasil_val() + '%';
        setTimeout(showChartPercent, 1000);
        $("input.knob").trigger('change');
    }
    showChartPercent();

    function updateProgress() {
        var inputVal = document.getElementById("newAmount").value;
        $('#prog1').attr({
            "style": "width:" + inputVal + "%; background-color: #59BECD; color: #FFC045;"
            , "aria-valuenow": inputVal
        });
        $('#updateModal').modal('hide');
    }

    function modalTitle() {
        const x = document.querySelectorAll(".btn-update");
        const title = document.getElementsByClassName('titleUpdate');
        for (let i = 0; i < x.length; i++) {
            x[i].addEventListener("click", function() {
                $('#updateModal').modal('show');
                $('#updateModalLabel').html(title[i].innerHTML);
            });
        }
    }
    modalTitle();

    $(function() {
        $('.knobTeam').knob({
            'format': function(value) {
                return value + '%';
            }
        })
    });

    function backToTeam() {
        $('#chartModal').modal('hide');
    }

</script>

@endsection
