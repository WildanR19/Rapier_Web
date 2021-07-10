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
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Hello, {{ Auth::user()->name }}</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header border-transparent">
                              <h3 class="card-title">Task Incomplete</h3>
              
                              <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                  <i class="fas fa-times"></i>
                                </button>
                              </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                              <div class="table-responsive">
                                <table class="table m-0">
                                  <thead>
                                    <tr>
                                        <th>Task</th>
                                        <th>Project</th>
                                        <th>Priority</th>
                                        <th>Due Date</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @php $count = 0; @endphp
                                    @foreach ($tasks as $task)
                                        @php if($count++ == 5) break; @endphp
                                        <tr>
                                            <td><a href="{{ route('task.details', $task->id) }}">{{ $task->title }}</a></td>
                                            <td><a href="{{ route('admin.projects.details', $task->project_id) }}">{{ $task->project_name }}</a></td>
                                            @php
                                                $priority = ['low', 'medium', 'high'];
                                                if ($priority[0] == $task->priority) {
                                                    $color = 'success';
                                                } elseif ($priority[1] == $task->priority) {
                                                    $color = 'warning';
                                                } else {
                                                    $color = 'danger';
                                                }
                                            @endphp
                                            <td><span class="badge badge-{{$color}}">{{$task->priority}}</span></td>
                                            <td>
                                            <div class="text-danger">{{ $task->due_date }}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>
                              <!-- /.table-responsive -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                              <a class="btn btn-sm btn-primary float-right" href="{{ route('dash.task') }}">View All Tasks</a>
                            </div>
                            <!-- /.card-footer -->
                          </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tasks</h3>
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
                                    ($pg->where('status', 'completed')->count() != 0) ? $pgpercent = (int)round($pg->where('status', 'completed')->count() / $pg->count() * 100) : $pgpercent = 0;
                                @endphp
                                <input id="personalGoals" type="text" value="{{ $pgpercent }}" class="dial animated" readonly data-thickness=".2">
                            </div>
                            <div class="col my-auto">
                                <p id="pg" style="cursor: pointer;"><i class="fas fa-square text-oren"></i> Personal Tasks
                                </p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col text-center">
                                <p id="personalp"><span class="text-oren font-weight-bold">{{ $pg->where('status', 'completed')->count() }}</span> out of <span class="text-oren font-weight-bold">{{ $pg->count() }}</span> tasks completed</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-primary">
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
