@extends('LTOusers.Layouts.LTOLayout')

@section('AllTaxpayers')
<div class="container ">
    <h3>All Taxpayers</h3>
    <br>
    <form action="{{ route('allTaxpayers') }}" method="GET">
        <div class="row mb-3">
            <div class="col">
                <input type="text" class="form-control border-left-primary" name="uen" placeholder="Filter by UEN">
            </div>
            <div class="col">
                <input type="text" class="form-control border-left-primary" name="status" placeholder="Filter by status">
            </div>
            <div class="col">
                <input type="text" class="form-control border-left-primary" name="approval_type" placeholder="Filter by approval_type">
            </div>
            <!-- Add more filter fields as needed -->
            <div class="col">
                <button type="submit" class="btn btn-primary">Apply Filters</button>
            </div>
        </div>
    </form>
    <br>
    
    <table class="table table-striped table-hover shadow" style="border-radius: 2px">
        <thead class="table-dark">
            <tr>
                <th scope="col">Fisrtname</th>
                <th scope="col">Lastname</th>
                <th scope="col">Comapny Name</th>
                <th scope="col">UEN</th>
                <th scope="col">Email</th>
                <th scope="col">status</th>
                <th scope="col">Type</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->firstname }}</td>
                    <td>{{ $user->lastname }}</td>
                    <td>{{ $user->companyName }}</td>
                    <td>{{ $user->uen }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->status }}</td>
                    <td>{{ $user->approval_type}}</td>
                    <td><a href="{{ route('viewOneTaxpayer', ['id' => $user->id]) }}" type="button" class="btn btn-primary"><i class="bi bi-eye-fill"></i></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</div>
@endsection