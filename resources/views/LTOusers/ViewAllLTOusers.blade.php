@extends('LTOusers.Layouts.LTOLayout')

@section('ViewAllLtoUsers')
<div class="container ">
    <h3>Tax Office Employess</h3>
    <br>
    <form action="{{ route('allLtoUser') }}" method="GET">
        <div class="row mb-3">
            <div class="col">
                <input type="text" class="form-control border-left-primary" name="name" placeholder="Filter by name">
            </div>
            <!-- Add more filter fields as needed -->
            <div class="col">
                <button type="submit" class="btn btn-primary">Apply Filters</button>
            </div>
        </div>
    </form>
    <br>
   
    <table class="table table-striped table-hover shadow ">
        <thead class="table-dark">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Gender</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->gender }}</td>
                    <td>
                        @if(auth()->guard('ltouser')->user()->role == 'Manager')
                            <a href="{{ route('showUpdateForm', ['id' => $user->id]) }}" type="button" class="btn btn-primary">
                                <i class="bi bi-pen"></i>
                            </a>
                        @else
                            <a href="{{ route('showUpdateForm', ['id' => $user->id]) }}" type="button" class="btn btn-primary">
                                <i class="bi bi-eye"></i>
                            </a>
                        @endif
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection