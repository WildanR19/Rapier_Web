<div class="card">
    <div class="card-body p-0">
        <ul class="timeline">
            @foreach ($activities as $act)
                <li>
                    <a>{{ $act->activity }}</a>
                    <p>{{ $act->created_at->diffForHumans() }}</p>
                </li>
            @endforeach
        </ul>
    </div>
    <!-- /.card-body -->
</div>