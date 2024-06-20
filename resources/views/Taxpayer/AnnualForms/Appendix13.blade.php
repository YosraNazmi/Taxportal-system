@extends('Taxpayer.AnnualTaxForm')

@section('AppendixThirteen')
@php
    // Check if form data exists
    $formData = \App\Models\AppendixThirteen::where('user_id', auth()->id())->get();

@endphp
<div class="custom-container mt-5">
    <br>
    <h5 class="text-center custom-header form-table">Appendix #13 Statement of Sales and Purchases with Interrelated Companies</h5>
    @if ($formData->isNotEmpty())
    <form action="{{route('updateAppendixThirteen')}}" method="POST">
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
                @foreach ($formData as $index => $data)
                <tr>
                    <td>100</td>
                    <td><input type="text" name="link_code[]" class="form-control" oninput="checkInputs()" value="{{ $data->link_code }}"></td>
                    <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()" value="{{ $data->tax_number }}"></td>
                    <td><input type="text" name="net_commercial_sales[]" class="form-control" oninput="checkInputs()" value="{{ $data->net_commercial_sales }}"></td>
                    <td><input type="text" name="net_commercial_purchase[]" class="form-control" oninput="checkInputs()" value="{{ $data->net_commercial_purchase }}"></td>
                    <td><input type="text" name="debit_account[]" class="form-control" oninput="checkInputs()" value="{{ $data->debit_account }}"></td>
                    <td><input type="text" name="credit_account[]" class="form-control" oninput="checkInputs()" value="{{ $data->credit_account }}"></td>
                </tr>
                @endforeach
                <tr class="footer-row">
                    <td>200</td>
                    <td colspan="4">Total</td>
                    <td><input type="text" id="total" name="total" class="form-control" value="{{ $formData->sum('total') ?? '' }} "readonly></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-info" id="prevButton">
            <a href="{{ route('appendix.show', ['number' => 12]) }}">Previous</a>
        </button>
        <button type="button" class="btn btn-info" id="prevButton">
            <a href="{{ route('appendix.show', ['number' => 14]) }}">Next</a>
        </button>
    </form>
    @else
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
        <button type="button" class="btn btn-info" id="prevButton">
            <a href="{{ route('appendix.show', ['number' => 12]) }}">Previous</a>
        </button>
    </form>
    @endif
    <div class="note">
        <p><strong>Linked Code:</strong></p>
        <ul>
            <li><small class="form-text text-muted mt-2">1- Parent Company</small></li>
            <li><small class="form-text text-muted mt-2">2- Sister Company</small></li>
            <li><small class="form-text text-muted mt-2">3- Investment in a Company</small></li>
        </ul>
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

        // Update the total whenever inputs are checked
        updateTotal();
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

    function updateTotal() {
        // Get all debit_account inputs
        const debitAccountInputs = document.querySelectorAll('input[name="debit_account[]"]');
        let total = 0;
    
        // Sum the values
        debitAccountInputs.forEach(input => {
            const value = parseFloat(input.value);
            if (!isNaN(value)) {
                total += value;
            }
        });
    
        // Update the total field
        document.getElementById('total').value = total.toFixed(2); // Fixed to 2 decimal places
    }
    
    // Optionally, call updateTotal on page load to set the initial total value
    document.addEventListener('DOMContentLoaded', updateTotal);
</script>

@endsection
