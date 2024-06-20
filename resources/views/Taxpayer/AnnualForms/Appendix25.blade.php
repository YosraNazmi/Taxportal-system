@extends('Taxpayer.AnnualTaxForm')

@section('AppendixTwentyFive')
@php
    // Check if form data exists
    $formData = \App\Models\AppendixTwentyFive::where('user_id', auth()->id())->get();
@endphp
<div class="custom-container mt-5">
    <h5 class="custom-header">Appendix #25 Statement of Dividend Distribution</h5>
    @if ($formData->isNotEmpty() )
    <form action="{{route('updateAppendixTwentyFive')}}" method="POST">
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
        <small class="form-text text-muted mt-2">
            Total Profit Recieved
        </small>
        <div class="table-container mt-4">
            <table  class="custom-table table-bordered table form-table "  id="operations-table">
                <thead >
                    <tr>
                        <th>code</th>
                        <th>Tax Number</th>
                        <th>Company Name</th>
                        <th>Nationality</th>
                        <th>The Currency</th>
                        <th>The Value</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach ($formData as $index => $data)
                    <tr>
                        <td>100</td>
                        <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()" value="{{ $data->tax_number }}"></td>
                        <td><input type="text" name="company_name[]" class="form-control" oninput="checkInputs()" value="{{ $data->company_name }}"></td>
                        <td><input type="text" name="nationality[]" class="form-control" oninput="checkInputs()"value="{{ $data->nationality }}"></td>
                        <td><input type="number" name="currency[]" class="form-control" oninput="checkInputs()" value="{{ $data->currency }}"></td>
                        <td><input type="number" name="value[]" class="form-control" oninput="checkInputs()" value="{{ $data->value }}"></td>
                      
                    </tr>
                    @endforeach
                    <!-- Add more rows as needed -->
                    <tr class="footer-row">
                        <td colspan="5" class="text-right total-cell">200 Total</td>
                        <td><input type="number" name="total_1" class="form-control" id="total_amount1" value="{{ $formData->sum('total_1') ?? '' }}" readonly></td>
                        
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-info" id="prevButton">
                <a href="{{ route('appendix.show', ['number' => 24]) }}">Previous</a>
            </button>
            <button type="button" class="btn btn-info" id="prevButton">
                <a href="{{ route('appendix.show', ['number' => 26]) }}">Next</a>
            </button>
        </div>
        <small class="form-text text-muted mt-2">
            ** Enter the total amount in line 270 of the statement of transition from the accounting result to the tax result
        </small>
    </form>
    @else
    <form action="{{route('AppendixTwentyFive.store')}}" method="POST">
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
        <small class="form-text text-muted mt-2">
            Total Profit Recieved
        </small>
        <div class="table-container mt-4">
            <table  class="custom-table table-bordered table form-table "  id="operations-table">
                <thead >
                    <tr>
                        <th>code</th>
                        <th>Tax Number</th>
                        <th>Company Name</th>
                        <th>Nationality</th>
                        <th>The Currency</th>
                        <th>The Value</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <tr>
                        <td>100</td>
                        <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="company_name[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="nationality[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="currency[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="value[]" class="form-control" oninput="checkInputs()"></td>
                      
                    </tr>
                    <tr>
                        <td>110</td>
                        <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="company_name[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="nationality[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="currency[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="value[]" class="form-control" oninput="checkInputs()"></td>
                    </tr>
                    <tr>

                        <td>120</td>
                        <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="company_name[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="nationality[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="currency[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="value[]" class="form-control" oninput="checkInputs()"></td>
                    </tr>
                    <!-- Add more rows as needed -->
                    <tr class="footer-row">
                        <td colspan="5" class="text-right total-cell">200 Total</td>
                        <td><input type="number" name="total_1" class="form-control" id="total_amount1" readonly></td>
                        
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-info" id="prevButton">
                <a href="{{ route('appendix.show', ['number' => 24]) }}">Previous</a>
            </button>
        </div>
        <small class="form-text text-muted mt-2">
            ** Enter the total amount in line 270 of the statement of transition from the accounting result to the tax result
        </small>
    </form>
    @endif
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
            <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="company_name[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="nationality[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="currency[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="value[]" class="form-control" oninput="checkInputs()"></td>
        `;
        tableBody.insertBefore(newRow, tableBody.lastElementChild);
    }

    function calculateTotalAmount() {
        const unallowedValueInputs = document.querySelectorAll('input[name="value[]"]');

        let totalUnallowedValue = 0;

        unallowedValueInputs.forEach(input => {
            const amount = parseFloat(input.value) || 0;
            totalUnallowedValue += amount;
        });

        document.getElementById('total_amount1').value = totalUnallowedValue.toFixed(2);
    }
</script>
@endsection
