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
                <h3 class="m-0 text-dark">Project Update (<span class="text-danger">5</span>)</h3>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row my-2">
                            <div class="col-auto">
                                <img src="{{ asset('img/dummy-profile.svg') }}" alt="User Image" width="60px">
                            </div>
                            <div class="col">
                                <div class="row justify-content-between">
                                    <div class="col-12 col-sm">
                                        <h5>Leave Request By <span class="text-primary">Rina Elma Suartini</span></h5>
                                        <p>Click For More Details...</p>
                                    </div>
                                    <div class="col-auto">
                                        <span class="text-notif">13:15 | 05 Oct 2020</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row my-2">
                            <div class="col-auto">
                                <img src="{{ asset('img/dummy-profile.svg') }}" alt="User Image" width="60px">
                            </div>
                            <div class="col">
                                <div class="row justify-content-between">
                                    <div class="col-12 col-sm">
                                        <h5>New Project Request Titled <span class="text-primary">Individual Development Plan Completion (company level)</span></h5>
                                        <p>Click For More Details...</p>
                                    </div>
                                    <div class="col-auto">
                                        <span class="text-notif">13:15 | 05 Oct 2020</span>
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
    </div>
    <div class="separator mb-2">And <span class="text-primary">3</span> More</div>
    <button class="btn btn-secondary btn-block">See All</button>
</section>

<!-- goal&team new -->
<section class="row">
    <div class="col-12 col-sm-6">
        <div id="goals">
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Goals</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-danger">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div style="width:100%;height:150px;margin:auto;" class="p-2">
                                                <div style="position:relative; left: 0;">
                                                    <div style="right:0;top:0;left:0;">
                                                        <input id="personalGoals" type="text" value="60" class="dial animated" readonly>
                                                    </div>
                                                    <div style="position:absolute;top:10px;left:10px;right:0;">
                                                        <input id="teamGoals" type="text" value="40" class="dial animated" readonly>
                                                    </div>
                                                    <div style="position:absolute;top:20px;left:20px;right:0;">
                                                        <input id="departmentGoals" type="text" value="10" class="dial animated" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col my-auto">
                                            <p id="pg" style="cursor: pointer;"><i class="fas fa-square text-oren"></i> Personal Goals
                                            </p>
                                            <p id="tg" style="cursor: pointer;"><i class="fas fa-square text-biru-muda"></i> Team Goals
                                            </p>
                                            <p id="dg" style="cursor: pointer;"><i class="fas fa-square text-biru-tua"></i> Department
                                                Goals</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-center">
                                            <p><span class="text-biru-muda">6</span> out of <span class="text-biru-muda">10</span> goals
                                                completed</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6">
        <div id="teams">
            <div class="content-header">
                <div class="container mb-2">
                    <h2 class="m-0 text-dark">Goals Overview</h2>
                </div><!-- /.container-fluid -->
            </div>
            <div class="content">
                <div class="container">
                    <div class="card p-3">
                        <div class="row text-center my-auto">
                            <div class="col border-left">
                                <p>On Track</p>
                                <p class="text-jumbo text-primary">3</p>
                            </div>
                            <div class="col border-left">
                                <p>Off Track</p>
                                <p class="text-jumbo text-danger">1</p>
                            </div>
                            <div class="col border-left">
                                <p>Exceeded</p>
                                <p class="text-jumbo text-success">2</p>
                            </div>
                            <div class="col border-left border-right">
                                <p>Blocks</p>
                                <p class="text-jumbo text-warning">1</p>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')

<script>
    $("#departmentGoals").hide();
    $("#teamGoals").hide();
    $(document).on("click", "#pg", function() {
        $("#departmentGoals").hide();
        $("#teamGoals").hide();
        $("#personalGoals").show();
    });
    $(document).on("click", "#tg", function() {
        $("#departmentGoals").hide();
        $("#teamGoals").show();
        $("#personalGoals").hide();
    });
    $(document).on("click", "#dg", function() {
        $("#departmentGoals").show();
        $("#teamGoals").hide();
        $("#personalGoals").hide();
    });
    $("#departmentGoals").knob({
        'thickness': ".15"
        , 'width': "90"
        , 'height': "90"
        , 'min': 0
        , 'max': 100
        , 'fgColor': "#065471"
        , 'bgColor': "#EAEAEA"
        , 'format': function(value) {
            return value + '%';
        }
        , 'change': function(value) {
            departmentGoals = Math.round(value);
            $("#departmentGoals").trigger("change");
        }
    });

    $("#teamGoals").knob({
        'thickness': ".15"
        , 'width': "110"
        , 'height': "110"
        , 'min': 0
        , 'max': 100
        , 'fgColor': "#59BECD"
        , 'bgColor': "#EAEAEA"
        , 'format': function(value) {
            return value + '%';
        }
        , 'change': function(value) {
            teamGoals = Math.round(value);
            $("#teamGoals").trigger("change");
        }
    });

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

    $('.dial').parent('div').children('canvas').mousemove(function(event) {
        $.each($('.dial').parent('div').children('canvas'), function(key, value) {
            var canvas = value;
            var context = canvas.getContext('2d');

            var position = getElementPosition(canvas);
            var x = event.pageX - position.x;
            var y = event.pageY - position.y;

            var color = context.getImageData(x, y, 1, 1).data;

            if (color[0] == 0 && color[1] == 0 && color[2] == 0) {
                $(canvas).parent('div').parent('div').css('z-index', '1');
            } else {
                $(canvas).parent('div').parent('div').css('z-index', '2');
                testi();
            }
        });
    });

    function getElementPosition(element) {
        var currentLeft = 0;
        var currentTop = 0;

        if (element.offsetParent) {
            do {
                currentLeft += element.offsetLeft;
                currentTop += element.offsetTop;
            } while (element = element.offsetParent);

            return {
                x: currentLeft
                , y: currentTop
            };
        }

        return undefined;
    }

</script>
@endsection
