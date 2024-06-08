@if (!empty($notifications))
    @foreach ($notifications as $notification)
        <div>{{ $notification->data['message'] }}</div>
    @endforeach
@else
    <p>No notifications available.</p>
@endif