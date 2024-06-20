@extends('Taxpayer.AnnualTaxForm')

@section('AppendixSixteen')
@php
    // Check if form data exists
    $formData = \App\Models\AppendixSixteen::where('user_id', auth()->id())->get();
@endphp
<div class="custom-container mt-5">
    <br>
    <h5 class="text-center custom-header">Appendix #16  Statement of Operations and Payments to non-Residents in Kurdistan</h5>
    @if ($formData->isNotEmpty())
    <form action="{{route('updateAppendixSixteen')}}" method="POST">
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
        
        <table  class="table table-bordered custom-table form-table " id="operations-table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Company Name</th>
                    <th>Address</th>
                    <th>Batch Code</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody id="table-body">
                @foreach ($formData as $index => $data)
                <tr>
                    <td>100</td>        
                    <td><input type="text" name="company_name[]" class="form-control" oninput="checkInputs()" value="{{ $data->company_name }}"></td>
                    <td><input type="text" name="address[]" class="form-control" oninput="checkInputs()" value="{{ $data->address }}"></td>
                    <td><input type="text" name="batch_code[]" class="form-control" oninput="checkInputs()" value="{{ $data->batch_code }}"></td>
                    <td><input type="text" name="value[]" class="form-control" oninput="checkInputs()" value="{{ $data->value }}"></td>
                </tr>
                @endforeach
                <tr class="footer-row">
                    <td>200</td>
                    <td colspan="3">Total</td>
                    <td><input type="text" id="total_1" name="total_1" class="form-control" value="{{ $formData->sum('total_1') ?? '' }}" readonly></td>
                </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-info" id="prevButton">
            <a href="{{ route('appendix.show', ['number' => 15]) }}">Previous</a>
        </button>
        <button type="button" class="btn btn-info" id="prevButton">
            <a href="{{ route('appendix.show', ['number' => 17]) }}">Next</a>
        </button>
    </form>
    @else
    <form action="{{route('AppendixSixteen.store')}}" method="POST">
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
        
        <table  class="table table-bordered custom-table form-table " id="operations-table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Company Name</th>
                    <th>Address</th>
                    <th>Batch Code</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <tr>
                    <td>100</td>        
                    <td><input type="text" name="company_name[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="address[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="batch_code[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="value[]" class="form-control" oninput="checkInputs()"></td>
                </tr>
                <tr>
                    <td>120</td>
                    <td><input type="text" name="company_name[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="address[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="batch_code[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="value[]" class="form-control" oninput="checkInputs()"></td>
                </tr>
                <tr>
                    <td>130</td>
                    <td><input type="text" name="company_name[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="address[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="batch_code[]" class="form-control" oninput="checkInputs()"></td>
                    <td><input type="text" name="value[]" class="form-control" oninput="checkInputs()"></td>
                </tr>
                <tr class="footer-row">
                    <td>200</td>
                    <td colspan="3">Total</td>
                    <td><input type="text" id="total_1" name="total_1" class="form-control" readonly></td>
                </tr>
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-info" id="prevButton">
            <a href="{{ route('appendix.show', ['number' => 15]) }}">Previous</a>
        </button>
    </form>
    @endif
    <div class="note">
        <p><strong>Batch Code:</strong></p>
        <ul>
            <li><small class="form-text text-muted mt-2">1- Fees</small></li>
            <li><small class="form-text text-muted mt-2">2- Rents</small></li>
            <li><small class="form-text text-muted mt-2">3- Administrative Expenses</small></li>
            <li><small class="form-text text-muted mt-2">4- Brokerage Expenses</small></li>
            <li> <small class="form-text text-muted mt-2">5- Technical Assistance Expenditures</small></li>
            <li><small class="form-text text-muted mt-2">6- Research, Development and Consultancy Expenses</small></li>
            <li> <small class="form-text text-muted mt-2">7- Interests</small></li>
            <li><small class="form-text text-muted mt-2">8- Dividend Distribution</small></li>
            <li><small class="form-text text-muted mt-2">9- Administrative Services	</small></li>
            <li>  <small class="form-text text-muted mt-2">10- Hardware and Equipment	</small></li>
            <li> <small class="form-text text-muted mt-2">11- Designs</small>    </li>
            
        </ul>
    </div>
    
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
        const feeInputs = document.querySelectorAll('input[name="value[]"]');
        let totalFees = 0;

        feeInputs.forEach(input => {
            const fee = parseFloat(input.value) || 0; // Convert input value to float or default to 0
            totalFees += fee;
        });

        document.getElementById('total_1').value = totalFees.toFixed(2); // Update total fees
    }

    function addNewRow() {
        currentCode += 10;
        const tableBody = document.getElementById('table-body');
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td>${currentCode}</td>
            <td><input type="text" name="company_name[]" class="form-control" oninput="checkInputs()"></td>
            <td><input type="text" name="address[]" class="form-control" oninput="checkInputs()"></td>
            <td><input type="text" name="batch_code[]" class="form-control" oninput="checkInputs()"></td>
            <td><input type="text" name="value[]" class="form-control" oninput="checkInputs()"></td>
        `;

        tableBody.insertBefore(newRow, tableBody.querySelector('.footer-row'));
    }
</script>

@endsection
