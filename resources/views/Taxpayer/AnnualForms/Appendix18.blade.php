@extends('Taxpayer.AnnualTaxForm')

@section('AppendixEighteen')
<div class="custom-container mt-5">
    <br>
    <h5 class="custom-header">Appendix #18  Statement of Secondary Contractors</h5>
    <div class="table-container mt-4">
    <form action="{{route('AppendixEighteen.store')}}" method="POST">
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
            <thead >
                <tr>
                    <th>Code</th>
                    <th>Name of Secondary Contractor</th>
                    <th>Tax Number</th>
                    <th>Nationality</th>
                    <th>Total Contract Value</th>
                    <th>Amount Paid for the Current Year</th>
                </tr>
            </thead>
            <tbody id="table-body" style="background-color:#f1f1f1">
                <tr >
                    <td>100</td>        
                    <td><input type="text" name="name_secondry_contract[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="nationality[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="contract_value[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="amount_paid[]" class="form-control" oninput="checkInputs()"></td>
                </tr>
                <tr>
                    <td>120</td>
                    <td><input type="text" name="name_secondry_contract[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="nationality[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="contract_value[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="amount_paid[]" class="form-control" oninput="checkInputs()"></td>
                </tr>
                <tr>
                    <td>130</td>
                    <td><input type="text" name="name_secondry_contract[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="nationality[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="contract_value[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="amount_paid[]" class="form-control" oninput="checkInputs()"></td>
                </tr>
                <tr class="footer-row">
                    <td>200</td>
                    <td colspan="3">Total</td>
                    <td><input type="text" id="total_1" name="total_1" class="form-control" readonly></td>
                    <td><input type="text" id="total_2" name="total_2" class="form-control" readonly></td>
                </tr>
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
   
</div>
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
        const feeInputs = document.querySelectorAll('input[name="contract_value[]"]');
        const amountInputs = document.querySelectorAll('input[name="amount_paid[]"]');
        let totalFees = 0;
        let totalamount =0;

        feeInputs.forEach(input => {
            const fee = parseFloat(input.value) || 0; // Convert input value to float or default to 0
            totalFees += fee;
        });
        amountInputs.forEach(input => {
            const fee = parseFloat(input.value) || 0; // Convert input value to float or default to 0
            totalamount += fee;
        });

        document.getElementById('total_1').value = totalFees.toFixed(2); // Update total fees
        document.getElementById('total_2').value = totalamount.toFixed(2);
    }

    function addNewRow() {
        currentCode += 10;
        const tableBody = document.getElementById('table-body');
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td>${currentCode}</td>
            <td><input type="text" name="name_secondry_contract[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="nationality[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="contract_value[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="amount_paid[]" class="form-control" oninput="checkInputs()"></td>
        `;

        tableBody.insertBefore(newRow, tableBody.querySelector('.footer-row'));
    }
</script>

@endsection
