@extends('layout.dash')

@section('content')
<section>
    {{-- <h2 class="mb-4">Projects</h2> --}}
    <div class="row no-gutters mb-4 justify-content-end">
        <form action="">
            <div class="form-control px-3 py-2" style="height: auto;">
                <!-- <button type="submit"> -->
                <i class="fas fa-search"></i>
                <!-- </button> -->
                <input type="search" name="" id="" class="border-0" style="outline: none;" placeholder="Search Projects">
            </div>
        </form>
    </div>
    @empty($projects)
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Project is empty ...</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fas fa-times"></i></button>
              </div>
            </div>
        </div>
    @endempty
    <ul class="row no-gutters p-0">
        @foreach ($projects as $project)    
            <li class="card w-100 p-4 mb-4">
                <div class="row no-gutters justify-content-between mb-3">
                    @php
                    $status = ['not started','in progress','on hold','canceled','finished'];
                        if ($project->status == $status[0]){
                            $text = 'dark';
                        }else if($project->status == $status[1]){
                            $text = 'progress';
                        }else if($project->status == $status[2]){
                            $text = 'pending';
                        }else if($project->status == $status[3]){
                            $text = 'danger';
                        }else{
                            $text = 'success';
                        }
                    @endphp
                    <h6 class="text-{{$text}}"><em>{{ $project->status }}</em></h6>
                    <div>
                        @php
                            $date = strtotime($project->deadline);
                            $day = date('l, d M Y', $date);
                        @endphp
                        Due <span class="text-primary">{{ $day }}</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-auto">
                        <img src="{{ (!empty($project->user->profile_photo_path)) ? url('/storage/'.$project->user->profile_photo_path) : asset('img/dummy-profile.svg') }}" class="img-project-card">
                    </div>
                    <div class="col">
                        <h4>{{ $project->project_name }} <span class="text-capitalize font-italic">({{ $project->category->category_name }})</span></h4>
                        <h6 class="text-gray">Submitted by <span class="text-primary">{{ $project->user->name }}</span></h6>
                    </div>
                </div>
                <p class="mb-5">{{ $project->project_summary }}</p>

                <div class="row no-gutters justify-content-between mb-2 text-bold">
                    <div>
                        <span class="text-primary">{{ $project->members->count() }}</span> <em>Assigned Member(s)</em>
                    </div>
                    <div>
                        <span class="text-primary">{{ $project->updates->count() }}</span> <em>Total Update(s)</em>
                    </div>
                </div>

                <div class="row no-gutters align-items-center justify-content-between">
                    <div>
                        <ul class="row no-gutters list-assigned p-0">
                            @php $count = 0; @endphp
                            @foreach ($members as $member)
                                @php if($count == 5) break; @endphp
                                    @if ($member->project_id == $project->id)
                                        <li><a href=""><img src="{{ (!empty($member->user->profile_photo_path)) ? url('/storage/'.$member->user->profile_photo_path) : asset('img/dummy-profile.svg') }}"></a></li>
                                    @endif
                                @php $count++; @endphp
                            @endforeach
                            @if ($members->count() > 5)
                                <li class="text-gray"><a href=""><em>and {{ ($members->count() - 5) }} more</em></a></li>
                            @endif
                        </ul>
                    </div>
                    <div><a href="{{ route('dash.projects.details', $project->id) }}" class="btn btn-primary"><em>See Details</em></a></div>
                </div>
            </li>
        @endforeach
    </ul>
</section>
@endsection
