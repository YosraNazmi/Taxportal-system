@extends('Taxpayer.AnnualTaxForm')

@section('AppendixTwentyThree')
<div class="custom-container mt-5">
    <h5 class="custom-header">Appendix #23 Statement of bank interest</h5>
    <form action="{{route('AppendixTwentyThree.store')}}" method="POST">
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
                <thead>
                    <tr>
                        <th>code</th>
                        <th>The Value of Bank interest</th>
                        <th>Allowed Bank Value</th>
                        <th>Capital interest is not permitted</th>
                        <th>Other bank interest is not allowed</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <tr>
                        <td>100</td>
                        <td><input type="number" name="bank_interest[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="allowed_bank_value[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="capital_interest[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="other_bank_interest_[]" class="form-control" oninput="checkInputs()"></td>
                    </tr>
                    <tr>
                        <td>110</td>
                        <td><input type="number" name="bank_interest[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="allowed_bank_value[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="capital_interest[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="other_bank_interest_[]" class="form-control" oninput="checkInputs()"></td>
                    </tr>
                    <tr>
                        <td>120</td>
                        <td><input type="number" name="bank_interest[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="allowed_bank_value[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="capital_interest[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="other_bank_interest_[]" class="form-control" oninput="checkInputs()"></td>
                    </tr>
                    <!-- Add more rows as needed -->
                    <tr class="footer-row">
                        <td colspan="1" class="text-right total-cell">200 Total</td>
                        <td><input type="number" name="total_1" class="form-control" id="total_amount1" readonly></td>
                        <td><input type="number" name="total_2" class="form-control" id="total_amount2" readonly></td>
                        <td><input type="number" name="total_3" class="form-control" id="total_amount3" readonly></td>
                        <td><input type="number" name="total_4" class="form-control" id="total_amount4" readonly></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <small class="form-text text-muted mt-2">
            ** Enter the total amount in line 270 of the statement of transition from the accounting result to the tax result
        </small>
    </form>
</div>

<script>
    let currentCode = 120;

    function checkInputs() {
        const tableBody = document.getElementById('table-body');
        const lastRow = tableBody.lastElementChild.previousElementSibling;
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
            <td><input type="text" name="bank_interest[]" class="form-control" oninput="checkInputs()"></td>
            <td><input type="number" name="allowed_bank_value[]" class="form-control" oninput="checkInputs()"></td>
            <td><input type="number" name="capital_interest[]" class="form-control" oninput="checkInputs()"></td>
            <td><input type="number" name="other_bank_interest_[]" class="form-control" oninput="checkInputs()"></td>
        `;
        tableBody.insertBefore(newRow, tableBody.lastElementChild);
    }

    function calculateTotalAmount() {
        const bankInterestInputs = document.querySelectorAll('input[name="bank_interest[]"]');
        const allowedBankValueInputs = document.querySelectorAll('input[name="allowed_bank_value[]"]');
        const capitalInterestInputs = document.querySelectorAll('input[name="capital_interest[]"]');
        const otherBankInputs = document.querySelectorAll('input[name="other_bank_interest_[]"]');

        let totalbankInterest = 0;
        let totalallowedBankValue = 0;
        let totalcapitalInterest = 0;
        let totalotherBank = 0;

        bankInterestInputs.forEach(input => {
            const amount = parseFloat(input.value) || 0;
            totalbankInterest += amount;
        });
        allowedBankValueInputs.forEach(input => {
            const amount = parseFloat(input.value) || 0;
            totalallowedBankValue += amount;
        });
        capitalInterestInputs.forEach(input => {
            const amount = parseFloat(input.value) || 0;
            totalcapitalInterest += amount;
        });
        otherBankInputs.forEach(input => {
            const amount = parseFloat(input.value) || 0;
            totalotherBank += amount;
        });

        document.getElementById('total_amount1').value = totalbankInterest.toFixed(2);
        document.getElementById('total_amount2').value = totalallowedBankValue.toFixed(2);
        document.getElementById('total_amount3').value = totalcapitalInterest.toFixed(2);
        document.getElementById('total_amount4').value = totalotherBank.toFixed(2);
    }
</script>
@endsection
