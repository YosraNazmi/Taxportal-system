@extends('Taxpayer.AnnualTaxForm')

@section('AppendixEight')
<div class="custom-container mt-5">
    <br>
    <form action="{{ route('AppendixEight.store') }}" method="POST">
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
        <h4 class="custom-header">Appendix #8: Statement of Company's Investments in Other Parties</h4>
        
        <!-- Investments in Solidarity Companies and Simple Companies -->
        <h5 class="custom-header-2">Investments in Solidarity Companies and Simple Companies</h5>
        <table class="table table-bordered form-table custom-table table1">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Tax Number</th>
                    <th>Name of the Company Owned</th>
                    <th>Number of Shares</th>
                    <th>Ownership Percentage</th>
                    <th>Book Value of the Contribution</th>
                    <th>Accounting Profit or Loss *</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>100</td>
                    <td><input type="text" name="tax_number[1][]" class="form-control"></td>
                    <td><input type="text" name="owned_company_name[1][]" class="form-control"></td>
                    <td><input type="text" name="number_of_shares[1][]" class="form-control"></td>
                    <td><input type="text" name="ownership_percentage[1][]" class="form-control"></td>
                    <td><input type="text" name="book_value[1][]" class="form-control"></td>
                    <td><input type="text" name="accounting_profit[1][]" class="form-control accounting-profit-1" oninput="calculateTotals()"></td>
                </tr>
                <tr>
                    <td>110</td>
                    <td><input type="text" name="tax_number[1][]" class="form-control"></td>
                    <td><input type="text" name="owned_company_name[1][]" class="form-control"></td>
                    <td><input type="text" name="number_of_shares[1][]" class="form-control"></td>
                    <td><input type="text" name="ownership_percentage[1][]" class="form-control"></td>
                    <td><input type="text" name="book_value[1][]" class="form-control"></td>
                    <td><input type="text" name="accounting_profit[1][]" class="form-control accounting-profit-1" oninput="calculateTotals()"></td>
                </tr>
                <tr>
                    <td colspan="5">Total</td>
                    <td>200</td>
                    <td><input type="text" id="total_1" name="total_1" class="form-control" readonly></td>
                </tr>
            </tbody>
        </table>
        <br>
        <small class="form-text text-muted mt-2">* Enter the total amount of the value of the profit or loss of accounting in line 140 of the statement of transition from the accounting result to the tax result in case of loss or line 430 in case of profit.</small>
        <br>
        <!-- Investments in National Shareholding/Limited Liability Companies -->
        <h5 class="custom-header-2">Investments in National Shareholding/Limited Liability Companies</h5>
        <table class="table table-bordered form-table custom-table table2">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Tax Number</th>
                    <th>Name of the Company Owned</th>
                    <th>Type of Company</th>
                    <th>The Number of Ordinary Shares</th>
                    <th>Ownership Percentage</th>
                    <th>Number of Preferred Shares</th>
                    <th>Book Value of the Contribution</th>
                    <th>Accounting Profit or Loss *</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>100</td>
                    <td><input type="text" name="tax_number[2][]" class="form-control"></td>
                    <td><input type="text" name="owned_company_name[2][]" class="form-control"></td>
                    <td><input type="text" name="type_of_company[2][]" class="form-control"></td>
                    <td><input type="text" name="number_of_shares[2][]" class="form-control"></td>
                    <td><input type="text" name="ownership_percentage[2][]" class="form-control"></td>
                    <td><input type="text" name="number_of_preferred_contribution[2][]" class="form-control"></td>
                    <td><input type="text" name="book_value[2][]" class="form-control"></td>
                    <td><input type="text" name="accounting_profit[2][]" class="form-control accounting-profit-2" oninput="calculateTotals()"></td>
                </tr>
                <tr>
                    <td>110</td>
                    <td><input type="text" name="tax_number[2][]" class="form-control"></td>
                    <td><input type="text" name="owned_company_name[2][]" class="form-control"></td>
                    <td><input type="text" name="type_of_company[2][]" class="form-control"></td>
                    <td><input type="text" name="number_of_shares[2][]" class="form-control"></td>
                    <td><input type="text" name="ownership_percentage[2][]" class="form-control"></td>
                    <td><input type="text" name="number_of_preferred_contribution[2][]" class="form-control"></td>
                    <td><input type="text" name="book_value[2][]" class="form-control"></td>
                    <td><input type="text" name="accounting_profit[2][]" class="form-control accounting-profit-2" oninput="calculateTotals()"></td>
                </tr>
                <tr>
                    <td colspan="7">Total</td>
                    <td>200</td>
                    <td><input type="text" id="total_2" name="total_2" class="form-control" readonly></td>
                </tr>
            </tbody>
        </table>
        <br>
        <small class="form-text text-muted mt-2">* Enter the total amount of the value of the profit or loss accounting in line 150 of the statement of transition from the accounting result to the tax result in case of loss or line 440 in case of profit.</small>
        <br>
        <!-- Investments in Joint Stock Companies/Limited Liability -->
        <h5 class="custom-header-2">Investments in Joint Stock Companies/Limited Liability</h5>
        <table class="table table-bordered form-table custom-table table3">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Tax Number</th>
                    <th>Name of the Company Owned</th>
                    <th>Nationality</th>
                    <th>Type of Company</th>
                    <th>The Number of Ordinary Shares</th>
                    <th>Ownership Percentage</th>
                    <th>Number of Preferred Shares</th>
                    <th>Book Value of the Shares</th>
                    <th>Accounting Profit or Loss *</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>100</td>
                    <td><input type="text" name="tax_number[3][]" class="form-control"></td>
                    <td><input type="text" name="owned_company_name[3][]" class="form-control"></td>
                    <td><input type="text" name="nationality[3][]" class="form-control"></td>
                    <td><input type="text" name="company_type[3][]" class="form-control"></td>
                    <td><input type="text" name="number_of_shares[3][]" class="form-control"></td>
                    <td><input type="text" name="ownership_percentage[3][]" class="form-control"></td>
                    <td><input type="text" name="number_of_preferred_shared[3][]" class="form-control"></td>
                    <td><input type="text" name="book_value[3][]" class="form-control"></td>
                    <td><input type="text" name="accounting_profit[3][]" class="form-control accounting-profit-3" oninput="calculateTotals()"></td>
                </tr>
                <tr>
                    <td>110</td>
                    <td><input type="text" name="tax_number[3][]" class="form-control"></td>
                    <td><input type="text" name="owned_company_name[3][]" class="form-control"></td>
                    <td><input type="text" name="nationality[3][]" class="form-control"></td>
                    <td><input type="text" name="company_type[3][]" class="form-control"></td>
                    <td><input type="text" name="number_of_shares[3][]" class="form-control"></td>
                    <td><input type="text" name="ownership_percentage[3][]" class="form-control"></td>
                    <td><input type="text" name="number_of_preferred_shared[3][]" class="form-control"></td>
                    <td><input type="text" name="book_value[3][]" class="form-control"></td>
                    <td><input type="text" name="accounting_profit[3][]" class="form-control accounting-profit-3" oninput="calculateTotals()"></td>
                </tr>
                <tr>
                    <td colspan="8">Total</td>
                    <td>200</td>
                    <td><input type="text" id="total_3" name="total_3" class="form-control" readonly></td>
                </tr>
            </tbody>
        </table>
        <br>
        <small class="form-text text-muted mt-2">* Enter the total amount of the value of the profit or loss accounting in line 150 of the statement of transition from the accounting result to the tax result in case of loss or line 440 in case of profit.</small>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <br>
</div>

<script>
    function calculateTotals() {
        let total1 = 0;
        let total2 = 0;
        let total3 = 0;

        document.querySelectorAll('.accounting-profit-1').forEach(function(element) {
            total1 += parseFloat(element.value) || 0;
        });

        document.querySelectorAll('.accounting-profit-2').forEach(function(element) {
            total2 += parseFloat(element.value) || 0;
        });

        document.querySelectorAll('.accounting-profit-3').forEach(function(element) {
            total3 += parseFloat(element.value) || 0;
        });

        document.getElementById('total_1').value = total1.toFixed(2);
        document.getElementById('total_2').value = total2.toFixed(2);
        document.getElementById('total_3').value = total3.toFixed(2);
    }
</script>
@endsection
