@extends('Taxpayer.AnnualTaxForm')

@section('AppendixNineteen')
<div class="custom-container mt-5">
    <h5 class="custom-header">Appendix #19 Statement of Bad Debts </h5>
    <form action="{{route('AppendixNineteen.store')}}" method="POST">
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

        <div class="form-group">
            <label for="badDebtAmount">Amount of Bad Debt According to Income Statement:</label>
            <input  type="number" class="form-control" name="amount_of_bad_debit" id="badDebtAmount" placeholder="Enter amount">
        </div>
        <small class="form-text text-muted">
            * Enter the amount in line 190 of the statement of transition from the accounting result to the tax result
        </small>
        <br>
            <table class="custom-table table-bordered table form-table" id="operations-table">
                <thead >
                    <tr>
                        <th>code</th>
                        <th>Tax Number</th>
                        <th>Name of the Debtor</th>
                        <th>The Amount of Bad Debt</th>
                        <th>Date of Debt Existence (Day, Month, Year)</th>
                        <th colspan="2">Availability of Legal Conditions</th>
                        <th>Amount Allowed When Legal Conditions are Available</th>
                    </tr>
                    <tr>
                        <th colspan="5"></th>
                        <th>Was it included in the previous income?</th>
                        <th>Has all means been taken to collect it?</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <tr>
                        <td>1</td>
                        <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="name_of_debtor[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="amount_of_bad_debt[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="date" name="date_of_debt[]" class="form-control" oninput="checkInputs()"></td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input"type="checkbox" name="was_included_in_previous_income[]" id="incomeYes1" value="1">
                                <label class="form-check-label" for="incomeYes1">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="was_included_in_previous_income[]" id="incomeNo1" value="0">
                                <label class="form-check-label" for="incomeNo1">No</label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="has_all_means_been_taken[]" id="collectYes1" value="1">
                                <label class="form-check-label" for="collectYes1">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="has_all_means_been_taken[]" id="collectNo1" value="0">
                                <label class="form-check-label" for="collectNo1">No</label>
                            </div>
                        </td>
                        <td><input type="number" name="amount_allowed[]" class="form-control" oninput="checkInputs()"></td>
                    </tr>
                    <!-- Repeat similar rows for entries 2 to 5 -->
                    <tr>
                        <td>2</td>
                        <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="name_of_debtor[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="amount_of_bad_debt[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="date" name="date_of_debt[]" class="form-control" oninput="checkInputs()"></td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input"type="checkbox" name="was_included_in_previous_income[]" id="incomeYes1" value="1">
                                <label class="form-check-label" for="incomeYes1">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="was_included_in_previous_income[]" id="incomeNo1" value="0">
                                <label class="form-check-label" for="incomeNo1">No</label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="has_all_means_been_taken[]" id="collectYes1" value="1">
                                <label class="form-check-label" for="collectYes1">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="has_all_means_been_taken[]" id="collectNo1" value="0">
                                <label class="form-check-label" for="collectNo1">No</label>
                            </div>
                        </td>
                        <td><input type="number" name="amount_allowed[]" class="form-control" oninput="checkInputs()"></td>
                    </tr>
                    <!-- Add more rows as needed -->
                    <tr class="footer-row">
                        <td colspan="7" class="text-right total-cell">Total</td>
                        <td><input type="number" name="total_1" class="form-control" id="total_amount" readonly></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Submit</button>
     
        <small class="form-text text-muted mt-2">
            ** Enter the total amount in line 420 of the statement of transition from the accounting result to the tax result
        </small>
      <br>  
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

        calculateTotalAmount();
    }

    function calculateTotalAmount() {
        const amountInputs = document.querySelectorAll('input[name="amount_allowed[]"]');
        let totalAmount = 0;

        amountInputs.forEach(input => {
            const amount = parseFloat(input.value) || 0;
            totalAmount += amount;
        });

        document.getElementById('total_amount').value = totalAmount.toFixed(2);
    }

    function addNewRow() {
        currentCode += 10;
        const tableBody = document.getElementById('table-body');
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td>${currentCode}</td>
                        <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="name_of_debtor[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="amount_of_bad_debt[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="date" name="date_of_debt[]" class="form-control" oninput="checkInputs()"></td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input"type="checkbox" name="was_included_in_previous_income[]" id="incomeYes1" value="1">
                                <label class="form-check-label" for="incomeYes1">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="was_included_in_previous_income[]" id="incomeNo1" value="0">
                                <label class="form-check-label" for="incomeNo1">No</label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="has_all_means_been_taken[]" id="collectYes1" value="1">
                                <label class="form-check-label" for="collectYes1">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="has_all_means_been_taken[]" id="collectNo1" value="0">
                                <label class="form-check-label" for="collectNo1">No</label>
                            </div>
                        </td>
                        <td><input type="number" name="amount_avaible[]" class="form-control" oninput="checkInputs()"></td>
                    
        `;

        tableBody.insertBefore(newRow, tableBody.querySelector('.footer-row'));
    }
</script>
@endsection
