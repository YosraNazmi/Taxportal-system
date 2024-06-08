@extends('LTOusers.Layouts.LTOLayout')

@section('CategoryReport')
<br>
<h3>User Category Report</h3>
<br>
<table class="table table-striped table-hover shadow" style="border-radius: 2px">
    <thead class="table-dark">
        <tr>
            <th scope="col">Category</th>
            <th scope="col">Number of Users</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->category }}</td>
                <td>{{ $category->user_count }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection