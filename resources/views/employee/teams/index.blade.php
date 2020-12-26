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
        background: #0B92AB;
        color: #FFC045;
        font-style: italic;
        font-size: small;
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
        width: 120px;
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
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1 class="m-0 text-dark">Teams</h1> --}}
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="con-button">
                        <div class="row text-center" style="margin: 0;">
                            <div class="col btn panel-btn p-3" id="Team_Panel">Organization Chart</div>
                            <div class="col btn p-3" id="Individual_Panel">My Profile</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="con-page">
                                <div id="Page_Team_Panel" class="panel show_page">
                                    <div id="chart_div"></div>
                                </div>
                                <div id="Page_Individual_Panel" class="panel ">
                                    <div class="row">
                                        <div class="col text-center my-auto border-right">
                                            <div class="image">
                                                <img src="{{ Auth::user()->profile_photo_url }}" alt="User Image" width="200px" id="imgTeam" class="rounded-circle elevation-2">
                                            </div>
                                            <div class="head mt-2">
                                                <h2>{{ Auth::user()->name }}</h2>
                                                <h5 style="color: #59BECD;"><i>{{ Auth::user()->role }}</i></h5>
                                                <p style="color: #6c757d;">Department</p>
                                            </div>
                                            <div class="foot mt-4">
                                                <p>Joined Kount <br> since Oktober 2020</p>
                                            </div>
                                        </div>
                                        <div class="col my-auto">
                                            <div class="px-5">
                                                <div class="contact-info">
                                                    <h5><i>Contact Info</i></h5>
                                                    <p>+62 812 3456 7890</p>
                                                    <p>emailaddress@domain.com</p>
                                                </div>
                                                <div class="birth mt-5">
                                                    <h5><i>Date of Birth</i></h5>
                                                    <p>01 January</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col text-center">
                                            <button class="btn btn-secondary" data-toggle="modal" data-target="#editContactModal">Edit Contact Info</button>
                                        </div>
                                        <div class="col text-center">
                                            <button class="btn btn-primary" onclick="backToChart()">Back to Org Chart</button>
                                        </div>
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

@include('teams.modal')

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
                    , 'f': '<div class="chart-card"><img src="{{ asset("img/dummy-profile.svg") }}" class="img-team"><b class="name-team">Kunthara Waluyo</b><div style="color:#6d6d6d; font-style:italic" class="role-team">HR & GA Division Head</div><button class="btn btpercent" data-toggle="modal" data-target="#data-hrga">Profile</button></div>'
                }
                , '', 'HR & GA'
            ],
            //row 2
            [{
                    'v': 'r2c1'
                    , 'f': '<div class="chart-card"><img src="{{ asset("img/dummy-profile.svg") }}" class="img-team"><b class="name-team">Rina Elma Suartini</b><div style="color:#6d6d6d; font-style:italic" class="role-team">HR Development Dept Head</div><button class="btn btpercent" data-toggle="modal" data-target="#data-hrdev">Profile</button></div>'
                }
                , 'r1', 'HRD'
            ]
            , [{
                    'v': 'r2c2'
                    , 'f': '<div class="chart-card"><img src="{{ asset("img/dummy-profile.svg") }}" class="img-team"><b class="name-team">Jumaidi Anggriawan</b><div style="color:#6d6d6d; font-style:italic" class="role-team">HR Operations & IRGA Dept Head</div><button class="btn btpercent" data-toggle="modal" data-target="#data-hrirga">Profile</button></div>'
                }
                , 'r1', 'HRO'
            ]
            , [{
                    'v': 'r2c3'
                    , 'f': '<div class="chart-card"><img src="{{ asset("img/dummy-profile.svg") }}" class="img-team"><b class="name-team">Jumaidi Anggriawan</b><div style="color:#6d6d6d; font-style:italic" class="role-team">HR Operations & IRGA Dept Head</div><button class="btn btpercent" data-toggle="modal" data-target="#data-hrirga">Profile</button></div>'
                }
                , 'r1', 'HRO'
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
                    $('#profileModal').modal('show');
                    $('#nameTeam').html(nt[i].innerHTML);
                    $('#roleTeam').html(rt[i].innerHTML || '');
                    $('#imgTeam').attr('src', it[i].getAttribute('src'));
                });
            }
        }
    }

    function backToTeam() {
        $('#profileModal').modal('hide');
    }

    function backToChart() {
        Page_Team_Panel.classList.add("show_page");
        Page_Individual_Panel.classList.remove("show_page");
        Team_Panel.classList.add("panel-btn");
        Individual_Panel.classList.remove("panel-btn");
    }

</script>

@endsection
