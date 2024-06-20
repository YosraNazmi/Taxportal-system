@extends('Taxpayer.AnnualTaxForm')

@section('AppendixTwenty')
@php
    // Check if form data exists
    $formData = \App\Models\AppendixTwenty::where('user_id', auth()->id())->get();
    $formData1 = \App\Models\AppendixTwentyB::where('user_id', auth()->id())->get();
@endphp
<div class="custom-container mt-5">
    <h5 class="custom-header">Appendix #20 Statement of Donations, Gifts, and Subsidies</h5>
    @if ($formData->isNotEmpty() && $formData1->isNotEmpty())
    <form action="{{route('updateAppendixTwenty')}}" method="POST">
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
            <table class="custom-table table-bordered table form-table " id="operations-table">
                <thead >
                    
                    <tr>
                        <th>code</th>
                        <th>Tax Number</th>
                        <th>Name of the Donation Receiver</th>
                        <th>Govermetal Entity</th>
                        <th>Value of Donations and Gifts</th>
                        <th>Allowable Donations	</th>
                        <th>Unauthorized Differences</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach ($formData as $index => $data)
                    <tr>
                        <td>100</td>
                        <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()" value="{{ $data->tax_number }}"></td>
                        <td><input type="text" name="name_of_donation[]" class="form-control" oninput="checkInputs()" value="{{ $data->name_of_donation }}"></td>
                        <td class="text-center"><input  type="checkbox" name="govermental_entity[{{ $index }}]" id="incomeYes{{ $index }}" value="1" {{ $data->govermental_entity ? 'checked' : '' }}></td>
                        <td><input type="number" name="value_of_donation[]" class="form-control" oninput="checkInputs()" value="{{ $data->value_of_donation }}"></td>
                        <td><input type="text" name="allowable_dontations[]" class="form-control" oninput="checkInputs()" value="{{ $data->allowable_dontations }}"></td>
                        <td><input type="number" name="unauthorized_differences_one[]" class="form-control" oninput="checkInputs()" value="{{ $data->unauthorized_differences_one }}"></td>
                    </tr>
                    @endforeach                    
                    <!-- Add more rows as needed -->
                    <tr class="footer-row">
                        <td colspan="4" class="text-right total-cell">Total</td>
                        <td><input type="number" name="total_1" class="form-control" id="total_amount1" readonly value="{{ $formData->sum('total_1') ?? '' }}"></td>
                        <td><input type="number" name="total_2" class="form-control" id="total_amount2" readonly value="{{ $formData->sum('total_2') ?? '' }}"></td>
                        <td><input type="number" name="total_3" class="form-control" id="total_amount3" readonly value="{{ $formData->sum('total_3') ?? '' }}"></td>
                    </tr>
                </tbody>
            </table>
            <small class="form-text text-muted">
                * Enter the total amount in line 210 of the statement of transition from the accounting result to the tax result											
            </small>
            <br>
            <table class="custom-table table-bordered table form-table  " id="operations-table_two">
                <thead >
                    <tr>
                        <th>code</th>
                        <th>Tax Number</th>
                        <th>Name of the Entity for which the Subsidy was Provided</th>
                        <th>Value of Subsidies</th>
                        <th>Allowable Allowances</th>
                        <th>Unauthorized Differences</th>
                    </tr>
                </thead>
                <tbody id="table">
                    @foreach ($formData1 as $index => $data)
                    <tr>
                        <td>100</td>
                        <td><input type="text" name="tax_number_1[]" class="form-control" oninput="checkInputs()" value="{{ $data->tax_number_1 }}"></td>
                        <td><input type="text" name="name_of_entity[]" class="form-control" oninput="checkInputs()" value="{{ $data->name_of_entity }}"></td>
                        <td><input type="number" name="value_subsidies[]" class="form-control" oninput="checkInputs()" value="{{ $data->value_subsidies }}"></td>
                        <td><input type="text" name="allowable_allowances[]" class="form-control" oninput="checkInputs()" value="{{ $data->allowable_allowances }}"></td>
                        <td><input type="number" name="unauthorized_differernce_1[]" class="form-control" oninput="checkInputs()" value="{{ $data->unauthorized_differernce_1 }}"></td>
                    </tr>
                    @endforeach
                    <!-- Add more rows as needed -->
                    <tr class="footer-row-two">
                        <td colspan="3" class="text-right total-cell">Total</td>
                        <td><input type="number" name="total_amount_1" class="form-control" id="total_amount_1" readonly value="{{ $formData1->sum('total_amount_1') ?? '' }}"></td>
                        <td><input type="number" name="total_amount_2" class="form-control" id="total_amount_2" readonly value="{{ $formData1->sum('total_amount_2') ?? '' }}"y></td>
                        <td><input type="number" name="total_amount_3" class="form-control" id="total_amount_3" readonly value="{{ $formData1->sum('total_amount_3') ?? '' }}"></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-info" id="prevButton">
                <a href="{{ route('appendix.show', ['number' => 19]) }}">Previous</a>
            </button>
            <button type="button" class="btn btn-info" id="prevButton">
                <a href="{{ route('appendix.show', ['number' => 21]) }}">Next</a>
            </button>
        </div>
        <small class="form-text text-muted mt-2">
            ** Enter the total amount in line 220 of the statement of transistion from the accounting result to the tax result
        </small>
        
    </form>
    @else
    <form action="{{route('AppendixTwenty.store')}}" method="POST">
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
                <thead >
                    <tr>
                        <th>code</th>
                        <th>Tax Number</th>
                        <th>Name of the Donation Receiver</th>
                        <th>Govermetal Entity</th>
                        <th>Value of Donations and Gifts</th>
                        <th>Allowable Donations	</th>
                        <th>Unauthorized Differences</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <tr>
                        <td>100</td>
                        <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="name_of_donation[]" class="form-control" oninput="checkInputs()"></td>
                        <td class="text-center">           
                                <input type="checkbox" name="govermental_entity[]" id="incomeYes1" value="1">
                        </td>
                        <td><input type="number" name="value_of_donation[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="allowable_dontations[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="unauthorized_differences_one[]" class="form-control" oninput="checkInputs()"></td>
                    </tr>
                    <!-- Repeat similar rows for entries 2 to 5 -->
                    <tr>
                        <td>110</td>
                        <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="name_of_donation[]" class="form-control" oninput="checkInputs()"></td>
                        <td class="text-center">           
                            <input type="checkbox" name="govermental_entity[]" id="incomeYes1" value="1">
                        </td>
                        <td><input type="number" name="value_of_donation[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="allowable_dontations[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="unauthorized_differences_one[]" class="form-control" oninput="checkInputs()"></td>
                    </tr>
                    <!-- Add more rows as needed -->
                    <tr class="footer-row">
                        <td colspan="4" class="text-right total-cell">Total</td>
                        <td><input type="number" name="total_1" class="form-control" id="total_amount1" readonly></td>
                        <td><input type="number" name="total_2" class="form-control" id="total_amount2" readonly></td>
                        <td><input type="number" name="total_3" class="form-control" id="total_amount3" readonly></td>
                    </tr>
                </tbody>
            </table>
            <small class="form-text text-muted">
                * Enter the total amount in line 210 of the statement of transition from the accounting result to the tax result											
            </small>
            <br>
            <table class="custom-table table-bordered table form-table  " id="operations-table_two">
                <thead >
                    <tr>
                        <th>code</th>
                        <th>Tax Number</th>
                        <th>Name of the Entity for which the Subsidy was Provided</th>
                        <th>Value of Subsidies</th>
                        <th>Allowable Allowances</th>
                        <th>Unauthorized Differences</th>
                    </tr>
                </thead>
                <tbody id="table">
                    <tr>
                        <td>100</td>
                        <td><input type="text" name="tax_number_1[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="name_of_entity[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="value_subsidies[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="allowable_allowances[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="unauthorized_differernce_1[]" class="form-control" oninput="checkInputs()"></td>
                    </tr>
                    <!-- Repeat similar rows for entries 2 to 5 -->
                    <tr>
                        <td>100</td>
                        <td><input type="text" name="tax_number_1[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="name_of_entity[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="value_subsidies[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="allowable_allowances[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="unauthorized_differernce_1[]" class="form-control" oninput="checkInputs()"></td>
                    </tr>
                    <!-- Add more rows as needed -->
                    <tr class="footer-row-two">
                        <td colspan="3" class="text-right total-cell">Total</td>
                        <td><input type="number" name="total_amount_1" class="form-control" id="total_amount_1" readonly></td>
                        <td><input type="number" name="total_amount_2" class="form-control" id="total_amount_2" readonly></td>
                        <td><input type="number" name="total_amount_3" class="form-control" id="total_amount_3" readonly></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-info" id="prevButton">
                <a href="{{ route('appendix.show', ['number' => 19]) }}">Previous</a>
            </button>
        </div>
        <small class="form-text text-muted mt-2">
            ** Enter the total amount in line 220 of the statement of transistion from the accounting result to the tax result
        </small>
        
    </form>
    @endif
</div>

<script>
    let currentCode = 120;

    function checkInputs() {
        const rows = document.querySelectorAll('#table-body tr');
        const lastRow = rows[rows.length - 2]; // exclude the total row
        const inputs = lastRow.querySelectorAll('input[type="text"], input[type="number"], input[type="date"]');
        const rowss = document.querySelectorAll('#table tr');
        const lastRows = rowss[rowss.length - 2]; // exclude the total row
        const inputss = lastRows.querySelectorAll('input[type="text"], input[type="number"], input[type="date"]');
        let allFilled = true;

        inputs.forEach(input => {
            if (input.value.trim() === '') {
                allFilled = false;
            }
        });

        inputss.forEach(input => {
            if (input.value.trim() === '') {
                allFilled = false;
            }
        });

        if (allFilled) {
            addNewRow();
            addNewRowTwo();
        }

        calculateTotalAmount();
    }

    function calculateTotalAmount() {
        const amountInputs = document.querySelectorAll('input[name="value_of_donation[]"]');
        const allwableInputs = document.querySelectorAll('input[name="allowable_dontations[]"]');
        const unauthprizedInputs = document.querySelectorAll('input[name="unauthorized_differences_one[]"]');
        let totalAmount = 0;
        let toralAllowable = 0;
        let totalAnauthorized = 0;
        const ValueInputs = document.querySelectorAll('input[name="value_subsidies[]"]');
        const allwableInputsAlloeances = document.querySelectorAll('input[name="allowable_allowances[]"]');
        const unauthprizedDInputs = document.querySelectorAll('input[name="unauthorized_differernce_1[]"]');
        let totalValue = 0;
        let toralAllowableAllowances = 0;
        let totalAnauthorizedD = 0;

        
        amountInputs.forEach(input => {
            const amount = parseFloat(input.value) || 0;
            totalAmount += amount;
        });
        allwableInputs.forEach(input => {
            const amount = parseFloat(input.value) || 0;
            toralAllowable += amount;
        });
        unauthprizedInputs.forEach(input => {
            const amount = parseFloat(input.value) || 0;
            totalAnauthorized += amount;
        });

        ValueInputs.forEach(input => {
            const amount = parseFloat(input.value) || 0;
            totalValue += amount;
        });
        allwableInputsAlloeances.forEach(input => {
            const amount = parseFloat(input.value) || 0;
            toralAllowableAllowances += amount;
        });
        unauthprizedDInputs.forEach(input => {
            const amount = parseFloat(input.value) || 0;
            totalAnauthorizedD += amount;
        });

        document.getElementById('total_amount1').value = totalAmount.toFixed(2);
        document.getElementById('total_amount2').value = toralAllowable.toFixed(2);
        document.getElementById('total_amount3').value = totalAnauthorized.toFixed(2);

        document.getElementById('total_amount_1').value = totalValue.toFixed(2);
        document.getElementById('total_amount_2').value = toralAllowableAllowances.toFixed(2);
        document.getElementById('total_amount_3').value = totalAnauthorizedD.toFixed(2);
    }

    function addNewRow() {
        currentCode += 10;
        const tableBody = document.getElementById('table-body');
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td>${currentCode}</td>
            <td><input type="text" name="tax_number[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="name_of_donation[]" class="form-control" oninput="checkInputs()"></td>
                        <td class="text-center">
                            <div class="form-check">
                                <input class="form-check-input"type="checkbox" name="govermental_entity[]" id="incomeYes1" value="yes">
                            </div>
                        </td>
                        <td><input type="number" name="value_of_donation[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="allowable_dontations[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="unauthorized_differences_one[]" class="form-control" oninput="checkInputs()"></td>
                    
        `;

        tableBody.insertBefore(newRow, tableBody.querySelector('.footer-row'));
    }
    function addNewRowTwo() {
        currentCodes += 10;
        const tableBody = document.getElementById('table');
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td>${currentCodes}</td>
            <td><input type="text" name="tax_number_1[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="name_of_entity[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="value_subsidies[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="text" name="allowable_allowances[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="unauthorized_differernce_1[]" class="form-control" oninput="checkInputs()"></td>
                    
        `;

        tableBody.insertBefore(newRow, tableBody.querySelector('.footer-row-two'));
    }
</script>
@endsection
