@extends('Taxpayer.AnnualTaxForm')

@section('AppendixTwentySix')
@php
    // Check if form data exists
    $formData = \App\Models\AppendixTwentySix::where('user_id', auth()->id())->get();

@endphp
<div class="custom-container mt-5">
    <h5 class="custom-header">Appendix #26 Statement of Foreign tax approval</h5>
    @if ($formData->isNotEmpty() )
    <form action="{{route('updateAppendixTwentySix')}}" method="POST">
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
            <table class="custom-table table-bordered table form-table " id="operations-table">
                <thead >
                    <tr>
                        <th>code</th>
                        <th>Country(1)</th>
                        <th>Net Profit(2)</th>
                        <th>Income Tax paid during the year in IQD(3)</th>
                        <th>Unused Foriegn tax credit in the past five years(4)</th>
                        <th>Total foriegn tax credit collected(5)</th>
                        <th>The maximum tax credit for the year (15%)(6)</th>
                        <th>The tax due before the foriegn tax is approved(7)</th>
                        <th>The allowable foriegn tax creditt (is the lowest value of cvolumn)(8)</th>
                        <th>Approval of foriegn tax not used for the purpose of uploading for the years(8-5)(9)</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach ($formData as $index => $data)
                    <tr>
                        <td>100</td>
                        <td><input type="text" name="country[]" class="form-control" oninput="checkInputs()" value="{{ $data->country }}"></td>
                        <td><input type="text" name="net_profit[]" class="form-control" oninput="checkInputs()" value="{{ $data->net_profit }}"></td>
                        <td><input type="text" name="income_tax_iqd[]" class="form-control" oninput="checkInputs()" value="{{ $data->income_tax_iqd }}"></td>
                        <td><input type="number" name="unused_foreign_tax_credit[]" class="form-control" oninput="checkInputs()" value="{{ $data->unused_foreign_tax_credit }}"></td>
                        <td><input type="number" name="total_foreign_tax[]" class="form-control" oninput="checkInputs()" value="{{ $data->total_foreign_tax }}"></td>
                        <td><input type="number" name="maximum_tax_credit[]" class="form-control" oninput="checkInputs()" value="{{ $data->maximum_tax_credit }}"></td>
                        <td><input type="number" name="due_tax_approved_foreign_tax[]" class="form-control" oninput="checkInputs()" value="{{ $data->due_tax_approved_foreign_tax }}"></td>
                        <td><input type="number" name="allowable_foreign_tax[]" class="form-control" oninput="checkInputs()" value="{{ $data->allowable_foreign_tax }}"></td>
                        <td><input type="number" name="approval_foreign_tax[]" class="form-control" oninput="checkInputs()" value="{{ $data->approval_foreign_tax }}"></td>
                    </tr>
                    @endforeach
                    <!-- Add more rows as needed -->
                    <tr class="footer-row">
                        <td colspan="6" class="text-right total-cell">200 Total</td>
                        <td><input type="number" name="total_1" class="form-control" id="total_amount1"  value="{{ $formData->sum('total_1') ?? '' }}"readonly></td>
                        <td colspan="3" class="text-right total-cell"></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-info" id="prevButton">
                <a href="{{ route('appendix.show', ['number' => 25]) }}">Previous</a>
            </button>
            <button type="button" class="btn btn-info" id="prevButton">
                <a href="{{ route('appendix.show', ['number' => 27]) }}">Next</a>
            </button>
  
        </div>
        <small class="form-text text-muted mt-2">
            ** Enter the total amount in line 270 of the statement of transition from the accounting result to the tax result
        </small>
    </form>
    @else
    <form action="{{route('AppendixTwentySix.store')}}" method="POST">
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
            <table class="custom-table table-bordered table form-table " id="operations-table">
                <thead >
                    <tr>
                        <th>code</th>
                        <th>Country(1)</th>
                        <th>Net Profit(2)</th>
                        <th>Income Tax paid during the year in IQD(3)</th>
                        <th>Unused Foriegn tax credit in the past five years(4)</th>
                        <th>Total foriegn tax credit collected(5)</th>
                        <th>The maximum tax credit for the year (15%)(6)</th>
                        <th>The tax due before the foriegn tax is approved(7)</th>
                        <th>The allowable foriegn tax creditt (is the lowest value of cvolumn)(8)</th>
                        <th>Approval of foriegn tax not used for the purpose of uploading for the years(8-5)(9)</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <tr>
                        <td>100</td>
                        <td><input type="text" name="country[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="net_profit[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="income_tax_iqd[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="unused_foreign_tax_credit[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="total_foreign_tax[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="maximum_tax_credit[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="due_tax_approved_foreign_tax[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="allowable_foreign_tax[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="approval_foreign_tax[]" class="form-control" oninput="checkInputs()"></td>
                    </tr>
                    <tr>
                        <td>110</td>
                        <td><input type="text" name="country[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="net_profit[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="income_tax_iqd[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="unused_foreign_tax_credit[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="total_foreign_tax[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="maximum_tax_credit[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="due_tax_approved_foreign_tax[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="allowable_foreign_tax[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="approval_foreign_tax[]" class="form-control" oninput="checkInputs()"></td>
                    </tr>
                    <tr>

                        <td>120</td>
                        <td><input type="text" name="country[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="net_profit[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="income_tax_iqd[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="unused_foreign_tax_credit[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="total_foreign_tax[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="maximum_tax_credit[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="due_tax_approved_foreign_tax[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="allowable_foreign_tax[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="approval_foreign_tax[]" class="form-control" oninput="checkInputs()"></td>
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
            <button type="button" class="btn btn-info" id="prevButton">
                <a href="{{ route('appendix.show', ['number' => 25]) }}">Previous</a>
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
            <td><input type="text" name="country[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="net_profit[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="income_tax_iqd[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="unused_foreign_tax_credit[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="total_foreign_tax[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="maximum_tax_credit[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="due_tax_approved_foreign_tax[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="allowable_foreign_tax[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="approval_foreign_tax[]" class="form-control" oninput="checkInputs()"></td>
        `;
        tableBody.insertBefore(newRow, tableBody.lastElementChild);
    }

    function calculateTotalAmount() {
        const unallowedValueInputs = document.querySelectorAll('input[name="maximum_tax_credit[]"]');

        let totalUnallowedValue = 0;

        unallowedValueInputs.forEach(input => {
            const amount = parseFloat(input.value) || 0;
            totalUnallowedValue += amount;
        });

        document.getElementById('total_amount1').value = totalUnallowedValue.toFixed(2);
    }
</script>
@endsection
