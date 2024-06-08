@extends('Taxpayer.Layouts.layout')

@section('ViewRepresentative')
<div class="container ">
    <br><br>
    <h3>Representatives</h3>
    <br>
    <form action="" method="GET">
        <div class="row mb-3">
            <div class="col">
                <input type="text" class="form-control border-left-primary" name="name" placeholder="Filter by name">
            </div>
            <!-- Add more filter fields as needed -->
            <div class="col">
                <button type="submit" class="btn btnn">Apply Filters</button>
            </div>
        </div>
    </form>
    <br>
   <div>
        <a class="btn btnn" href="{{route('representative.store')}}">Add New Representative</a>
   </div>
   <br>
    <table class="table table-striped table-hover shadow ">
        <thead class="table-dark">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($representative as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{$user->status}}</td>
                    <td>
                            <a href="{{ route('representative.edit', ['id' => $user->id]) }}" type="button" class="btn btnn">
                                <i class="bi bi-pen"></i>
                            </a>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection