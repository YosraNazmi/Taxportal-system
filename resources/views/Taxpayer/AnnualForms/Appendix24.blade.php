@extends('Taxpayer.AnnualTaxForm')

@section('AppendixTwentyFour')
@php
    // Check if form data exists
    $formData = \App\Models\AppendixTwentyFour::where('user_id', auth()->id())->get();
@endphp
<div class="custom-container mt-5">
    <h5 class="custom-header">Appendix #24 Statement of Allotments</h5>
    @if ($formData->isNotEmpty() )
    <form action="{{route('updateAppendixTwentyFour')}}" method="POST">
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
        <div class="table-container mt-4">
            <table class="custom-table table-bordered table form-table "  id="operations-table">
                <thead>
                    <tr>
                        <th>code</th>
                        <th>Type</th>
                        <th>The Value of the provision at the beginning of the year</th>
                        <th colspan="3">Allocations made during the year</th>
                        <th>Recovering allocations</th>
                        <th>the value of provision at the end of the year</th>
                    </tr>
                    <tr>
                        <th colspan="3"></th>
                        <th>The value</th>
                        <th>Allowed Value</th>
                        <th>Unallowed Differences</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach ($formData as $index => $data)
                    <tr>
                        <td>100</td>
                        <td><input type="text" name="type[]" class="form-control" oninput="checkInputs()" value="{{ $data->type }}"></td>
                        <td><input type="number" name="value_of_provision_start[]" class="form-control" oninput="checkInputs()" value="{{ $data->value_of_provision_start }}"></td>
                        <td><input type="number" name="the_value[]" class="form-control" oninput="checkInputs()" value="{{ $data->the_value }}"></td>
                        <td><input type="number" name="allowed_value[]" class="form-control" oninput="checkInputs()" value="{{ $data->allowed_value }}"></td>
                        <td><input type="number" name="unallowed_value[]" class="form-control" oninput="checkInputs()" value="{{ $data->unallowed_value }}"></td>
                        <td><input type="number" name="recovery_allocations[]" class="form-control" oninput="checkInputs()" value="{{ $data->recovery_allocations }}"></td>
                        <td><input type="number" name="value_of_provision_end[]" class="form-control" oninput="checkInputs()" value="{{ $data->value_of_provision_end }}"></td>
                    </tr>
                    @endforeach
                    <!-- Add more rows as needed -->
                    <tr class="footer-row">
                        <td colspan="5" class="text-right total-cell">200 Total</td>
                        <td><input type="number" name="total_1" class="form-control" id="total_amount1" value="{{ $formData->sum('total_1') ?? '' }}" readonly></td>
                        <th colspan="2"></th>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-info" id="prevButton">
                <a href="{{ route('appendix.show', ['number' => 23]) }}">Previous</a>
            </button>
            <button type="button" class="btn btn-info" id="prevButton">
                <a href="{{ route('appendix.show', ['number' => 25]) }}">Next</a>
            </button>
        </div>
        <small class="form-text text-muted mt-2">
            ** Enter the total amount in line 270 of the statement of transition from the accounting result to the tax result
        </small>
    </form>
    @else
    <form action="{{route('AppendixTwentyFour.store')}}" method="POST">
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
            <table class="custom-table table-bordered table form-table "  id="operations-table">
                <thead>
                    <tr>
                        <th>code</th>
                        <th>Type</th>
                        <th>The Value of the provision at the beginning of the year</th>
                        <th colspan="3">Allocations made during the year</th>
                        <th>Recovering allocations</th>
                        <th>the value of provision at the end of the year</th>
                    </tr>
                    <tr>
                        <th colspan="3"></th>
                        <th>The value</th>
                        <th>Allowed Value</th>
                        <th>Unallowed Differences</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <tr>
                        <td>100</td>
                        <td><input type="text" name="type[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="value_of_provision_start[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="the_value[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="allowed_value[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="unallowed_value[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="recovery_allocations[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="value_of_provision_end[]" class="form-control" oninput="checkInputs()"></td>
                    </tr>
                    <tr>
                        <td>110</td>
                        <td><input type="text" name="type[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="value_of_provision_start[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="the_value[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="allowed_value[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="unallowed_value[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="recovery_allocations[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="value_of_provision_end[]" class="form-control" oninput="checkInputs()"></td>
                    </tr>
                    <tr>
                        <td>120</td>
                        <td><input type="text" name="type[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="value_of_provision_start[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="the_value[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="allowed_value[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="unallowed_value[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="recovery_allocations[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="value_of_provision_end[]" class="form-control" oninput="checkInputs()"></td>
                    </tr>
                    <!-- Add more rows as needed -->
                    <tr class="footer-row">
                        <td colspan="5" class="text-right total-cell">200 Total</td>
                        <td><input type="number" name="total_1" class="form-control" id="total_amount1" readonly></td>
                        <th colspan="2"></th>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-info" id="prevButton">
                <a href="{{ route('appendix.show', ['number' => 23]) }}">Previous</a>
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
            <td><input type="string" name="text[]" class="form-control" oninput="checkInputs()"></td>
            <td><input type="number" name="value_of_provision_start[]" class="form-control" oninput="checkInputs()"></td>
            <td><input type="number" name="the_value[]" class="form-control" oninput="checkInputs()"></td>
            <td><input type="number" name="allowed_value[]" class="form-control" oninput="checkInputs()"></td>
            <td><input type="number" name="unallowed_value[]" class="form-control" oninput="checkInputs()"></td>
            <td><input type="number" name="recovery_allocations[]" class="form-control" oninput="checkInputs()"></td>
            <td><input type="number" name="value_of_provision_end[]" class="form-control" oninput="checkInputs()"></td>
        `;
        tableBody.insertBefore(newRow, tableBody.lastElementChild);
    }

    function calculateTotalAmount() {
        const unallowedValueInputs = document.querySelectorAll('input[name="unallowed_value[]"]');

        let totalUnallowedValue = 0;

        unallowedValueInputs.forEach(input => {
            const amount = parseFloat(input.value) || 0;
            totalUnallowedValue += amount;
        });

        document.getElementById('total_amount1').value = totalUnallowedValue.toFixed(2);
    }
</script>
@endsection
