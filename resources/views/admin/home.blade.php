@extends('layout.dash')
@section('css')

@endsection
@section('content')
<section>
    <div class="content-header">
        <h2>Dashboard</h2>
    </div>
    <div class="content">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>{{ $users->count() }}</h3>
                    <p>Kount Employee</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-users"></i>
                  </div>
                  <a href="{{ route('admin.employee')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>{{ $departments->count() }}</h3>
                    <p>Departments</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-building"></i>
                  </div>
                  <a href="{{ route('admin.department') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>{{ $jobs->count() }}</h3>
                    <p>Jobs</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-briefcase"></i>
                  </div>
                  <a href="{{ route('admin.job') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-maroon">
                  <div class="inner">
                    <h3>{{ $projects->count() }}</h3>
                    <p>Project Totals</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-chart-pie"></i>
                  </div>
                  <a href="{{ route('admin.projects') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-lightblue">
                    <div class="card-header">
                      <h3 class="card-title">Pending Leaves</h3>
      
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="products-list product-list-in-card pl-2 pr-2">
                          @empty($leaves)
                              <li>Pending Leave is Empty ...</li>
                          @endempty
                          @foreach ($leaves as $leave)    
                            <li class="item">
                                <div class="ml-2">
                                <a href="javascript:void(0)" class="product-title">{{ $leave->user->name }}
                                    <span class="badge badge-{{ $leave->type->color }} float-right">{{ $leave->type->type_name }}</span></a>
                                <span class="product-description">
                                    {{ $leave->reason }}
                                </span>
                                </div>
                            </li>
                          @endforeach
                      </ul>
                    </div>
                    <div class="card-footer text-center">
                      <a href="{{ route('admin.leaves') }}" class="uppercase">View All Leaves</a>
                    </div>
                </div>
                <div class="card card-lightblue">
                    <div class="card-header">
                      <h3 class="card-title">Leave Chart ({{ date("Y") }})</h3>
      
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
            <div class="col-md-6">
                <div class="card card-maroon">
                    <div class="card-header">
                        <h3 class="card-title">Project Chart</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="projectChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
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
    var cData = JSON.parse(`<?php echo $chart_data; ?>`);
    var ctx = document.getElementById('projectChart').getContext('2d');
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: cData.label,
            datasets: [{
                data: cData.data,
                backgroundColor: ['#001f3f', '#3c8dbc', '#ff851b', '#dc3545', '#3d9970'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio : false,
        }
    });

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
