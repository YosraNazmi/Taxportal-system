@extends('Taxpayer.AnnualTaxForm')

@section('AppendixTwentySeven')
<div class="custom-container mt-5">
    <h5 class="custom-header">Appendix #27 Statement of tax withhold from transactions during the tax year</h5>
    <form action="{{route('AppendixTwentySeven.store')}}" method="POST">
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
            <table  class="custom-table table-bordered table form-table " id="operations-table">
                <thead>
                    <tr>
                        <th>code</th>
                        <th>The Name of the entity makeing the deduction</th>
                        <th>Tax Number</th>
                        <th>Date of deduction</th>
                        <th colspan="2">Arrived bill</th>
                        <th>The amount of withheld tax</th>
                        <th>Notes</th>
                    </tr>
                    <tr>
                        <th colspan="4"></th>
                        <th>Number</th>
                        <th>Date</th>
                        <th colspan="2"></th>
                    </tr>

                </thead>
                <tbody id="table-body">
                    <tr>
                        <td>100</td>
                        <td><input type="text" name="deduction_entity[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="date" name="date_of_deduction[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="number[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="date" name="date[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="amount_of_withheld_tax[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="notes[]" class="form-control" oninput="checkInputs()"></td>
                    </tr>
                    <tr>
                        <td>110</td>
                        <td><input type="text" name="deduction_entity[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="date" name="date_of_deduction[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="number[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="date" name="date[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="amount_of_withheld_tax[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="notes[]" class="form-control" oninput="checkInputs()"></td>
                    </tr>
                    <tr>

                        <td>120</td>
                        <td><input type="text" name="deduction_entity[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="date" name="date_of_deduction[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="number[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="date" name="date[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="amount_of_withheld_tax[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="notes[]" class="form-control" oninput="checkInputs()"></td>
                    </tr>
                    <!-- Add more rows as needed -->
                    <tr class="footer-row">
                        <td colspan="6" class="text-right total-cell">200 Total</td>
                        <td><input type="number" name="total_1" class="form-control" id="total_amount1" readonly></td>
                        <td colspan="3" class="text-right total-cell"></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<script>
    let currentCode = 120;

    function checkInputs() {
        const tableBody = document.getElementById('table-body');
        const lastRow = tableBody.rows[tableBody.rows.length - 2];
        const inputs = lastRow.querySelectorAll('input[type="text"], input[type="number"]');
        let allFilled = true;

        inputs.forEach(input => {
            if (input.value === '') {
                allFilled = false;
            }
        });

        if (allFilled) {
            addNewRow();
        }

        calculateTotalAmount();
    }

    function addNewRow() {
        currentCode += 10;
        const tableBody = document.getElementById('table-body');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>${currentCode}</td>
            <td><input type="text" name="deduction_entity[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="date" name="date_of_deduction[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="number[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="date" name="date[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="amount_of_withheld_tax[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="notes[]" class="form-control" oninput="checkInputs()"></td>
        `;
        tableBody.insertBefore(newRow, tableBody.lastElementChild);
    }

    function calculateTotalAmount() {
        const unallowedValueInputs = document.querySelectorAll('input[name="amount_of_withheld_tax[]"]');

        let totalUnallowedValue = 0;

        unallowedValueInputs.forEach(input => {
            const amount = parseFloat(input.value) || 0;
            totalUnallowedValue += amount;
        });

        document.getElementById('total_amount1').value = totalUnallowedValue.toFixed(2);
    }
</script>
@endsection
