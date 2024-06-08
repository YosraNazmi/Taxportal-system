@extends('Taxpayer.AnnualTaxForm')

@section('AppendixFifteen')
<div class="custom-container mt-5">
    <br>
    <h5 class="custom-header">Appendix #15 Statement of Fees and Administrative Expenses and Similar Amounts of Companies Resident in Kurdistan	</h5>
    <form action="{{route('AppendixFifteen.store')}}" method="POST">
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
        <table class="table table-bordered custom-table form-table " id="operations-table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Tax Number</th>
                    <th>Company Name</th>
                    <th>Fees</th>
                    <th>Administrative Expenses</th>
                    <th>Research, development and consulting expenses</th>
                    <th>Technical Assistance Expenditure</th>
                    <th>Similar Amounts</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <tr>
                    <td>100</td>
                    <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="company_name[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="fees[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="admin_expenses[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="research_development_expenses[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="technical_assistance[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="similar_amounts[]" class="form-control" oninput="checkInputs()"></td>
                </tr>
                <tr>
                    <td>120</td>
                    <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="company_name[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="fees[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="admin_expenses[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="research_development_expenses[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="technical_assistance[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="similar_amounts[]" class="form-control" oninput="checkInputs()"></td>
                </tr>
                <tr>
                    <td>130</td>
                    <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="company_name[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="fees[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="admin_expenses[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="research_development_expenses[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="technical_assistance[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="similar_amounts[]" class="form-control" oninput="checkInputs()"></td>
                </tr>
                <tr class="footer-row">
                    <td>200 Total</td>
                    <td></td>
                    <td></td>
                    <td><input type="text" id="total_1" name="total_1" class="form-control" readonly></td>
                    <td><input type="text" id="total_2" name="total_2" class="form-control" readonly></td>
                    <td><input type="text" id="total_3" name="total_3" class="form-control" readonly></td>
                    <td><input type="text" id="total_4" name="total_4" class="form-control" readonly></td>
                    <td><input type="text" id="total_5" name="total_5" class="form-control" readonly></td>
                </tr>
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <br>
</div>

<script>
    let currentCode = 120;

    function checkInputs() {
    const rows = document.querySelectorAll('#operations-table tbody tr');
    const lastRow = rows[rows.length - 2]; // exclude the total row
    const inputs = lastRow.querySelectorAll('input[type="text"]');
    let allFilled = true;

    inputs.forEach(input => {
        if (input.value.trim() === '') {
            allFilled = false;
        }
    });

    if (allFilled) {
        addNewRow();
    }

    // Recalculate total fees
    calculateTotalFees();
}

function calculateTotalFees() {
    const feeInputs = document.querySelectorAll('input[name="fees[]"]');
    const adminExpendInput = document.querySelectorAll('input[name="admin_expenses[]"]');
    const researchDevelopmentExpenses = document.querySelectorAll('input[name="research_development_expenses[]"]');
    const technicalAssistance = document.querySelectorAll('input[name="technical_assistance[]"]');
    const similarAmounts = document.querySelectorAll('input[name="similar_amounts[]"]');
    let totalFees = 0;
    let totaladminExpendInput =0;
    let totalresearchDevelopmentExpenses =0;
    let totaltechnicalAssistance=0;
    let totalsimilarAmounts =0;

    feeInputs.forEach(input => {
        const fee = parseFloat(input.value) || 0; // Convert input value to float or default to 0
        totalFees += fee;
    });
    adminExpendInput.forEach(input => {
        const fee = parseFloat(input.value) || 0; // Convert input value to float or default to 0
        totaladminExpendInput += fee;
    });
    researchDevelopmentExpenses.forEach(input => {
        const fee = parseFloat(input.value) || 0; // Convert input value to float or default to 0
        totalresearchDevelopmentExpenses += fee;
    });
    technicalAssistance.forEach(input => {
        const fee = parseFloat(input.value) || 0; // Convert input value to float or default to 0
        totaltechnicalAssistance += fee;
    });
    similarAmounts.forEach(input => {
        const fee = parseFloat(input.value) || 0; // Convert input value to float or default to 0
        totalsimilarAmounts += fee;
    });

    // Display the total fees in the total_1 input field
    document.getElementById('total_1').value = totalFees.toFixed(2); 
    // Display the total fees in the total_1 input field
    document.getElementById('total_2').value = totaladminExpendInput.toFixed(2); 
    // Display the total fees in the total_1 input field
    document.getElementById('total_3').value = totalresearchDevelopmentExpenses.toFixed(2); 
    // Display the total fees in the total_1 input field
    document.getElementById('total_4').value = totaltechnicalAssistance.toFixed(2); // Display the total with 2 decimal places
    // Display the total fees in the total_1 input field
    document.getElementById('total_5').value = totalsimilarAmounts.toFixed(2); 
}

    function addNewRow() {
        currentCode += 10;
        const tableBody = document.getElementById('table-body');
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td>${currentCode}</td>
            <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="company_name[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="fees[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="admin_expenses[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="research_development_expenses[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="technical_assistance[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="similar_amounts[]" class="form-control" oninput="checkInputs()"></td>
        `;

        tableBody.insertBefore(newRow, tableBody.querySelector('.footer-row'));
    }
</script>

@endsection
