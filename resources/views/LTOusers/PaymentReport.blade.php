@extends('LTOusers.Layouts.LTOLayout')

@section('PaymentReport')
<br>
<h3>Payment Status Report</h3>
<br>
<table class="table table-striped table-hover shadow" style="border-radius: 2px">
    <thead class="table-dark">
        <tr>
            <th scope="col">User ID</th>
            <th scope="col">Form Reference</th>
            <th scope="col">Quarter</th>
            <th scope="col">Payment Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->user_id }}</td>
                <td>{{ $payment->form_reference }}</td>
                <td>{{ $payment->quarter }}</td>
                <td>{{ $payment->status ?? 'Not Paid' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection