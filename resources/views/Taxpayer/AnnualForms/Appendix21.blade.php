@extends('Taxpayer.AnnualTaxForm')

@section('AppendixTwentyOne')
<div class="custom-container mt-5">
    <h5 class="custom-header">Appendix #21 Statement of Insurance Expenses</h5>
    <form action="{{route('AppendixTwentyOne.store')}}" method="POST">
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
                    <tr>
                        <td>100</td>
                        <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="name_of_insurance_company[]" class="form-control" oninput="checkInputs()"></td>
                        <td class="text-center">
                            <div class="form-check">
                                <input class="form-check-input"type="checkbox" name="local_insurance[]" id="incomeYes1" value="yes">
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="external_insurance[]" id="collectYes1" value="yes">    
                            </div>
                        </td>
                        <td><input type="number" id="insurance_curernt_period" name="insurance_curernt_period[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" id="allowed_insurance_premiums" name="allowed_insurance_premiums[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" id="diiference_allowed" name="diiference_allowed[]" class="form-control" oninput="checkInputs()" readonly></td>
                    </tr>
                    <!-- Repeat similar rows for entries 2 to 5 -->
                    <tr>
                        <td>110</td>
                        <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="name_of_insurance_company[]" class="form-control" oninput="checkInputs()"></td>
                        <td class="text-center">
                            <div class="form-check">
                                <input class="form-check-input"type="checkbox" name="local_insurance[]" id="incomeYes1" value="yes">
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="external_insurance[]" id="collectYes1" value="yes">    
                            </div>
                        </td>
                        <td><input type="number" id="insurance_curernt_period" name="insurance_curernt_period[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" id="allowed_insurance_premiums" name="allowed_insurance_premiums[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" id="diiference_allowed" name="diiference_allowed[]" class="form-control" oninput="checkInputs()" readonly></td>
                    </tr>
                    <!-- Add more rows as needed -->
                    <tr class="footer-row">
                        <td colspan="7" class="text-right total-cell">Total</td>
                        <td><input type="number" name="total_1" class="form-control" id="total_amount" readonly></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <small class="form-text text-muted mt-2">
            * Enter the total amount on line 240 of the transition statement from the accounting result to the tax result
        </small>
        
    </form>
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

        calculateDiiference();
        calculateTotalAmount();
    }

    function calculateTotalAmount() {
        const amountInputs = document.querySelectorAll('input[name="diiference_allowed[]"]');
        let totalAmount = 0;

        amountInputs.forEach(input => {
            const amount = parseFloat(input.value) || 0;
            totalAmount += amount;
        });

        document.getElementById('total_amount').value = totalAmount.toFixed(2);
    }

    function calculateDiiference() {
        const rows = document.querySelectorAll('#table-body tr:not(.footer-row)');
        rows.forEach(row => {
            const insuranceCurerntPeriodInput = row.querySelector('input[name="insurance_curernt_period[]"]');
            const allowedInsurancePremiumsInput = row.querySelector('input[name="allowed_insurance_premiums[]"]');
            const diiferenceAllowedInput = row.querySelector('input[name="diiference_allowed[]"]');
            
            if (insuranceCurerntPeriodInput && allowedInsurancePremiumsInput && diiferenceAllowedInput) {
                const insuranceCurerntPeriod = parseFloat(insuranceCurerntPeriodInput.value) || 0;
                const allowedInsurancePremiums = parseFloat(allowedInsurancePremiumsInput.value) || 0;
                const totalDiiference = insuranceCurerntPeriod + allowedInsurancePremiums;

                diiferenceAllowedInput.value = totalDiiference.toFixed(2);
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
                    <input class="form-check-input" type="checkbox" name="local_insurance[]" value="yes">
                </div>
            </td>
            <td class="text-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="external_insurance[]" value="yes">
                </div>
            </td>
            <td><input type="number" name="insurance_curernt_period[]" class="form-control" oninput="checkInputs()"></td>
            <td><input type="number" name="allowed_insurance_premiums[]" class="form-control" oninput="checkInputs()"></td>
            <td><input type="number" name="diiference_allowed[]" class="form-control" readonly></td>
        `;

        tableBody.insertBefore(newRow, tableBody.querySelector('.footer-row'));
    }
</script>


@endsection
