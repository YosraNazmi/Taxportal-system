@extends('Taxpayer.AnnualTaxForm')

@section('AppendixSix')
<div class="custom-container mt-5">
    <br>
    <h5 class="text-center custom-header">Appendix #6 Expiration Statement of Tangible Assets (Other than Land)</h5>

    <form action="{{route('AppendixSix.store')}}" method="POST">
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
                <input placeholder="Enter Depreciation value  " type="text" name="depreciation_value" class="form-control">
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
                    <input class="text-center" type="checkbox" id="method2" name="decreasing_installment" value="The decreasing installment method">
                    <label class="form-check-label" for="method2">
                        The decreasing installment method
                    </label>
                </div>
                <div class="form-check">
                    <input class="" type="checkbox" id="method3" name="Another_method_administration" value="Another method with the approval of the tax administration">
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
                    <th>Category of the Disposable Assets(1)</th>
                    <th>Directory Number according to the Attached Tables for in Effect Depreciation Systems(2)</th>
                    <th>Book Value at the Beginning of the Year(3)</th>
                    <th>Cost of Acquisition During the Year (New Assets Must be Available for Use)(4)</th>
                    <th>Cost of Assets Sold or Written off During the Year(5)</th>
                    <th>Total Allowable Depreciation in the in Effect Depreciation System for the Year(6)</th>
                    <th>Accumulated Depreciation of Property Sold or Written off During the Year(8)</th>
                    <th>Book Value at End of Year (3+4-5-6+7)(8)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>100</td>
                    <td><input type="text" name="category_assets[]" class="form-control"></td>
                    <td><input type="text" name="directory_number[]" class="form-control"></td>
                    <td><input type="text" name="book_value[]" class="form-control"></td>
                    <td><input type="text" name="cost_acquisition[]" class="form-control"></td>
                    <td><input type="text" name="cost_assets[]" class="form-control"></td>
                    <td><input type="text" name="total_allowable[]" class="form-control"></td>
                    <td><input type="text" name="accumulated[]" class="form-control"></td>
                    <td><input type="text" name="book_value_end[]" class="form-control"></td>
                </tr>
                <tr>
                    <td>110</td>
                    <td><input type="text" name="category_assets[]" class="form-control"></td>
                    <td><input type="text" name="directory_number[]" class="form-control"></td>
                    <td><input type="text" name="book_value[]" class="form-control"></td>
                    <td><input type="text" name="cost_acquisition[]" class="form-control"></td>
                    <td><input type="text" name="cost_assets[]" class="form-control"></td>
                    <td><input type="text" name="total_allowable[]" class="form-control"></td>
                    <td><input type="text" name="accumulated[]" class="form-control"></td>
                    <td><input type="text" name="book_value_end[]" class="form-control"></td>
                </tr>
                <tr>
                    <td>120</td>
                    <td><input type="text" name="category_assets[]" class="form-control"></td>
                    <td><input type="text" name="directory_number[]" class="form-control"></td>
                    <td><input type="text" name="book_value[]" class="form-control"></td>
                    <td><input type="text" name="cost_acquisition[]" class="form-control"></td>
                    <td><input type="text" name="cost_assets[]" class="form-control"></td>
                    <td><input type="text" name="total_allowable[]" class="form-control"></td>
                    <td><input type="text" name="accumulated[]" class="form-control"></td>
                    <td><input type="text" name="book_value_end[]" class="form-control"></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td>200 Total</td>
                    <td></td>
                    <td></td>
                    <td><input type="number" name="total_book_value" id="total_book_value" class="form-control" readonly></td>
                    <td><input type="number" name="total_cost_acquisition" id="total_cost_acquisition" class="form-control" readonly></td>
                    <td><input type="number" name="total_cost_assets" id="total_cost_assets" class="form-control" readonly></td>
                    <td><input type="number" name="total_total_allowable" id="total_total_allowable" class="form-control" readonly></td>
                    <td><input type="number" name="total_accumulated" id="total_accumulated" class="form-control" readonly></td>
                    <td><input type="number" name="total_book_value_end" id="total_book_value_end" class="form-control" readonly></td>
                </tr>
            </tfoot>
        </table>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <br>
    <small class="form-text text-muted mt-2">
        * Enter the amount that is included in the statement of income for the amortization of the tangible assets in line 120 of the statement of transition from the accounting result to the tax result.
    </small>
    <small class="form-text text-muted mt-2">** Enter the total amount of column #6 in line 400 of the statement of transition from the accounting result to the tax result.</small>
    <br>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Function to check if a row is filled
        function isRowFilled(row) {
            let filled = true;
            $(row).find('input').each(function() {
                if ($(this).val() === '') {
                    filled = false;
                }
            });

            // Check if category_assets field is filled
            if ($(row).find('input[name="category_assets[]"]').val() === '') {
                filled = false;
            }

            return filled;
        }

        // Function to calculate the book value end for a given row
        function calculateBookValueEnd(row) {
            const bookValue = parseFloat($(row).find('input[name="book_value[]"]').val()) || 0;
            const costAcquisition = parseFloat($(row).find('input[name="cost_acquisition[]"]').val()) || 0;
            const costAssets = parseFloat($(row).find('input[name="cost_assets[]"]').val()) || 0;
            const totalAllowable = parseFloat($(row).find('input[name="total_allowable[]"]').val()) || 0;
            const accumulated = parseFloat($(row).find('input[name="accumulated[]"]').val()) || 0;

            const bookValueEnd = bookValue + costAssets + costAcquisition + totalAllowable + accumulated;
            $(row).find('input[name="book_value_end[]"]').val(bookValueEnd.toFixed(2));
        }

        // Function to update totals
        function updateTotals() {
            // Initialize total variables
            let totalBookValue = 0;
            let totalCostAcquisition = 0;
            let totalCostAssets = 0;
            let totalTotalAllowable = 0;
            let totalAccumulated = 0;
            let totalBookValueEnd = 0;

            // Iterate over each row in the table body
            $('tbody tr').each(function() {
                // Calculate and update book value end for the row
                calculateBookValueEnd(this);

                // Update totals
                totalBookValue += parseFloat($(this).find('input[name="book_value[]"]').val()) || 0;
                totalCostAcquisition += parseFloat($(this).find('input[name="cost_acquisition[]"]').val()) || 0;
                totalCostAssets += parseFloat($(this).find('input[name="cost_assets[]"]').val()) || 0;
                totalTotalAllowable += parseFloat($(this).find('input[name="total_allowable[]"]').val()) || 0;
                totalAccumulated += parseFloat($(this).find('input[name="accumulated[]"]').val()) || 0;
                totalBookValueEnd += parseFloat($(this).find('input[name="book_value_end[]"]').val()) || 0;
            });

            // Update total input fields
            $('#total_book_value').val(totalBookValue.toFixed(2));
            $('#total_cost_acquisition').val(totalCostAcquisition.toFixed(2));
            $('#total_cost_assets').val(totalCostAssets.toFixed(2));
            $('#total_total_allowable').val(totalTotalAllowable.toFixed(2));
            $('#total_accumulated').val(totalAccumulated.toFixed(2));
            $('#total_book_value_end').val(totalBookValueEnd.toFixed(2));
        }

        // Attach event listener for input change on existing rows
        $('table tbody tr input').on('input', function() {
            calculateBookValueEnd($(this).closest('tr'));
            updateTotals();
        });

        // Attach event listener to add new rows
        $(document).on('input', 'table tbody tr:last-child input', function() {
            const lastRow = $('table tbody tr:last-child');
            if (isRowFilled(lastRow)) {
                addNewRow();
            }
        });

        // Function to add a new row
        function addNewRow() {
            const newRow = `
                <tr>
                    <td></td>
                    <td><input type="text" name="category_assets[]" class="form-control"></td>
                    <td><input type="text" name="directory_number[]" class="form-control"></td>
                    <td><input type="text" name="book_value[]" class="form-control"></td>
                    <td><input type="text" name="cost_acquisition[]" class="form-control"></td>
                    <td><input type="text" name="cost_assets[]" class="form-control"></td>
                    <td><input type="text" name="total_allowable[]" class="form-control"></td>
                    <td><input type="text" name="accumulated[]" class="form-control"></td>
                    <td><input type="text" name="book_value_end[]" class="form-control"></td>
                </tr>`;
            $('table tbody').append(newRow);
        }
    });
</script>



@endsection

