@extends('Taxpayer.AnnualTaxForm')

@section('AppendixEleven')
@php
    // Check if form data exists
    $formData = \App\Models\AppendixEleven::where('user_id', auth()->id())->get();

@endphp
<div class="custom-container mt-5">
    <br>
    <h5 class="text-center custom-header">Appendix #11 Statement of Operations with Shareholders, Directors and Employees (other than normal operations)</h5>
    @if ($formData->isNotEmpty())
    <form action="{{ route('updateAppendixEleven') }}" method="POST">
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
        <table class="table table-bordered custom-header form-table" id="operations-table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Link Code</th>
                    <th>Batch</th>
                    <th>Refunds</th>
                    <th>Debit Account</th>
                    <th>Credit Account</th>
                    <th>Sold Assets</th>
                    <th>Purchased Assets</th>
                </tr>
            </thead>
            <tbody id="table-body">
                @foreach ($formData as $index => $data)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <input type="hidden" name="id[]" value="{{ $data->id }}">
                            <input type="text" name="link_code[]" class="form-control" value="{{ $data->link_code }}" oninput="checkInputs()">
                        </td>
                        <td>
                            <input type="text" name="batch[]" class="form-control" value="{{ $data->batch }}" oninput="checkInputs()">
                        </td>
                        <td>
                            <input type="text" name="refunds[]" class="form-control" value="{{ $data->refunds }}" oninput="checkInputs()">
                        </td>
                        <td>
                            <input type="text" name="debit_account[]" class="form-control" value="{{ $data->debit_account }}" oninput="checkInputs()">
                        </td>
                        <td>
                            <input type="text" name="credit_account[]" class="form-control" value="{{ $data->credit_account }}" oninput="checkInputs()">
                        </td>
                        <td>
                            <input type="text" name="sold_assets[]" class="form-control" value="{{ $data->sold_assets }}" oninput="checkInputs()">
                        </td>
                        <td>
                            <input type="text" name="purchased_assets[]" class="form-control" value="{{ $data->purchased_assets }}" oninput="checkInputs()">
                        </td>
                    </tr>
                @endforeach
                <tr class="footer-row">
                    <td>200</td>
                    <td colspan="5">Total</td>
                    <td><input type="text" id="total" name="total" class="form-control" value="{{ $formData->sum('total') ?? '' }}" readonly></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-info" id="prevButton">
            <a href="{{ route('appendix.show', ['number' => 10]) }}">Previous</a>
        </button>
        <button type="button" class="btn btn-info" id="prevButton">
            <a href="{{ route('appendix.show', ['number' => 12]) }}">Next</a>
        </button>
    </form>
    @else
    <form action="{{ route('AppendixEleven.store') }}" method="POST">
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
        <table class="table table-bordered custom-header form-table" id="operations-table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Link Code</th>
                    <th>Batch</th>
                    <th>Refunds</th>
                    <th>Debit Account</th>
                    <th>Credit Account</th>
                    <th>Sold Assets</th>
                    <th>Purchased Assets</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <tr>
                    <td>100</td>
                    <td><input type="text" name="link_code[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="batch[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="refunds[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="debit_account[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="credit_account[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="sold_assets[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="purchased_assets[]" class="form-control" oninput="checkInputs()"></td>
                </tr>
                <tr>
                    <td>120</td>
                    <td><input type="text" name="link_code[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="batch[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="refunds[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="debit_account[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="credit_account[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="sold_assets[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="purchased_assets[]" class="form-control" oninput="checkInputs()"></td>
                </tr>
                <tr class="footer-row">
                    <td>200</td>
                    <td colspan="5">Total</td>
                    <td><input type="text" id="total" name="total" class="form-control" readonly></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @endif
    <div class="note">
        <p><strong>Linked Code:</strong></p>
        <ul>
            <li>
                <small class="form-text text-muted mt-2">1- Shareholder</small>
            </li>
            <li>
                <small class="form-text text-muted mt-2">2- Manager</small>
            </li>
            <li>
                <small class="form-text text-muted mt-2">3- Employee</s>
            </li>
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
    }

    function addNewRow() {
        currentCode += 10;
        const tableBody = document.getElementById('table-body');
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td>${currentCode}</td>
            <td><input type="text" name="link_code[]" class="form-control" oninput="checkInputs()"></td>
            <td><input type="text" name="batch[]" class="form-control" oninput="checkInputs()"></td>
            <td><input type="text" name="refunds[]" class="form-control" oninput="checkInputs()"></td>
            <td><input type="text" name="debit_account[]" class="form-control" oninput="checkInputs()"></td>
            <td><input type="text" name="credit_account[]" class="form-control" oninput="checkInputs()"></td>
            <td><input type="text" name="sold_assets[]" class="form-control" oninput="checkInputs()"></td>
            <td><input type="text" name="purchased_assets[]" class="form-control" oninput="checkInputs()"></td>
        `;

        tableBody.insertBefore(newRow, tableBody.querySelector('.footer-row'));
    }
    function updateTotal() {
        // Get all sold_assets inputs
        const soldAssetsInputs = document.querySelectorAll('input[name="sold_assets[]"]');
        let total = 0;
    
        // Sum the values
        soldAssetsInputs.forEach(input => {
            const value = parseFloat(input.value);
            if (!isNaN(value)) {
                total += value;
            }
        });
    
        // Update the total field
        document.getElementById('total').value = total;
    }
    
    // Optionally, call updateTotal on page load to set the initial total value
    document.addEventListener('DOMContentLoaded', updateTotal);
</script>

    
@endsection
