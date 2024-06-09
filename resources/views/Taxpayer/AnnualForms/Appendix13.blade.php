@extends('Taxpayer.AnnualTaxForm')

@section('AppendixThirteen')
<div class="custom-container mt-5">
    <br>
    <h5 class="text-center custom-header form-table">Appendix #13 Statement of Sales and Purchases with Interrelated Companies						</h5>
    <form action="{{route('AppendixThirteen.store')}}" method="POST">
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
        <table class="table table-bordered custom-header" id="operations-table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Linked Code</th>
                    <th>Tax Number</th>
                    <th>Net Commercial Sales</th>
                    <th>Net Commercial Purchases</th>
                    <th>Debit Account</th>
                    <th>Credit Account</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <tr>
                    <td>100</td>
                    <td><input type="text" name="link_code[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="net_commercial_sales[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="net_commercial_purchase[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="debit_account[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="credit_account[]" class="form-control" oninput="checkInputs()"></td>
                </tr>
                <tr>
                    <td>120</td>
                    <td><input type="text" name="link_code[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="net_commercial_sales[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="net_commercial_purchase[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="debit_account[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="credit_account[]" class="form-control" oninput="checkInputs()"></td>
                </tr>
                <tr class="footer-row">
                    <td>200</td>
                    <td colspan="4">Total</td>
                    <td><input type="text" id="total" name="total" class="form-control" readonly></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <div class="note">
        <p><strong>Linked Code:</strong></p>
        <small class="form-text text-muted mt-2">1- Parent Company</small>
        <small class="form-text text-muted mt-2">2- Sister Company</small>
        <small class="form-text text-muted mt-2">3- Investment in a Company</small>
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
    }

    function addNewRow() {
        currentCode += 10;
        const tableBody = document.getElementById('table-body');
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td>${currentCode}</td>
            <td><input type="text" name="link_code[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="net_commercial_sales[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="net_commercial_purchase[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="debit_account[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="credit_account[]" class="form-control" oninput="checkInputs()"></td>
        `;

        tableBody.insertBefore(newRow, tableBody.querySelector('.footer-row'));
    }
</script>

@endsection
