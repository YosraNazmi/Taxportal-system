@extends('Taxpayer.AnnualTaxForm')
@section('FormF')
<style>
    .form-container {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
    }
    .form-table th,
    .form-table td {
        vertical-align: middle !important;
    }
    .form-header {
        background-color: #d1ecf1;
        padding: 10px;
        border-radius: 10px;
        text-align: center;
        margin-bottom: 20px;
    }
    .form-header h4, .form-header h5 {
        margin: 0;
    }
    .table-container {
        background-color: #f1f1f1;
        padding: 20px;
        border-radius: 10px;
        overflow-x: auto;
    }
    .total-cell {
        font-weight: bold;
    }
    .form-footer {
        font-size: 12px;
        color: #6c757d;
        margin-top: 20px;
    }
</style>
 <br>
    <!--table four-->
    <h3 class="mt-4">Statement of Transition from Accounting to Tax Result</h3>
    <form action="{{route('AppendixThree.store')}}" method="POST">
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
        <table class="table table-bordered mt-3">
            <thead class="thead-light">
                <tr>
                    <th>Code</th>
                    <th>Explanation</th>
                    <th>Value (IQD)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>100</td>
                    <td><strong>Accounting result for the current year </strong> Net profit before tax - Moved from statement of income statement - line 610</td>
                    <td><input  type="text" class="form-control" name="accounting_result_current_year" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td colspan="3" class="bg-success text-white"><strong>Add to the accounting result:</strong></td>
                </tr>
                <tr>
                    <td>110</td>
                    <td>Interest and fines of delays on taxes</td>
                    <td><input type="text" class="form-control" name="interest_fines_delays_taxes" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>120</td>
                    <td>Depreciation of tangible assets according to the income statement (Appendix # 6)</td>
                    <td><input type="text" class="form-control" name="depreciation_tangible_assets"value="{{ $depreciationTangibleAssets }}" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>130</td>
                    <td>Depreciation of intangible assets according to the income statement (Appendix # 7)</td>
                    <td><input type="text" class="form-control" name="depreciation_intangible_assets" value="{{$depreciationIntangibleAssets}}" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>140</td>
                    <td>Book losses for investments in solidarity companies (Appendix # 8)</td>
                    <td><input type="text" class="form-control" name="book_losses_investments_solidarity" value="{{$bookLossesInvestmentsSolidarity}}" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>150</td>
                    <td>Losses of investments realized abroad (Appendix # 8)</td>
                    <td><input type="text" class="form-control" name="losses_investments_abroad"  value="{{$lossesInvestmentsAbroad}}" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>160</td>
                    <td>Losses of investments in national joint stock companies (Appendix # 8)</td>
                    <td><input type="text" class="form-control" name="losses_investments_national_stock" value="{{$LossesInvestmentsNationalStock}}"  oninput="formatCurrency(this)"></td>
                </tr>  
                <tr>
                    <td>170</td>
                    <td>Unrealized losses</td>
                    <td><input type="text" class="form-control" name="unrealized_losses" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>180</td>
                    <td>Expenses to contribute to the expenses of a parent company, subsidiary, sister.</td>
                    <td><input type="text" class="form-control" name="expenses_contribute_parent_subsidary" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>190</td>
                    <td>Bad debt expenses according to income statement (Appendix 19)</td>
                    <td><input type="text" class="form-control" name="bad_debt_expenses" value="{{$badDebtExpenses}}" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>200</td>
                    <td>Unauthorized Expenses of compensations and fines</td>
                    <td><input type="text" class="form-control" name="unauthorized_expenses_compensations_fines" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>210</td>
                    <td>Unauthorized donations and gifts (Appendix # 20)</td>
                    <td><input type="text" class="form-control" name="unauthorized_donations_gifts" value="{{$unauthorizedDonationsGifts}}" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>220</td>
                    <td>Unauthorized subsidy expenses (Appendix # 20)</td>
                    <td><input type="text" class="form-control" name="unauthorized_subsidy_expenses" value="{{$unauthorizedSubsidyExpenses}}" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>230</td>
                    <td>Personal and special expenses</td>
                    <td><input type="text" class="form-control" name="personal_special_expenses" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>240</td>
                    <td>Unauthorized insurance expenses (Appendix # 21)</td>
                    <td><input type="text" class="form-control" name="unauthorized_insurance_expenses" value="{{$unauthorizedInsuranceExpenses}}" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>250</td>
                    <td>Unauthorized payments to the managing director (Appendix # 22)</td>
                    <td><input type="text" class="form-control" name="unauthorized_payments_director" value="{{$unauthorizedPaymentsDirector}}" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>260</td>
                    <td>Other expenses that are not deductible</td>
                    <td><input type="text" class="form-control" name="other_non_deductible_expenses" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>270</td>
                    <td>Unauthorized benefits and commissions (Appendix # 23)</td>
                    <td><input type="text" class="form-control" name="unauthorized_benefits_commissions" value="{{$unauthorizedBenefitsCommissions}}" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>280</td>
                    <td>Unauthorized taxes, fees, and penalties</td>
                    <td><input type="text" class="form-control" name="unauthorized_taxes_fees_penalties" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>290</td>
                    <td>Impairment of tangible and intangible assets</td>
                    <td><input type="text" class="form-control" name="impairment_tangible_intangible_assets" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>300</td>
                    <td>Unauthorized allowances (Appendix # 24)</td>
                    <td><input type="text" class="form-control" name="unauthorized_allowances" value="{{$unauthorizedAllowances}}" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>310</td>
                    <td>Unpaid interest payable</td>
                    <td><input type="text" class="form-control" name="unpaid_interest_payable" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>320</td>
                    <td>Other positive adjustments</td>
                    <td><input type="text" class="form-control" name="other_positive_adjustments" oninput="formatCurrency(this)"></td>
                </tr>
                <tr class="font-weight-bold">
                    <td>330</td>
                    <td>Total amounts added to the accounting result</td>
                    <td><input type="text" class="form-control" name="total_amounts_added_accounting_result" readonly></td>
                </tr>
                
                    <tr>
                        <td colspan="3" class="bg-danger text-white"><strong>Add to the accounting result:</strong></td>
                    </tr>
                <tr>
                    <td>400</td>
                    <td>Depreciation of permitted tangible assets (Appendix # 6)</td>
                    <td><input type="text" class="form-control" name="depreciation_permitted_tangible_assets" value="{{ $depreciationTangibleAssets }}" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>410</td>
                    <td>Consumption of tangible assets permitted (Appendix # 7)</td>
                    <td><input type="text" class="form-control" name="consumption_tangible_assets_permitted" value="{{$depreciationIntangibleAssets}}"  oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>420</td>
                    <td>Amounts of bad debts allowed (Appendix # 19)</td>
                    <td><input type="text" class="form-control" name="amounts_bad_debts_allowed"  value="{{$badDebtExpenses}}" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>430</td>
                    <td>Book profits of investments in solidarity companies (Appendix # 8)</td>
                    <td><input type="text" class="form-control" name="book_profits_investments_solidarity_companies" value="{{$bookLossesInvestmentsSolidarity}}" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>440</td>
                    <td>Profits from investments in national shareholding companies (Appendix # 8)</td>
                    <td><input type="text" class="form-control" name="profits_investments_national_shareholding_companies" value="{{$lossesInvestmentsAbroad}}"  oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>540</td>
                    <td>Profits of investments realized abroad (Appendix # 8)</td>
                    <td><input type="text" class="form-control" name="profits_investments_realized_abroad" value="{{$LossesInvestmentsNationalStock}}"  oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>560</td>
                    <td>Unrealized gains</td>
                    <td><input type="text" class="form-control" name="unrealized_gains" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>470</td>
                    <td>Benefits paid for previous years</td>
                    <td><input type="text" class="form-control" name="benefits_paid_previous_years" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>480</td>
                    <td>Other income that is not taxable</td>
                    <td><input type="text" class="form-control" name="other_income_not_taxable" oninput="formatCurrency(this)"></td>
                </tr>
                <tr>
                    <td>490</td>
                    <td>Other negative adjustments</td>
                    <td><input type="text" class="form-control" name="other_negative_adjustments" oninput="formatCurrency(this)"></td>
                </tr>
                <tr class="font-weight-bold">
                    <td>500</td>
                    <td>Total amounts deducted from the accounting result</td>
                    <td><input type="text" class="form-control" name="total_amounts_deducted_accounting_result" readonly></td>
                </tr>
                <tr class="font-weight-bold">
                    <td>600</td>
                    <td>Net taxable income</td>
                    <td><input type="text" class="form-control" name="net_taxable_income" readonly></td>
                </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Submit</button>
        <br>
    </form>
    
    <script>
        function calculateTotalAddedAmounts() {
            let inputFields = document.querySelectorAll('input[name^="interest_fines_delays_taxes"], input[name^="depreciation_tangible_assets"], input[name^="depreciation_intangible_assets"], input[name^="book_losses_investments_solidarity"], input[name^="losses_investments_abroad"], input[name^="losses_investments_national_stock"], input[name^="unrealized_losses"], input[name^="expenses_contribute_parent_subsidary"], input[name^="bad_debt_expenses"], input[name^="unauthorized_expenses_compensations_fines"], input[name^="unauthorized_donations_gifts"], input[name^="unauthorized_subsidy_expenses"], input[name^="personal_special_expenses"], input[name^="unauthorized_insurance_expenses"], input[name^="unauthorized_payments_director"], input[name^="other_non_deductible_expenses"], input[name^="unauthorized_benefits_commissions"], input[name^="unauthorized_taxes_fees_penalties"], input[name^="impairment_tangible_intangible_assets"], input[name^="unauthorized_allowances"], input[name^="unpaid_interest_payable"], input[name^="other_positive_adjustments"]');
    
            let total = 0;
            inputFields.forEach(input => {
                total += parseFloat(input.value.replace(/,/g, '')) || 0;
            });
    
            document.querySelector('input[name="total_amounts_added_accounting_result"]').value = total.toFixed(2);
        }
    
        function calculateTotalDeductedAmounts() {
            let inputFields = document.querySelectorAll('input[name^="depreciation_permitted_tangible_assets"], input[name^="consumption_tangible_assets_permitted"], input[name^="amounts_bad_debts_allowed"], input[name^="book_profits_investments_solidarity_companies"], input[name^="profits_investments_national_shareholding_companies"], input[name^="profits_investments_realized_abroad"], input[name^="unrealized_gains"], input[name^="benefits_paid_previous_years"], input[name^="other_income_not_taxable"], input[name^="other_negative_adjustments"]');
    
            let total = 0;
            inputFields.forEach(input => {
                total += parseFloat(input.value.replace(/,/g, '')) || 0;
            });
    
            document.querySelector('input[name="total_amounts_deducted_accounting_result"]').value = total.toFixed(2);
        }
    
        function calculateNetTaxableIncome() {
            let added = parseFloat(document.querySelector('input[name="total_amounts_added_accounting_result"]').value.replace(/,/g, '')) || 0;
            let deducted = parseFloat(document.querySelector('input[name="total_amounts_deducted_accounting_result"]').value.replace(/,/g, '')) || 0;
    
            let net = added - deducted;
            document.querySelector('input[name="net_taxable_income"]').value = net.toFixed(2);
        }
    
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', () => {
                calculateTotalAddedAmounts();
                calculateTotalDeductedAmounts();
                calculateNetTaxableIncome();
            });
        });
    
        calculateTotalAddedAmounts();
        calculateTotalDeductedAmounts();
        calculateNetTaxableIncome();
    </script>
    
 @endsection