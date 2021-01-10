@extends('layout.dash')
@section('css')
<style>
    .separator {
        display: flex;
        align-items: center;
        text-align: center;
    }
    .separator::before, .separator::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid #000;
    }
    .separator::before {
        margin-right: .25em;
    }
    .separator::after {
        margin-left: .25em;
    }
    .text-jumbo{
        font-size: 5rem;
    }
</style>
@endsection
@section('content')
<section id="notif">
    <h2 class="mb-4">Hello, {{ Auth::user()->name }}</h2>
    <div class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 text-dark">Project Update (<span class="text-danger">{{ $updates->count() }}</span>)</h3>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                @php $count = 0; @endphp
                @foreach ($updates as $update)
                    @php if($count == 3) break; @endphp
                        <div class="card">
                            <div class="card-body">
                                <div class="row my-2">
                                    <div class="col-auto">
                                        <img src="{{ (!empty($update->user->profile_photo_path)) ? asset('storage/'.$update->user->profile_photo_path) : asset('img/dummy-profile.svg') }}" alt="User Image" class="thumb-dashboard">
                                    </div>
                                    <div class="col">
                                        <div class="row justify-content-between">
                                            <div class="col-12 col-sm">
                                                <h5><span class="text-primary">{{ $update->user->name }}</span> on Project <span class="text-primary">{{ $update->project->project_name }}</span></h5>
                                                <p>{{ $update->comment }}</p>
                                            </div>
                                            <div class="col-auto">
                                                <span class="text-notif">{{ date('H:i', strtotime($update->updated_at)) }} | {{ date('j M Y', strtotime($update->updated_at)) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @php $count++; @endphp
                @endforeach
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div>
    <div class="separator mb-2">And <span class="text-primary">{{ $updates->count()-3 }}</span> More</div>
    <a href="{{ route('dash.projects') }}" class="btn btn-primary btn-block">See All</a>
</section>

<section class="row mt-3">
    <div class="col-md-6">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Goals</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col text-center">
                        @php
                            $pgpercent = (int)round($pg->sum('progress_percent') / $pg->count());
                        @endphp
                        <input id="personalGoals" type="text" value="{{ $pgpercent }}" class="dial animated" readonly data-thickness=".2">
                    </div>
                    <div class="col my-auto">
                        <p id="pg" style="cursor: pointer;"><i class="fas fa-square text-oren"></i> Personal Goals
                        </p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col text-center">
                        <p id="personalp"><span class="text-oren font-weight-bold">{{ $pg->where('status', 'completed')->count() }}</span> out of <span class="text-oren font-weight-bold">{{ $pg->count() }}</span> goals completed</p>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Leave Chart Period {{ date("Y") }}</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script>
    $("#personalGoals").knob({
        'thickness': ".15"
        , 'width': "130"
        , 'height': "130"
        , 'min': 0
        , 'max': 100
        , 'fgColor': "#FFC045"
        , 'bgColor': "#EAEAEA"
        , 'format': function(value) {
            return value + '%';
        }
        , 'change': function(value) {
            personalGoals = Math.round(value);
            $("#personalGoals").trigger("change");
        }
    , });

    var lData = JSON.parse(`<?php echo $leave_data; ?>`);
    var ctx = document.getElementById('barChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: lData.label,
            datasets: [
                {
                    label: 'Leaves Approved',
                    data: lData.data_approve,
                    backgroundColor: '#3d9970',
                },
                {
                    label: 'Leaves Rejected',
                    data: lData.data_reject,
                    backgroundColor: '#dc3545',
                },
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio : false,
        }
    });
</script>
@endsection
