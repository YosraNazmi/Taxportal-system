@extends('Taxpayer.AnnualTaxForm')

@section('AppendixTwentyOne')
@php
    // Check if form data exists
    $formData = \App\Models\AppendixTwentyOne::where('user_id', auth()->id())->get();
@endphp
<div class="custom-container mt-5">
    <h5 class="custom-header">Appendix #21 Statement of Insurance Expenses</h5>
    @if ($formData->isNotEmpty())
    <form action="{{route('updateAppendixTwentyOne')}}" method="POST">
        @csrf
        @method('PUT')
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="table-container mt-4">
            <table class="custom-table table-bordered table form-table " id="operations-table">
                <thead >
                    <tr>
                        <th>code</th>
                        <th>Tax Number</th>
                        <th>The name of the insured company</th>
                        <th colspan="2">Insurance type</th>
                        <th>Insurance premiums for the current period</th>
                        <th >Allowed insurance premiums</th>
                        <th>Differences are not allowed</th>
                    </tr>
                    <tr>
                        <th colspan="3"></th>
                        <th>Local insurance</th>
                        <th>External insurance</th>
                        <th colspan="3"></th>
                        
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach ($formData as $index => $data)
                    <tr>
                        <td>100</td>
                        <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()" value="{{ $data->tax_number }}"></td>
                        <td><input type="text" name="name_of_insurance_company[]" class="form-control" oninput="checkInputs()" value="{{ $data->name_of_insurance_company }}"></td>
                        <td>
                            <input type="checkbox" name="local_insurance[]" value="1" {{ $data->local_insurance ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="checkbox" name="external_insurance[]" value="1" {{ $data->external_insurance ? 'checked' : '' }}>
                        </td>
                        <td><input type="number" name="insurance_current_period[]" class="form-control" oninput="checkInputs()" value="{{ $data->insurance_current_period }}"></td>
                        <td><input type="number" name="allowed_insurance_premiums[]" class="form-control" oninput="checkInputs()" value="{{ $data->allowed_insurance_premiums }}"></td>
                        <td><input type="number" id="difference_allowed" name="difference_allowed[]" class="form-control" readonly value="{{ $data->difference_allowed }}"></td>
                    </tr>
                    @endforeach                                      
                    
                    <!-- Add more rows as needed -->
                    <tr class="footer-row">
                        <td colspan="7" class="text-right total-cell">Total</td>
                        <td><input type="number" name="total_1" class="form-control" id="total_amount" value="{{ $formData->sum('total_1') ?? '' }}" readonly></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-info" id="prevButton">
                <a href="{{ route('appendix.show', ['number' => 20]) }}">Previous</a>
            </button>
            <button type="button" class="btn btn-info" id="prevButton">
                <a href="{{ route('appendix.show', ['number' => 22]) }}">Next</a>
            </button>
        </div>
        <br>
        <small class="form-text text-muted mt-2">
            * Enter the total amount on line 240 of the transition statement from the accounting result to the tax result
        </small>
        
    </form>
    @else
    <form action="{{ route('AppendixTwentyOne.store') }}" method="POST">
        @csrf
        <!-- Error and Success Messages -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    
        <!-- Table -->
        <div class="table-container mt-4">
            <table class="custom-table table-bordered table form-table" id="operations-table">
                <thead>
                    <tr>
                        <th>code</th>
                        <th>Tax Number</th>
                        <th>The name of the insured company</th>
                        <th colspan="2">Insurance type</th>
                        <th>Insurance premiums for the current period</th>
                        <th>Allowed insurance premiums</th>
                        <th>Differences are not allowed</th>
                    </tr>
                    <tr>
                        <th colspan="3"></th>
                        <th>Local insurance</th>
                        <th>External insurance</th>
                        <th colspan="3"></th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <!-- Sample Row -->
                    <tr>
                        <td>100</td>
                        <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="name_of_insurance_company[]" class="form-control" oninput="checkInputs()"></td>
                        <td>
                          
                            <input type="checkbox" name="local_insurance[]" value="1">
                        </td>
                        <td>
                            
                            <input type="checkbox" name="external_insurance[]" value="1">
                        </td>
                        <td><input type="number" name="insurance_current_period[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="allowed_insurance_premiums[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" id="difference_allowed" name="difference_allowed[]" class="form-control" readonly></td>
                    </tr>
                    <!-- Repeat similar rows for entries 2 to 5 -->
                    <tr>
                        <td>110</td>
                        <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="name_of_insurance_company[]" class="form-control" oninput="checkInputs()"></td>
                        <td>
                          
                            <input type="checkbox" name="local_insurance[]" value="1">
                        </td>
                        <td>
                           
                            <input type="checkbox" name="external_insurance[]" value="1">
                        </td>
                        <td><input type="number" name="insurance_current_period[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="allowed_insurance_premiums[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" id="difference_allowed" name="difference_allowed[]" class="form-control" readonly></td>
                    </tr>
                    <!-- Add more rows as needed -->
                    <tr class="footer-row">
                        <td colspan="7" class="text-right total-cell">Total</td>
                        <td><input type="number" name="total_1" class="form-control" id="total_amount" readonly></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-info" id="prevButton">
                <a href="{{ route('appendix.show', ['number' => 20]) }}">Previous</a>
            </button>
        </div>
        <small class="form-text text-muted mt-2">
            * Enter the total amount on line 240 of the transition statement from the accounting result to the tax result
        </small>
    </form>
    
    @endif
</div>

<script>
    let currentCode = 120;

    function checkInputs() {
        const rows = document.querySelectorAll('#table-body tr');
        const lastRow = rows[rows.length - 2]; // exclude the total row
        const inputs = lastRow.querySelectorAll('input[type="text"], input[type="number"], input[type="date"]');
        let allFilled = true;

        inputs.forEach(input => {
            if (input.value.trim() === '') {
                allFilled = false;
            }
        });

        if (allFilled) {
            addNewRow();
        }

        calculateDifference();
        calculateTotalAmount();
    }

    function calculateTotalAmount() {
        const amountInputs = document.querySelectorAll('input[name="difference_allowed[]"]');
        let totalAmount = 0;

        amountInputs.forEach(input => {
            const amount = parseFloat(input.value) || 0;
            totalAmount += amount;
        });

        document.getElementById('total_amount').value = totalAmount.toFixed(2);
    }

    function calculateDifference() {
        const rows = document.querySelectorAll('#table-body tr:not(.footer-row)');
        rows.forEach(row => {
            const insuranceCurrentPeriodInput = row.querySelector('input[name="insurance_current_period[]"]');
            const allowedInsurancePremiumsInput = row.querySelector('input[name="allowed_insurance_premiums[]"]');
            const differenceAllowedInput = row.querySelector('input[name="difference_allowed[]"]');

            if (insuranceCurrentPeriodInput && allowedInsurancePremiumsInput && differenceAllowedInput) {
                const insuranceCurrentPeriod = parseFloat(insuranceCurrentPeriodInput.value) || 0;
                const allowedInsurancePremiums = parseFloat(allowedInsurancePremiumsInput.value) || 0;
                const totalDifference = insuranceCurrentPeriod + allowedInsurancePremiums;

                differenceAllowedInput.value = totalDifference.toFixed(2);
            }
        });
    }

    function addNewRow() {
        currentCode += 10;
        const tableBody = document.getElementById('table-body');
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td>${currentCode}</td>
            <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
            <td><input type="text" name="name_of_insurance_company[]" class="form-control" oninput="checkInputs()"></td>
            <td class="text-center">
                <div class="form-check">
                    <input class="form-check-input" type="hidden" name="local_insurance[]" value="0">
                    <input class="form-check-input" type="checkbox" name="local_insurance[]" value="1">
                </div>
            </td>
            <td class="text-center">
                <div class="form-check">
                    <input class="form-check-input" type="hidden" name="external_insurance[]" value="0">
                    <input class="form-check-input" type="checkbox" name="external_insurance[]" value="1">
                </div>
            </td>
            <td><input type="number" name="insurance_current_period[]" class="form-control" oninput="checkInputs()"></td>
            <td><input type="number" name="allowed_insurance_premiums[]" class="form-control" oninput="checkInputs()"></td>
            <td><input type="number" name="difference_allowed[]" class="form-control" readonly></td>
        `;

        tableBody.insertBefore(newRow, tableBody.querySelector('.footer-row'));
    }

    // Call checkInputs on page load to initialize
    document.addEventListener('DOMContentLoaded', () => {
        checkInputs();
    });

</script>


@endsection
