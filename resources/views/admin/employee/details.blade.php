@extends('layout.dash')
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <!-- Sweet Alert -->
    <link href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">

    <style>
        .description-header{
            font-weight: 500;
            text-transform: uppercase;
            font-size: 14px;
            margin: 0px 0px 12px;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="card card-widget widget-user">
                        <div class="widget-user-header bg-info">
                          <h3 class="widget-user-username">{{ auth()->user()->name }}</h3>
                          {{-- <h5 class="widget-user-desc">{{ auth()->user()->employee_detail()->job }}</h5> --}}
                        </div>
                        <div class="widget-user-image">
                          <img class="img-circle elevation-2" src="{{ auth()->user()->profile_photo_url }}" alt="User Avatar">
                        </div>
                        <div class="card-footer">
                          <div class="row">
                            <div class="col-md-6 border-right col-in">
                                <h5 class="description-header">Tasks Done</h5>
                                <div class="row font-larger">
                                    <div class="col-md-4 px-2"><i class="fas fa-tasks text-success"></i></div>
                                    <div class="col-md-8 px-2 text-right">0</div>
                                </div>
                            </div>
                            <div class="col-md-6 col-in">
                                <h5 class="description-header">Leaves Taken</h5>
                                <div class="row font-larger">
                                    <div class="col-md-4 px-2"><i class="nav-icon fas fa-calendar-times text-warning"></i></div>
                                    <div class="col-md-8 px-2 text-right">0</div>
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6 border-right col-in">
                                <h5 class="description-header">LEAVES REMAINING</h5>
                                <div class="row font-larger">
                                    <div class="col-md-4 px-2"><i class="nav-icon fas fa-calendar-times text-danger"></i></i></div>
                                    <div class="col-md-8 px-2 text-right">15</div>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header d-flex p-0">
                            <ul class="nav nav-pills mx-auto p-2">
                                <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Profile</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Projects</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Tasks</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Leaves</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="row">
                                        <div class="col-md-4 border-right"> <strong>Name</strong> <br>
                                            <p class="text-muted">{{ auth()->user()->name }}</p>
                                        </div>
                                        <div class="col-md-4 border-right"> <strong>Email</strong> <br>
                                            <p class="text-muted">{{ auth()->user()->email }}</p>
                                        </div>
                                        <div class="col-md-4"> <strong>Gender</strong> <br>
                                            <p class="text-muted">#</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4 border-right"> <strong>Department</strong> <br>
                                            <p class="text-muted">#</p>
                                        </div>
                                        <div class="col-md-4 border-right"> <strong>Job</strong> <br>
                                            <p class="text-muted">#</p>
                                        </div>
                                        <div class="col-md-4"> <strong>Joining Date</strong> <br>
                                            <p class="text-muted">#</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <strong>Address</strong>
                                            <br><p class="text-muted">#</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">
                                    The European languages are members of the same family. Their separate existence is a
                                    myth.
                                    For science, music, sport, etc, Europe uses the same vocabulary. The languages only
                                    differ
                                    in their grammar, their pronunciation and their most common words. Everyone realizes
                                    why a
                                    new common language would be desirable: one could refuse to pay expensive
                                    translators. To
                                    achieve this, it would be necessary to have uniform grammar, pronunciation and more
                                    common
                                    words. If several languages coalesce, the grammar of the resulting language is more
                                    simple
                                    and regular than that of the individual languages.
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_3">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                    when an unknown printer took a galley of type and scrambled it to make a type
                                    specimen book.
                                    It has survived not only five centuries, but also the leap into electronic
                                    typesetting,
                                    remaining essentially unchanged. It was popularised in the 1960s with the release of
                                    Letraset
                                    sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                                    software
                                    like Aldus PageMaker including versions of Lorem Ipsum.
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<!-- Sweet Alert -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    $(function () {
        $('#empTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
        });
    });
</script>
@endsection