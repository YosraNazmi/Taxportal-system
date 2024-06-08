@extends('Taxpayer.AnnualTaxForm')

@section('AppendixSeven')
<div class="custom-container mt-5">
    <br>
    <h5 class="text-center custom-header">Appendix #7 Expiration Statement of Intangible Assets (Other than Land)</h5>

    <form action="{{ route('AppendixSeven.store') }}" method="POST">
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
        <!-- Display success message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="form-group row mt-4">
            <label class="col-md-4 col-form-label mt-4">Depreciation value according to the income statement:</label>
            <div class="col-md-4 mt-4">
                <input type="text" name="depreciation_value" class="form-control" placeholder="Enter Depreciation value">
            </div>
        </div>   
        <hr>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Expiration method selected for income tax purposes (select one)</label>
            <div class="col-sm-9">
                <div class="form-check">
                    <input class="" type="checkbox" id="method1" name="continuous_installment" value="Continuous installment method">
                    <label class="form-check-label" for="method1">
                        Continuous installment method
                    </label>
                </div>
                <div class="form-check">
                    <input class="" type="checkbox" id="method2" name="decreasing_installment" value="The decreasing installment method">
                    <label class="form-check-label" for="method2">
                        The decreasing installment method
                    </label>
                </div>
                <div class="form-check">
                    <input class="" type="checkbox" id="method3" name="another_method_administration" value="Another method with the approval of the tax administration">
                    <label class="form-check-label" for="method3">
                        Another method with the approval of the tax administration
                    </label>
                </div>
            </div>
        </div>

        <table class="table table-bordered custom-table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Type of Intangible Assets (Name)(1)</th>
                    <th>Book Value at the Beginning of the Year(2)</th>
                    <th>Cost of Acquisition during the year (new intangible assets must be available for use)(3)</th>
                    <th>Cost of Intangible Assets Sold or Written off During the Year(4)</th>
                    <th>Total Consumption Allowed in the in Effect Depreciation System for the Year (5)</th>
                    <th>Depreciation of Intangible Assets Sold or Written off During the Year(6)</th>
                    <th>Book Value at the End of Year (3+4+5+6+7) (8)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>100</td>
                    <td><input type="text" name="type_of_intangible_assets[]" class="form-control"></td>
                    <td><input type="text" name="book_value_beginning[]" class="form-control"></td>
                    <td><input type="text" name="cost_of_acquisition[]" class="form-control"></td>
                    <td><input type="text" name="cost_of_assets_sold[]" class="form-control"></td>
                    <td><input type="text" name="total_consumption_allowed[]" class="form-control"></td>
                    <td><input type="text" name="depreciation_of_assets_sold[]" class="form-control"></td>
                    <td><input type="text" name="book_value_end[]" class="form-control"></td>
                </tr>
                <tr>
                    <td>110</td>
                    <td><input type="text" name="type_of_intangible_assets[]" class="form-control"></td>
                    <td><input type="text" name="book_value_beginning[]" class="form-control"></td>
                    <td><input type="text" name="cost_of_acquisition[]" class="form-control"></td>
                    <td><input type="text" name="cost_of_assets_sold[]" class="form-control"></td>
                    <td><input type="text" name="total_consumption_allowed[]" class="form-control"></td>
                    <td><input type="text" name="depreciation_of_assets_sold[]" class="form-control"></td>
                    <td><input type="text" name="book_value_end[]" class="form-control"></td>
                </tr>
                <tr>
                    <td>120</td>
                    <td><input type="text" name="type_of_intangible_assets[]" class="form-control"></td>
                    <td><input type="text" name="book_value_beginning[]" class="form-control"></td>
                    <td><input type="text" name="cost_of_acquisition[]" class="form-control"></td>
                    <td><input type="text" name="cost_of_assets_sold[]" class="form-control"></td>
                    <td><input type="text" name="total_consumption_allowed[]" class="form-control"></td>
                    <td><input type="text" name="depreciation_of_assets_sold[]" class="form-control"></td>
                    <td><input type="text" name="book_value_end[]" class="form-control"></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td>200 Total</td>
                    <td></td>
                    <td><input type="number" name="total_book_value_beginning" id="total_book_value_beginning" class="form-control" readonly></td>
                    <td><input type="number" name="total_cost_of_acquisition" id="total_cost_of_acquisition" class="form-control" readonly></td>
                    <td><input type="number" name="total_cost_of_assets_sold" id="total_cost_of_assets_sold" class="form-control" readonly></td>
                    <td><input type="number" name="total_total_consumption_allowed" id="total_total_consumption_allowed" class="form-control" readonly></td>
                    <td><input type="number" name="total_depreciation_of_assets_sold" id="total_depreciation_of_assets_sold" class="form-control" readonly></td>
                    <td><input type="number" name="total_book_value_end" id="total_book_value_end" class="form-control" readonly></td>
                </tr>
            </tfoot>
        </table>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <br>
    <small class="form-text text-muted mt-2">* Enter the amount that is included in the statement of income for the amortization of the tangible assets in line 120 of the statement of transition from the accounting result to the tax result.</small>
    <small class="form-text text-muted mt-2">** Enter the total amount of column #6 in line 400 of the statement of transition from the accounting result to the tax result.</small>
    <br>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
    // Function to check if a row is filled
    function isRowFilled(row) {
        let filled = false;
        $(row).find('input').each(function() {
            if ($(this).val() !== '') {
                filled = true;
            }
        });
        return filled;
    }

    // Function to calculate the book value end for a given row
    function calculateBookValueEnd(row) {
        const bookValueBeginning = parseFloat($(row).find('input[name="book_value_beginning[]"]').val()) || 0;
        const costOfAcquisition = parseFloat($(row).find('input[name="cost_of_acquisition[]"]').val()) || 0;
        const costOfAssetsSold = parseFloat($(row).find('input[name="cost_of_assets_sold[]"]').val()) || 0;
        const totalConsumptionAllowed = parseFloat($(row).find('input[name="total_consumption_allowed[]"]').val()) || 0;
        const depreciationOfAssetsSold = parseFloat($(row).find('input[name="depreciation_of_assets_sold[]"]').val()) || 0;

        const bookValueEnd = bookValueBeginning + costOfAcquisition + costOfAssetsSold + totalConsumptionAllowed + depreciationOfAssetsSold;
        $(row).find('input[name="book_value_end[]"]').val(bookValueEnd.toFixed(2));
    }

    // Function to add a new row
    function addNewRow() {
        const lastRow = $('tbody tr:last');
        const newRow = lastRow.clone();
        newRow.find('input').val(''); // Clear input values in the new row
        lastRow.after(newRow);
    }

    // Function to update totals
    function updateTotals() {
        // Initialize total variables
        let totalBookValueBeginning = 0;
        let totalCostOfAcquisition = 0;
        let totalCostOfAssetsSold = 0;
        let totalTotalConsumptionAllowed = 0;
        let totalDepreciationOfAssetsSold = 0;
        let totalBookValueEnd = 0;

        // Iterate over each row in the table body
        $('tbody tr').each(function() {
            if (isRowFilled(this)) {
                const bookValueBeginning = parseFloat($(this).find('input[name="book_value_beginning[]"]').val()) || 0;
                const costOfAcquisition = parseFloat($(this).find('input[name="cost_of_acquisition[]"]').val()) || 0;
                const costOfAssetsSold = parseFloat($(this).find('input[name="cost_of_assets_sold[]"]').val()) || 0;
                const totalConsumptionAllowed = parseFloat($(this).find('input[name="total_consumption_allowed[]"]').val()) || 0;
                const depreciationOfAssetsSold = parseFloat($(this).find('input[name="depreciation_of_assets_sold[]"]').val()) || 0;
                const bookValueEnd = parseFloat($(this).find('input[name="book_value_end[]"]').val()) || 0;

                totalBookValueBeginning += bookValueBeginning;
                totalCostOfAcquisition += costOfAcquisition;
                totalCostOfAssetsSold += costOfAssetsSold;
                totalTotalConsumptionAllowed += totalConsumptionAllowed;
                totalDepreciationOfAssetsSold += depreciationOfAssetsSold;
                totalBookValueEnd += bookValueEnd;
            }
        });

        // Update total fields in the table footer
        $('#total_book_value_beginning').val(totalBookValueBeginning.toFixed(2));
        $('#total_cost_of_acquisition').val(totalCostOfAcquisition.toFixed(2));
        $('#total_cost_of_assets_sold').val(totalCostOfAssetsSold.toFixed(2));
        $('#total_total_consumption_allowed').val(totalTotalConsumptionAllowed.toFixed(2));
        $('#total_depreciation_of_assets_sold').val(totalDepreciationOfAssetsSold.toFixed(2));
        $('#total_book_value_end').val(totalBookValueEnd.toFixed(2));
    }

    // Attach change event handler to input fields to trigger calculation
    $('input').on('input', function() {
        const row = $(this).closest('tr');
        calculateBookValueEnd(row);
        updateTotals();

        // Check if the last row is filled, and add a new row if necessary
        if (row.is(':last-child') && isRowFilled(row)) {
            addNewRow();
        }
    });
});

</script>
@endsection
