@extends('Taxpayer.Layouts.layout')

@section('ViewDuePayments')
<div class="container">
    <br><br>
       <!-- Form Reference Filter -->
       <form action="{{ route('RetrivePaymentt') }}" method="GET" class="mb-4 ">
            <div class="row mb-3">
                <div class="col">
                    <input type="text" class="form-control shadow" name="form_reference" placeholder="Enter Form Reference">
                </div>
                <!-- Add more filter fields as needed -->
                <div class="col">
                    <button type="submit" class="btn btnn shadow">Apply Filters</button>
                </div>
            </div>
        </form>

        <table class="table shadow" id="formsTable">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Form Reference Number</th>
                    <th scope="col">DueTax</th>
                    <th scope="col">Date Submited</th>
                    <th scope="col">Payment due to </th>
                    <th scope="col">status </th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($formsWithPayments as $form)
                @if ($form->payment)
                    <tr>
                        <td>{{ $form->payment->form_reference }}</td>
                        <td>{{ $form->payment->dueTax }}</td>
                        <td>{{ $form->payment->submission_date }}</td>
                        <td>{{ $form->payment->payment_deadline }}</td>
                        <td>{{ $form->payment->status}}</td>
                        <td>
                            <a href="{{ route('paymentshow', $form->payment->id) }}" type="button" class="btn btnn">
                                <i class="bi bi-eye-fill" style="font-size: 1rem;"></i>
                            </a>
                            <!-- Add more actions as needed -->
                        </td>
                    </tr>
                    @else
                  
                @endif
                @endforeach
            </tbody>
        </table>

</div>
@endsection