{{ auth()->user()->unreadNotifications->count() }} 

<ul>
    @foreach(auth()->user()->unreadNotifications as $notification)
    <li>
        {{ $notification->data['leave_id'] }} => {{ $notification->data['notification_type'] }}
    </li>
    @endforeach
</ul>