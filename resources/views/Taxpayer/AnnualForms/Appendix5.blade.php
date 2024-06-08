@extends('Taxpayer.AnnualTaxForm')

@section('AppendixFive')
<div class="custom-container mt-5">
    <form action="{{route('AppendixFive.store')}}" method="POST">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Display success message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <br>
        <h5 class="text-center custom-header">Appendix #5 Statement of Company Information after Consolidation or Liquidation</h5>
        
        <h6 class="custom-header-2">When Submitting the Tax Declaration for the First Year after the Merger:</h6>
        <table id="mergerTable" class="table table-bordered custom-table">
            <thead>
                <tr>
                    <th>Tax Number</th>
                    <th>Name of Previous Companies</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="tax_number_merge[]" class="form-control"></td>
                    <td><input type="text" name="previous_company[]" class="form-control"></td>
                </tr>
                <tr>
                    <td><input type="text" name="tax_number_merge[]" class="form-control"></td>
                    <td><input type="text" name="previous_company[]" class="form-control"></td>
                </tr>
            </tbody>
        </table>
        
        <h6 class="custom-header-2">When the Company Submits a Tax Declaration for the First Year after the Liquidation Process:</h6>
        <table id="liquidationTable" class="table table-bordered custom-table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name of the Liquidated Companies</th>
                    <th>Tax Number</th>
                    <th>Date of Start of Liquidation (Day, Month, Year)</th>
                    <th>Date of Completion of Liquidation (Day, Month, Year)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>100</td>
                    <td><input type="text" name="Liquidated_company_name[]" class="form-control"></td>
                    <td><input type="text" name="tax_number_liquidation[]" class="form-control"></td>
                    <td><input type="date" name="start_date_liquidation[]" class="form-control"></td>
                    <td><input type="date" name="end_date_liquidation[]" class="form-control"></td>
                </tr>
                <tr>
                    <td>110</td>
                    <td><input type="text" name="Liquidated_company_name[]" class="form-control"></td>
                    <td><input type="text" name="tax_number_liquidation[]" class="form-control"></td>
                    <td><input type="date" name="start_date_liquidation[]" class="form-control"></td>
                    <td><input type="date" name="end_date_liquidation[]" class="form-control"></td>
                </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Submit</button>
        <br>
    </form>
    
</div>

<script>
    // Function to add a new row to the merger table
    document.getElementById('mergerTable').querySelector('tbody').lastElementChild.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', function() {
            // Check if both inputs in the last row are filled
            const lastRowInputs = Array.from(document.querySelectorAll('#mergerTable input')).slice(-2);
            const isFilled = lastRowInputs.every(input => input.value.trim() !== '');
            if (isFilled) {
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td><input type="text" name="tax_number_merge[]" class="form-control"></td>
                    <td><input type="text" name="previous_company[]" class="form-control"></td>
                `;
                document.getElementById('mergerTable').querySelector('tbody').appendChild(newRow);
            }
        });
    });

    // Function to add a new row to the liquidation table
    document.getElementById('liquidationTable').querySelector('tbody').lastElementChild.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', function() {
            // Check if all inputs in the last row are filled
            const lastRowInputs = Array.from(document.querySelectorAll('#liquidationTable input')).slice(-4);
            const isFilled = lastRowInputs.every(input => input.value.trim() !== '');
            if (isFilled) {
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>110</td>
                    <td><input type="text" name="Liquidated_company_name[]" class="form-control"></td>
                    <td><input type="text" name="tax_number[]" class="form-control"></td>
                    <td><input type="text" name="start_date_liquidation[]" class="form-control"></td>
                    <td><input type="text" name="end_date_liquidation[]" class="form-control"></td>
                `;
                document.getElementById('liquidationTable').querySelector('tbody').appendChild(newRow);
            }
        });
    });
</script>

@endsection


