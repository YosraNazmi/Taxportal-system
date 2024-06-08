@extends('LTOusers.Layouts.LTOLayout')

@section('QuarterReport')
<br>
<h3>Form Submission Report per Quarter</h3>
<br>
<table class="table table-striped table-hover shadow" style="border-radius: 2px">
    <thead class="table-dark">
        <tr>
            <th scope="col">Quarter</th>
            <th scope="col">Number of Forms</th>
            <th scope="col">Number of Users</th>
        </tr>
    </thead>
    <tbody>
        @foreach($quarters as $quarter)
            <tr>
                <td>{{ $quarter->quarter }}</td>
                <td>{{ $quarter->form_count }}</td>
                <td>{{ $quarter->user_count }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection