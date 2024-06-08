@extends('Taxpayer.Layouts.layout')
@section('GenerateReport')
<div class="container">
    <br>
    <h3>Generate Report</h3>
    <br><br>
        <!-- Tax Reference Filter -->
        <form action="{{ route('generateReport') }}" method="GET" class="mb-4 ">
            <!-- Tax Reference Filter -->
            <div class="row mb-3">
                <div class="col">
                    <input type="text" class="form-control shadow" name="form_reference" placeholder="Enter Tax Reference" value="{{ Request::query('form_reference') }}">
                </div>
                <!-- Add more filter fields as needed -->
                <div class="col">
                    <button type="submit" class="btn btnn shadow">Apply Filters</button>
                    <a href="{{ route('generateReport', ['export' => 'excel', 'form_reference' => Request::query('form_reference')]) }}" class="btn btn-primary">Export to Excel</a>
                </div>
            </div>
        </form>
        

        <table class="table shadow" id="formsTable">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Form Reference Number</th>
                    <th scope="col">To be Paid</th>
                    <th scope="col">Date Submited</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($formsWithPayments as $form)
                    <tr>
                        <td>{{ $form->form_reference }}</td>
                        <td>{{ $form->payment ? $form->payment->dueTax : 'N/A' }}</td>
                        <td>{{ $form->payment ? $form->payment->submission_date : 'N/A' }}</td>
                        <!-- Add more columns as needed -->
                    </tr>
                @endforeach
            </tbody>
            <tfoot class="dark" style=" color:#1e3e54;">
             
                    <tr>
                      <td>Total Due Tax:</td>
                      <td> {{ $totalDueTax }}</td>
                    </tr>
                 
               
            </tfoot>
        </table>
        
</div>
@endsection
