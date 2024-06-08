@if($users->isEmpty())
    <p>No users found.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>UEN</th>
                <th>Email</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->firstname }}</td>
                <td>{{ $user->lastname }}</td>
                <td>{{ $user->uen }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif
