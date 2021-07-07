@if (Auth::user()->role->name == 'Admin' && Request::segment(1) != 'dashboard')    
    <section class="content-header">
        <div class="container-fluid">
            <div class="row m-0 mb-2">
                <div class="col-sm-6">
                    <h1 class="text-capitalize">{{ Request::segment(2) }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Home</a></li>
                        <?php $segments = ''; ?>
                        @foreach(Request::segments() as $segment)
                            <?php $segments .= '/'.$segment; ?>
                            @if ($segment != 'admin')    
                                @if (!$loop->last)
                                    <li class="breadcrumb-item">
                                        <a href="{{ url($segments) }}">{{$segment}}</a>
                                    </li>
                                @else
                                    <li class="breadcrumb-item active">{{$segment}}</li>
                                @endif
                            @endif
                            
                        @endforeach
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endif

@if (Auth::user()->role_id == 2 && Request::segment(1) != 'dashboard')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row m-0 mb-2">
                <div class="col-sm-6">
                    <h1 class="text-capitalize">{{ Request::segment(1) }}</h1>
                </div>
                @if (Request::segment(2) != null)
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Home</a></li> --}}
                            <?php $segments = ''; ?>
                            <li class="breadcrumb-item"><a href="{{ route('dash.home') }}">Home</a></li>
                            @foreach(Request::segments() as $segment)
                                <?php $segments .= '/'.$segment; ?>
                                @if ($loop->last)
                                    <li class="breadcrumb-item active">{{$segment}}</li>
                                @else
                                    <li class="breadcrumb-item">
                                        <a href="{{ url($segments) }}">{{$segment}}</a>
                                    </li>
                                @endif
                                
                            @endforeach
                        </ol>
                    </div>
                @endif
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endif