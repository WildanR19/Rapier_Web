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

    .btpercent {
        border-radius: 10px;
        font-weight: bold;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.35) !important;
    }

    #chart_div .google-visualization-orgchart-node {
        background: #FFF;
        border: 0;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        vertical-align: top;
    }

    #chart_div .google-visualization-orgchart-linebottom {
        border-bottom: 1px solid #FFC045;
    }

    #chart_div .google-visualization-orgchart-lineleft {
        border-left: 1px solid #FFC045;
    }

    #chart_div .google-visualization-orgchart-lineright {
        border-right: 1px solid #FFC045;
    }

    #chart_div .google-visualization-orgchart-linetop {
        border-top: 1px solid #FFC045;
    }

    .chart-card {
        display: flex;
        flex-direction: column;
        padding: 1.5rem .5rem !important;
    }

    .chart-card img {
        align-self: center;
        max-width: 60px;
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
                    <div class="con-button">
                        <div class="row text-center" style="margin: 0;">
                            <div class="col btn panel-btn p-3" id="Team_Panel">Team Panel</div>
                            <div class="col btn p-3" id="Individual_Panel">Individual Panel</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="con-page">
                                <div id="Page_Team_Panel" class="panel show_page">
                                    <div id="chart_div"></div>
                                </div>
                                <div id="Page_Individual_Panel" class="panel ">
                                    <div class="row mt-4">
                                        <div class="col-auto">
                                            <div class="image">
                                                <img src="{{ Auth::user()->profile_photo_url }}" alt="User Image" width="80px" class="rounded-circle elevation-2">
                                            </div>
                                        </div>
                                        <div class="col my-auto">
                                            <div>
                                                <h5>{{ Auth::user()->name }}</h5>
                                                <i>{{ Auth::user()->role }}</i>
                                            </div>
                                        </div>
                                        <div class="col text-right">
                                            <input type="text" class="knob" value="" data-width="90" data-height="90" data-fgColor="#0B92AB" readonly data-thickness=".2" id="persen">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <ul class="col">
                                            <li class="row mt-4">
                                                <div class="col align-self-center">
                                                    <div class="row align-items-center">
                                                        <div class="col-12 col-md-7 titleUpdate">
                                                            100% on time payroll payment
                                                        </div>
                                                        <div class="col-12 col-md-4">
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" style="width: 75%; background-color: #59BECD; color: #FFC045;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" id="prog1">XX%</div>
                                                            </div>
                                                        </div>
                                                        <div class="col text-md-center">
                                                            _/_
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto align-self-center">
                                                    <button class="btn btn-warning btn-update">Update</button>
                                                </div>
                                            </li>

                                            <li class="row mt-4">
                                                <div class="col align-self-center">
                                                    <div class="row align-items-center">
                                                        <div class="col-12 col-md-7 titleUpdate">
                                                            100% accuracy on total compensation calculation
                                                        </div>
                                                        <div class="col-12 col-md-4">
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" style="width: 40%; background-color: #59BECD; color: #FFC045;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" id="prog2">XX%</div>
                                                            </div>
                                                        </div>
                                                        <div class="col text-md-center">
                                                            _/_
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto align-self-center">
                                                    <button class="btn btn-warning btn-update">Update</button>
                                                </div>
                                            </li>

                                            <li class="row mt-4">
                                                <div class="col align-self-center">
                                                    <div class="row align-items-center">
                                                        <div class="col-12 col-md-7 titleUpdate">
                                                            Review & renew company regulation
                                                        </div>
                                                        <div class="col-12 col-md-4">
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" style="width: 50%; background-color: #59BECD; color: #FFC045;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" id="prog3">50%</div>
                                                            </div>
                                                        </div>
                                                        <div class="col text-md-center">
                                                            2/4
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto align-self-center">
                                                    <button class="btn btn-warning btn-update">Update</button>
                                                </div>
                                            </li>

                                            <li class="row mt-4">
                                                <div class="col align-self-center">
                                                    <div class="row align-items-center">
                                                        <div class="col-12 col-md-7 titleUpdate">
                                                            Zero finding in GA related stock opname each year
                                                        </div>
                                                        <div class="col-12 col-md-4">
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" style="width: 100%; background-color: #59BECD; color: #FFC045;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" id="prog4">100%</div>
                                                            </div>
                                                        </div>
                                                        <div class="col text-md-center">
                                                            0/0
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto align-self-center">
                                                    <button class="btn btn-warning btn-update">Update</button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="row mt-5 justify-content-center">
                                        <button class="btn btn-primary" onclick="b">Back to Team</button>
                                    </div>
                                </div>
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

@include('goals.modal-update')
@include('goals.modal-chart')

@include('goals.data-hrga')
@include('goals.data-hrdev')
@include('goals.data-hrirga')

@include('goals.data-suprecruit')
@include('goals.data-suptraining')
@include('goals.data-supod')
@include('goals.data-suphr')
@include('goals.data-supirga')

@include('goals.data-staffga')
@include('goals.data-staffhr')
@include('goals.data-staffod')
@include('goals.data-staffrecruit')
@include('goals.data-stafftraining')

@include('goals.add-goal')

@endsection

@section('js')
<script src="{{ asset('js/demo.js') }}"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>
    var Team_Panel = document.getElementById('Team_Panel');
    var Individual_Panel = document.getElementById('Individual_Panel');

    var Page_Team_Panel = document.getElementById('Page_Team_Panel');
    var Page_Individual_Panel = document.getElementById('Page_Individual_Panel');

    Team_Panel.onclick = () => {
        Page_Team_Panel.classList.add("show_page");
        Page_Individual_Panel.classList.remove("show_page");
        Team_Panel.classList.add("panel-btn");
        Individual_Panel.classList.remove("panel-btn");
    };

    Individual_Panel.onclick = () => {
        Page_Team_Panel.classList.remove("show_page");
        Page_Individual_Panel.classList.add("show_page");
        Team_Panel.classList.remove("panel-btn");
        Individual_Panel.classList.add("panel-btn");
    };

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

    google.charts.load('current', {
        packages: ["orgchart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');

        // For each orgchart box, provide the name, manager, and tooltip to show.
        data.addRows([
            // row 1
            [{
                    'v': 'r1'
                    , 'f': '<div class="chart-card"><img src="{{ asset("img/dummy-profile.svg") }}" class="img-team"><b>Kunthara Waluyo</b><div style="color:#6d6d6d; font-style:italic">HR & GA Division Head</div><button class="btn btn-light" data-toggle="modal" data-target="#data-hrga">80%</button></div>'
                }
                , '', 'HR & GA'
            ],
            // [{
            //         'v': 'r1'
            //         , 'f': '<div class="chart-card"><img src="{{ asset("img/dummy-profile.svg") }}" class="img-team"><b class="name-team">Kunthara Waluyo</b><div style="color:#6d6d6d; font-style:italic" class="role-team">HR & GA Division Head</div><button class="btn btn-light btpercent">80%</button></div>'
            //     }
            //     , '', 'HR & GA'
            // ],
            //row 2
            [{
                    'v': 'r2c1'
                    , 'f': '<div class="chart-card"><img src="{{ asset("img/dummy-profile.svg") }}" class="img-team"><b class="name-team">Rina Elma Suartini</b><div style="color:#6d6d6d; font-style:italic" class="role-team">HR Development Dept Head</div><button class="btn btn-light" data-toggle="modal" data-target="#data-hrdev">80%</button></div>'
                }
                , 'r1', 'HRD'
            ]
            , [{
                    'v': 'r2c2'
                    , 'f': '<div class="chart-card"><img src="{{ asset("img/dummy-profile.svg") }}" class="img-team"><b>Jumaidi Anggriawan</b><div style="color:#6d6d6d; font-style:italic">HR Operations & IRGA Dept Head</div><button class="btn btn-light" data-toggle="modal" data-target="#data-hrirga">80%</button></div>'
                }
                , 'r1', 'HRO'
            ],
            //row 3
            [{
                    'v': 'r3c1'
                    , 'f': '<div class="chart-card"><img src="{{ asset("img/dummy-profile.svg") }}" class="img-team"><b>Luis Hutasoit</b><div style="color:#6d6d6d; font-style:italic">Recruitment Supervisor</div><button class="btn btn-light" data-toggle="modal" data-target="#data-hrsuprecruit">80%</button></div>'
                }
                , 'r2c1', 'RS'
            ]
            , [{
                    'v': 'r3c2'
                    , 'f': '<div class="chart-card"><img src="{{ asset("img/dummy-profile.svg") }}" class="img-team"><b>Kayun Samsul Sitorus</b><div style="color:#6d6d6d; font-style:italic">Training Supervisor</div><button class="btn btn-light" data-toggle="modal" data-target="#data-suptraining">80%</button></div>'
                }
                , 'r2c1', 'TS'
            ]
            , [{
                    'v': 'r3c3'
                    , 'f': '<div class="chart-card"><img src="{{ asset("img/dummy-profile.svg") }}" class="img-team"><b>Teddy Kurnia Halim</b><div style="color:#6d6d6d; font-style:italic">OD Supervisor</div><button class="btn btn-light" data-toggle="modal" data-target="#data-supod">80%</button></div>'
                }
                , 'r2c1', 'ODS'
            ]
            , [{
                    'v': 'r3c4'
                    , 'f': '<div class="chart-card"><img src="{{ asset("img/dummy-profile.svg") }}" class="img-team"><b>Kiandra Wulandari</b><div style="color:#6d6d6d; font-style:italic">HR Operations Supervisor</div><button class="btn btn-light" data-toggle="modal" data-target="#data-suphr">80%</button></div>'
                }
                , 'r2c2', 'HROS'
            ]
            , [{
                    'v': 'r3c5'
                    , 'f': '<div class="chart-card"><img src="{{ asset("img/dummy-profile.svg") }}" class="img-team"><b>Cornelia Purwanti</b><div style="color:#6d6d6d; font-style:italic">IR & GA Supervisor</div><button class="btn btn-light"  data-toggle="modal" data-target="#data-supirga">80%</button></div>'
                }
                , 'r2c2', 'IRGAS'
            ],
            //row 4
            [{
                    'v': 'r4c1'
                    , 'f': '<div class="chart-card"><img src="{{ asset("img/dummy-profile.svg") }}" class="img-team"><b>Kani Lailasari</b><div style="color:#6d6d6d; font-style:italic">Recruitment Staff</div><button class="btn btn-light" data-toggle="modal" data-target="#data-staffrecruit">80%</button></div>'
                }
                , 'r3c1', 'RSt'
            ]
            , [{
                    'v': 'r4c2'
                    , 'f': '<div class="chart-card"><img src="{{ asset("img/dummy-profile.svg") }}" class="img-team"><b>Rafi Hidayat</b><div style="color:#6d6d6d; font-style:italic">Training Staff</div><button class="btn btn-light" data-toggle="modal" data-target="#data-stafftraining">80%</button></div>'
                }
                , 'r3c2', 'TSt'
            ]
            , [{
                    'v': 'r4c3'
                    , 'f': '<div class="chart-card"><img src="{{ asset("img/dummy-profile.svg") }}" class="img-team"><b>Dono Prakasa</b><div style="color:#6d6d6d; font-style:italic">OD Staff</div><button class="btn btn-light" data-toggle="modal" data-target="#data-staffod">80%</button></div>'
                }
                , 'r3c3', 'ODSt'
            ]
            , [{
                    'v': 'r4c4'
                    , 'f': '<div class="chart-card"><img src="{{ asset("img/dummy-profile.svg") }}" class="img-team"><b>Salman Prasetyo</b><div style="color:#6d6d6d; font-style:italic">HR Operation Staff</div><button class="btn btn-light" data-toggle="modal" data-target="#data-staffhr">80%</button></div>'
                }
                , 'r3c4', 'HROSt'
            ]
            , [{
                    'v': 'r4c5'
                    , 'f': '<div class="chart-card"><img src="{{ asset("img/dummy-profile.svg") }}" class="img-team"><b>Siti Fujiati</b><div style="color:#6d6d6d; font-style:italic">GA Staff</div><button class="btn btn-light" data-toggle="modal" data-target="#data-staffga">80%</button></div>'
                }
                , 'r3c5', 'GASt'
            ]
        , ]);
        data.setRowProperty(0, 'style', 'background: #FFC045');
        // Create the chart.
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        google.visualization.events.addListener(chart, 'select', chartModal);
        // Draw the chart, setting the allowHtml option to true for the tooltips.
        chart.draw(data, {
            'allowHtml': true
        });

        function chartModal() {
            const a = document.querySelectorAll(".btpercent");
            const nt = document.getElementsByClassName('name-team');
            const rt = document.getElementsByClassName('role-team');
            const it = document.getElementsByClassName('img-team');
            for (let i = 0; i < a.length; i++) {
                a[i].addEventListener("click", function() {
                    $('#chartModal').modal('show');
                    $('#nameTeam').html(nt[i].innerHTML);
                    $('#roleTeam').html(rt[i].innerHTML || '');
                    $('#imgTeam').attr('src', it[i].getAttribute('src'));
                    $('.knobTeam').val(a[i].innerHTML);
                    $('input.knobTeam').trigger('change');
                });
            }
        }
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
