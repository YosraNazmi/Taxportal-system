 <!--first table -->
 @extends('Taxpayer.AnnualTaxForm')
@section('FormC')
<div class="container mt-5">
    
    <form action="" method="POST" id="multi-step-form">
        @csrf
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
        <h3 class="custom-header-2">Annexes for the Income Tax of Companies</h5>
        <p>Put X sign in the appropriate box against each statement that has been filled.</p>
        <table class=" table-bordered table form-table ">
            <thead style="text-align: center; background-color: #ddd7d7 !important;">
                <tr>
                    <th scope="col">X</th>
                    <th scope="col">Statement</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td ><input type="checkbox" value="1" ></td>
                    <td>1. General Budget statement (Required)</td>
                </tr>
                <tr>
                    <td><input type="checkbox" value="2" ></td>
                    <td>2. Income Statement (Required)</td>
                </tr>
                <tr>
                    <td><input type="checkbox" value="3"></td>
                    <td>3. Statement of transition from accounting to tax result (Required)</td>
                </tr>
                <tr>
                    <td ><input type="checkbox" value="4" ></td>
                    <td>4. Statement of Capital Distribution</td>
                </tr>
                <tr>
                    <td ><input  type="checkbox" value="5"></td>
                    <td>5. Statement of company information after consolidation or Liquidation</td>
                </tr>
                <tr>
                    <td ><input  type="checkbox" value="6" ></td>
                    <td>6. Statement of tangible assets depreciation</td>
                </tr>
                <tr>
                    <td ><input  type="checkbox" value="7"></td>
                    <td>7. Statement of intangible assets depreciation</td>
                </tr>
                <tr>
                    <td ><input type="checkbox" value="8"></td>
                    <td>8. Statement of company's investments in other parties</td>
                </tr>
                <tr>
                    <td ><input type="checkbox" value="9" ></td>
                    <td>9. Statement sales of the assets tangible/intangible</td>
                </tr>
                <tr>
                    <td ><input type="checkbox" value="10"></td>
                    <td>10. Statement of previous losses</td>
                </tr>
                <tr>
                    <td ><input type="checkbox" value="11"></td>
                    <td>11. Statement of operations with shareholders, managers and employees.</td>
                </tr>
                <tr>
                    <td ><input type="checkbox" value="12"></td>
                    <td>12. Statement of operations with interrelated companies.</td>
                </tr>
                <tr>
                    <td ><input  type="checkbox" value="13"></td>
                    <td>13. Statement of sales and purchases with interrelated companies</td>
                </tr>
                <tr>
                    <td ><input type="checkbox" value="14" ></td>
                    <td>14. Inventory and warehouse statement.</td>
                </tr>
                <tr>
                    <td ><input type="checkbox" value="15"></td>
                    <td>15. Statement of fees and administrative expenses and similar amounts for companies resident in Kurdistan.</td>
                </tr>
                <tr>
                    <td ><input type="checkbox" value="16"></td>
                    <td>16. Statement of operations and payments to non-residents ir</td>
                </tr>
                <tr>
                    <td ><input  type="checkbox" value="17"></td>
                    <td>17. Statement of activities via the internet.</td>
                </tr>
                <tr>
                    <td ><input type="checkbox" value="18"></td>
                    <td>18. Statement of secondary contractors.</td>
                </tr>
                <tr>
                    <td ><input type="checkbox" value="19"></td>
                    <td>19. Statement of bad debts.</td>
                </tr>
                <tr>
                    <td ><input type="checkbox" value="20"></td>
                    <td>20. Statement of donations, gifts and subsidies.</td>
                </tr>
                <tr>
                    <td ><input  type="checkbox" value="21"></td>
                    <td>21. Statement of insurance expenses.</td>
                </tr>
                <tr>
                    <td ><input  type="checkbox" value="22"></td>
                    <td>22. Statement of payments to the commissioner of a specific company.</td>
                </tr>
                <tr>
                    <td ><input type="checkbox" value="23"></td>
                    <td>23. Statement of bank interest.</td>
                </tr>
                <tr>
                    <td ><input  type="checkbox" value="24" ></td>
                    <td>24. Statement of provisions.</td>
                </tr>
                <tr>
                    <td ><input type="checkbox" value="25" ></td>
                    <td>25. Dividend distribution statement.</td>
                </tr>
                <tr>
                    <td ><input  type="checkbox" value="26"></td>
                    <td>26. Foreign tax credit statement.</td>
                </tr>
                <tr>
                    <td ><input type="checkbox" value="27"></td>
                    <td>27. Statement of tax deducted from transactions during the tax year.</td>
                </tr>
            </tbody>
        </table>
        <br>
        <button type="submit" class="btn btn-success">Submit</button>
        <br>
        <br>
    </form> 
</div>
@endsection