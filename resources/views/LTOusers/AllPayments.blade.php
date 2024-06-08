@extends('LTOusers.Layouts.LTOLayout')

@section('ViewALLPayments')
<div class="container">
    <h3>All PIT Payments</h3>
    <br>
    <br><br>

        <form action="{{ route('viewAllPayment') }}" method="GET">
            <div class=" row mb-3">
                <div class="col-md-6">
                <input type="text" class="form-control" id="formReference" name="form_reference" placeholder="Enter Form Reference Number">
                </div>
            
            <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Apply Filter</button>
            </div>
        </div>
        </form>
            
        <table class="table table-striped table-hover shadow " style="border-radius: 2px">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Form Reference Number</th>
                    <th scope="col">To be Paid</th>
                    <th scope="col">Date Submited</th>
                    <th scope="col">Payment due to </th>
                    <th scope="col">Status </th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $form)
               
                    <tr>
                        <td>{{ $form->form_reference }}</td>
                        <td>{{ $form->dueTax }}</td>
                        <td>{{ $form->submission_date }}</td>
                        <td>{{ $form->payment_deadline }}</td>
                        <td>{{ $form->status }}</td>
                        <td>
                            <a href="{{ route('payments.show', ['id' => $form->id]) }}" type="button" class="btn btn-primary">
                                <i class="bi bi-eye-fill" style="font-size: 1rem;"></i>
                            </a>
                            <!-- Add more actions as needed -->
                        </td>
                    </tr>
              
                  
                @endforeach
            </tbody>
        </table>

</div>
@endsection