@extends('Taxpayer.AnnualTaxForm')

@section('AppendixTwentyTwo')
@php
    // Check if form data exists
    $formData = \App\Models\AppendixTwentyTwo::where('user_id', auth()->id())->get();

@endphp
<div class="custom-container mt-5">
    <h5 class="custom-header">Appendix #22 Statement of payments to the authorized director of a limited company</h5>
    @if ($formData->isNotEmpty() )
    <form action="{{route('updateAppendixTwentyTwo')}}" method="POST">
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
                <thead>
                    <tr>
                        <th>code</th>
                        <th>Income type</th>
                        <th>The amount in the income statement</th>
                        <th>Downloadable amount</th>
                        <th>Not downloadable amount</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach ($formData as $data)
                    <tr>
                        <td>100</td>
                        <td><input type="text" name="income_type[]" class="form-control" oninput="checkInputs()" value="{{ $data->income_type }}"></td>
                        <td><input type="number" name="amount_in_statement[]" class="form-control" oninput="checkInputs()" value="{{ $data->amount_in_statement }}"></td>
                        <td><input type="number" name="allowed_amount[]" class="form-control" oninput="checkInputs()" value="{{ $data->allowed_amount }}"></td>
                        <td><input type="number" name="not_allowed_amount[]" class="form-control" oninput="checkInputs()" value="{{ $data->not_allowed_amount }}"></td>
                    </tr>
                    @endforeach
                    <tr class="footer-row">
                        <td colspan="2" class="text-right total-cell">200 Total</td>
                        <td><input type="number" name="total_1" class="form-control" id="total_amount1" readonly value="{{ $formData->sum('total_1') ?? '' }}"></td>
                        <td><input type="number" name="total_2" class="form-control" id="total_amount2" readonly value="{{ $formData->sum('total_2') ?? '' }}"></td>
                        <td><input type="number" name="total_3" class="form-control" id="total_amount3" readonly value="{{ $formData->sum('total_3') ?? '' }}"></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-info" id="prevButton">
                <a href="{{ route('appendix.show', ['number' => 21]) }}">Previous</a>
            </button>
            <button type="button" class="btn btn-info" id="prevButton">
                <a href="{{ route('appendix.show', ['number' => 23]) }}">Next</a>
            </button>
        </div>
        <small class="form-text text-muted mt-2">
            ** Enter the total amount in line 250 of the statement of transition from the accounting result to the tax result
        </small>
    </form>
    @else
    <form action="{{ route('AppendixTwentyTwo.store') }}" method="POST">
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
                        <th>Income type</th>
                        <th>The amount in the income statement</th>
                        <th>Downloadable amount</th>
                        <th>Not downloadable amount</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <tr>
                        <td>100</td>
                        <td><input type="text" name="income_type[]" class="form-control" oninput="checkInputs()" value="Salaries & Wages"></td>
                        <td><input type="number" name="amount_in_statement[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="allowed_amount[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="not_allowed_amount[]" class="form-control" oninput="checkInputs()"></td>
                    </tr>
                    <tr>
                        <td>110</td>
                        <td><input type="text" name="income_type[]" class="form-control" oninput="checkInputs()" value="Allowances & Bonuses"></td>
                        <td><input type="number" name="amount_in_statement[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="allowed_amount[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="not_allowed_amount[]" class="form-control" oninput="checkInputs()"></td>
                    </tr>
                    <tr>
                        <td>120</td>
                        <td><input type="text" name="income_type[]" class="form-control" oninput="checkInputs()" value="Commissions or Incentives"></td>
                        <td><input type="number" name="amount_in_statement[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="allowed_amount[]" class="form-control" oninput="checkInputs()"></td>
                        <td><input type="number" name="not_allowed_amount[]" class="form-control" oninput="checkInputs()"></td>
                    </tr>
                    <!-- Add more rows as needed -->
                    <tr class="footer-row">
                        <td colspan="2" class="text-right total-cell">200 Total</td>
                        <td><input type="number" name="total_1" class="form-control" id="total_amount1" readonly></td>
                        <td><input type="number" name="total_2" class="form-control" id="total_amount2" readonly></td>
                        <td><input type="number" name="total_3" class="form-control" id="total_amount3" readonly></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-info" id="prevButton">
                <a href="{{ route('appendix.show', ['number' => 21]) }}">Previous</a>
            </button>
        </div>
        <small class="form-text text-muted mt-2">
            ** Enter the total amount in line 250 of the statement of transition from the accounting result to the tax result
        </small>
    </form>
    @endif
</div>

<script>
    let currentCode = 120;

    function checkInputs() {
        calculateTotalAmount();
    }

    function calculateTotalAmount() {
    const amountInStatementInputs = document.querySelectorAll('input[name="amount_in_statement[]"]');
    const allowedAmountInputs = document.querySelectorAll('input[name="allowed_amount[]"]');
    const notAllowedAmountInputs = document.querySelectorAll('input[name="not_allowed_amount[]"]');
    let totalAmount1 = 0;
    let totalAmount2 = 0;
    let totalAmount3 = 0;

    amountInStatementInputs.forEach((input, index) => {
        const amountInStatement = parseFloat(input.value) || 0;
        const allowedAmount = parseFloat(allowedAmountInputs[index].value) || 0;
        const notAllowedAmount = amountInStatement - allowedAmount;
        notAllowedAmountInputs[index].value = notAllowedAmount.toFixed(2);
        totalAmount1 += amountInStatement;
        totalAmount2 += allowedAmount;
        totalAmount3 += notAllowedAmount;
    });

    document.getElementById('total_amount1').value = totalAmount1.toFixed(2);
    document.getElementById('total_amount2').value = totalAmount2.toFixed(2);
    document.getElementById('total_amount3').value = totalAmount3.toFixed(2);
    }

</script>
@endsection
