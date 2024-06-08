@extends('Taxpayer.AnnualTaxForm')

@section('AppendixNine')
<div class="custom-container mt-5">
    <br>
    <h4 class="custom-header">Appendix #9: Statement of Sale of Tangible/Intangible Assets</h4>
    <form action="{{ route('AppendixNine.store') }}" method="POST">
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
        <!-- Fixed Tangible / Intangible Assets -->
        <h5 class="custom-header-2">Fixed Tangible / Intangible Assets</h5>
        <table class="table table-bordered form-table custom-table fixed-assets-table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Type of Assets</th>
                    <th>Date of Purchase (Day, Month, Year)</th>
                    <th>Book Value</th>
                    <th>Net Selling Value</th>
                    <th>Profit/Loss</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>100</td>
                    <td><input type="text" name="t_asset_type[]" class="form-control"></td>
                    <td><input type="date" name="t_purchase_date[]" class="form-control"></td>
                    <td><input type="text" name="t_book_value[]" class="form-control"></td>
                    <td><input type="text" name="t_net_selling_value[]" class="form-control"></td>
                    <td><input type="text" name="t_profit_loss[]" class="form-control t-profit-loss"></td>
                </tr>
                <tr>
                    <td>110</td>
                    <td><input type="text" name="t_asset_type[]" class="form-control"></td>
                    <td><input type="date" name="t_purchase_date[]" class="form-control"></td>
                    <td><input type="text" name="t_book_value[]" class="form-control"></td>
                    <td><input type="text" name="t_net_selling_value[]" class="form-control"></td>
                    <td><input type="text" name="t_profit_loss[]" class="form-control t-profit-loss"></td>
                </tr>
                <tr class="footer-row">
                    <td colspan="4">Total</td>
                    <td>200</td>
                    <td><input type="text" id="total_1" name="total_1" class="form-control" readonly></td>
                </tr>
            </tbody>
        </table>

        <!-- Financial Investments -->
        <h5 class="custom-header-2">Financial Investments</h5>
        <table class="table table-bordered form-table custom-table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Number of Shares/Bonds</th>
                    <th>Tax Number</th>
                    <th>Company Name</th>
                    <th>Date of Purchase (Day, Month, Year)</th>
                    <th>Cost of Purchase</th>
                    <th>Net Selling Value</th>
                    <th>Profit/Loss</th>
                </tr>
            </thead>
            <tbody class="financial-investments-table">
                <tr>
                    <td>100</td>
                    <td><input type="text" name="number_of_shares[]" class="form-control"></td>
                    <td><input type="text" name="tax_number[]" class="form-control"></td>
                    <td><input type="text" name="company_name[]" class="form-control"></td>
                    <td><input type="date" name="purchase_date[]" class="form-control"></td>
                    <td><input type="text" name="purchase_cost[]" class="form-control"></td>
                    <td><input type="text" name="net_selling_value[]" class="form-control"></td>
                    <td><input type="text" name="profit_loss[]" class="form-control profit-loss"></td>
                </tr>
                <tr>
                    <td>100</td>
                    <td><input type="text" name="number_of_shares[]" class="form-control"></td>
                    <td><input type="text" name="tax_number[]" class="form-control"></td>
                    <td><input type="text" name="company_name[]" class="form-control"></td>
                    <td><input type="date" name="purchase_date[]" class="form-control"></td>
                    <td><input type="text" name="purchase_cost[]" class="form-control"></td>
                    <td><input type="text" name="net_selling_value[]" class="form-control"></td>
                    <td><input type="text" name="profit_loss[]" class="form-control profit-loss"></td>
                </tr>
                <tr class="footer-row">
                    <td colspan="6">Total</td>
                    <td>200</td>
                    <td><input type="text" id="total_2" name="total_2" class="form-control" readonly></td>
                </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <br>
</div>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        function calculateTotals() {
            let total1 = 0;
            let total2 = 0;

            // Calculate total for fixed tangible/intangible assets
            document.querySelectorAll('.t-profit-loss').forEach(function(element) {
                total1 += parseFloat(element.value) || 0;
            });

            // Calculate total for financial investments
            document.querySelectorAll('.profit-loss').forEach(function(element) {
                total2 += parseFloat(element.value) || 0;
            });

            // Update total input fields
            document.getElementById('total_1').value = total1.toFixed(2);
            document.getElementById('total_2').value = total2.toFixed(2);
        }

    // Call calculateTotals function when the page loads
    window.addEventListener('load', calculateTotals);

    // Call calculateTotals function when data is changed
    document.querySelectorAll('.t-profit-loss, .profit-loss').forEach(function(element) {
        element.addEventListener('input', calculateTotals);
    });

});
</script>

@endsection
