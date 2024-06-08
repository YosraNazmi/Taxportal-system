@extends('LTOusers.Layouts.LTOLayout')

@section('ReviewPendingUsers')
<div class="container mt-4">
    <h3>Pending Users</h3>
    <br>
    <!-- Display flash messages -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($pendingUsers->isEmpty())
        <p>No pending users found.</p>
    @else
        <table class="table table-striped table-hover shadow">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Fisrtname</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Comapny Name</th>
                    <th scope="col">UEN</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendingUsers as $user)
                    <tr>
                        <td>{{ $user->firstname }}</td>
                        <td>{{ $user->lastname }}</td>
                        <td>{{ $user->companyName }}</td>
                        <td>{{ $user->uen }}</td>
                        <td>{{ $user->email }}</td>
                        <td><a href="{{ route('showTP', ['id' => $user->id]) }}" type="button" class="btn btn-primary"><i class="bi bi-eye-fill"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
