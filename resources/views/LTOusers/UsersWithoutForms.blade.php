@extends('LTOusers.Layouts.LTOLayout')

@section('UsersWithoutForms')
<br>
<h3>Users Without Submitted Forms</h3>
<br>
<table class="table table-striped table-hover shadow" style="border-radius: 2px">
    <thead class="table-dark">
        <tr>
            <th scope="col">User ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
        </tr>
    </thead>
    <tbody>
        @foreach($usersWithoutForms as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->firstname }}</td>
                <td>{{ $user->lastname }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection