
@extends('Taxpayer.AnnualTaxForm')
@section('FormD')
<style>
  .step-circle {
    width: 30px;
    height: 30px;
    border: 2px solid #1e3e54;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    background-color: white;
    color: #1e3e54;
    font-weight: bold;
}

.step-circle.active {
    background-color: #007bff !important;
    color: white !important;
    border: 2px solid #007bff ;
}
.step-circle.completed {
    background-color: #1e3e54;
    color: white;
    border-color: #1e3e54;
}
</style>
<div class="container">
    <br><br>
    <div class="progress px-1" style="height: 3px;">
        <div style="background-color: #1e3e54 ;" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="step-container d-flex justify-content-between">
        <div class="step-circle" id="step-circle-1" onclick="displayStep(1)">1</div>
        <div class="step-circle" id="step-circle-2" onclick="displayStep(2)">2</div>
        <div class="step-circle" id="step-circle-3" onclick="displayStep(3)">3</div>
    </div>
    <form action="{{ route('appendixOne.store') }}" method="POST" id="multi-step-form">
        @csrf
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
            <h3>General Budget Statement</h3>
            <div class="step step-1">
                <table class="custom-table table-bordered table form-table ">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Code</th>
                            <th scope="col">Account</th>
                            <th scope="col">Current financial year (amounts in IQD)</th>
                            <th scope="col">Prior financial year (amounts in IQD)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>100</td>
                            <td>18</td>
                            <td>Funds and Banks</td>
                            <td><input type="text" class="form-control" name="current_funds_banks" oninput="formatCurrency(this)" ></td>
                            <td><input type="text" class="form-control" name="prior_funds_banks" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>110</td>
                            <td>152</td>
                            <td>Short term investments</td>
                            <td><input type="text" class="form-control" name="current_short_term_investments" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_short_term_investments" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>120</td>
                            <td>142</td>
                            <td>Paid short term loans</td>
                            <td><input type="text" class="form-control" name="current_paid_short_term_loans" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_paid_short_term_loans" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>130</td>
                            <td>161</td>
                            <td>Trade receivables</td>
                            <td><input type="text" class="form-control" name="current_trade_receivables" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_trade_receivables" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>140</td>
                            <td>162</td>
                            <td>Receipt papers</td>
                            <td><input type="text" class="form-control" name="current_other_receivables" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_other_receivables" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>150</td>
                            <td></td>
                            <td>Other receivables and prepaid expenses</td>
                            <td><input type="text" class="form-control" name="current_receipt_papers" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_receipt_papers" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>160</td>
                            <td>13</td>
                            <td>Inventory</td>
                            <td><input type="text" class="form-control" name="current_inventory" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_inventory" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>170</td>
                            <td></td>
                            <td>Other short term assets</td>
                            <td><input type="text" class="form-control" name="current_other_short_term_assets" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_other_short_term_assets" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr id="total_current_assets">
                            <td>190</td>
                            <td></td>
                            <td>Total Current Assets</td>
                            <td><input type="text" class="form-control" id="current_total_current_assets" readonly></td>
                            <td><input type="text" class="form-control" id="prior_total_current_assets" readonly value="0"></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <button type="button" class="btn btn-primary next-step">Next</button>   
                <br>
                <br>
            </div>
            <div class="step step-2">
                <table class="custom-table table-bordered table form-table ">
                    <thead >
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Code</th>
                            <th scope="col">Account</th>
                            <th scope="col">Current financial year (amounts in IQD)</th>
                            <th scope="col">Prior financial year (amounts in IQD)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>200</td>
                            <td>151</td>
                            <td>Long term investments</td>
                            <td><input type="text" class="form-control" name="current_long_term_investments" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_long_term_investments" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>210</td>
                            <td>141</td>
                            <td>Long term loans granted</td>
                            <td><input type="text" class="form-control" name="current_long_term_loans_granted" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_long_term_loans_granted" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>220</td>
                            <td></td>
                            <td>Total tangible fixed assets</td>
                            <td><input type="text" class="form-control" name="current_total_tangible_fixed_assets" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_total_tangible_fixed_assets" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>230</td>
                            <td></td>
                            <td>Total depreciation of tangible assets</td>
                            <td><input type="text" class="form-control" name="current_total_depreciation" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_total_depreciation" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>240</td>
                            <td></td>
                            <td>Total intangible fixed assets</td>
                            <td><input type="text" class="form-control" name="current_total_intangible_fixed_assets" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_total_intangible_fixed_assets" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>250</td>
                            <td></td>
                            <td>Total amortization of intangible assets</td>
                            <td><input type="text" class="form-control" name="current_total_amortization" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_total_amortization" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>260</td>
                            <td></td>
                            <td>Other long term assets</td>
                            <td><input type="text" class="form-control" name="current_other_long_term_assets" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_other_long_term_assets" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>290</td>
                            <td></td>
                            <td>Total long term assets</td>
                            <td><input type="text" id="current_total_long_term_assets"  class="form-control" name="current_total_long_term_assets" oninput="formatCurrency(this)" readonly></td>
                            <td><input type="text" id="current_total_long_term_assets"  class="form-control" name="prior_total_long_term_assets" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>300</td>
                            <td></td>
                            <td>Total assets</td>
                            <td><input type="text" class="form-control" id="current_total_assets" name="current_total_assets" oninput="formatCurrency(this)" readonly></td>
                            <td><input type="text" class="form-control" id="prior_total_assets" name="prior_total_assets" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>310</td>
                            <td>25</td>
                            <td>Accounts payable by banks</td>
                            <td><input type="text" class="form-control" name="current_accounts_payable_banks" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_accounts_payable_banks" oninput="formatCurrency(this)" readonly  value="0"></td>
                        </tr>
                        <tr>
                            <td>320</td>
                            <td>261</td>
                            <td>Commercial suppliers</td>
                            <td><input type="text" class="form-control" name="current_commercial_suppliers" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_commercial_suppliers" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>330</td>
                            <td>262</td>
                            <td>Payment papers</td>
                            <td><input type="text" class="form-control" name="current_payment_papers" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_payment_papers" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>340</td>
                            <td></td>
                            <td>Accounts payable-taxes</td>
                            <td><input type="text" class="form-control" name="current_accounts_payable_taxes" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_accounts_payable_taxes" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>350</td>
                            <td>2662</td>
                            <td>Revenues received in advance</td>
                            <td><input type="text" class="form-control" name="current_revenues_received" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_revenues_received" oninput="formatCurrency(this)"readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>360</td>
                            <td></td>
                            <td>Other creditors and accrued expenses</td>
                            <td><input type="text" class="form-control" name="current_other_creditors" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_other_creditors" oninput="formatCurrency(this)"readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>370</td>
                            <td>242</td>
                            <td>Short term loans received</td>
                            <td><input type="text" class="form-control" name="current_short_term_loans_received" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_short_term_loans_received" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <button type="button" class="btn btn-primary prev-step">Previous</button>
                <button type="button" class="btn btn-primary next-step">Next</button> 
                <br>
                <br>
            </div>
            <div class="step step-3">
                <table class="custom-table table-bordered table form-table ">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Code</th>
                            <th scope="col">Account</th>
                            <th scope="col">Current financial year (amounts in IQD)</th>
                            <th scope="col">Prior financial year (amounts in IQD)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>380</td>
                            <td></td>
                            <td>Other short term liabilities</td>
                            <td><input type="text" class="form-control" name="current_other_short_term_liabilities" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_other_short_term_liabilities" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>390</td>
                            <td></td>
                            <td>Total short term liabilities</td>
                            <td><input type="text" class="form-control" id="current_total_short_term_liabilities" name="current_total_short_term_liabilities" oninput="formatCurrency(this)" readonly></td>
                            <td><input type="text" class="form-control" id="prior_total_short_term_liabilities" name="prior_total_short_term_liabilities" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>400</td>
                            <td>241</td>
                            <td>Long term loans received</td>
                            <td><input type="text" class="form-control" name="current_long_term_loans_received" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_long_term_loans_received" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>410</td>
                            <td>23</td>
                            <td>Allocations</td>
                            <td><input type="text" class="form-control" name="current_allocations" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_allocations" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>420</td>
                            <td></td>
                            <td>Other long term liabilities</td>
                            <td><input type="text" class="form-control" name="current_other_long_term_liabilities" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_other_long_term_liabilities" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>430</td>
                            <td></td>
                            <td>Total long term liabilities</td>
                            <td><input type="text" class="form-control" id="current_total_long_term_liabilities" name="current_total_long_term_liabilities" oninput="formatCurrency(this)" readonly></td>
                            <td><input type="text" class="form-control" id="prior_total_long_term_liabilities" name="prior_total_long_term_liabilities" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>500</td>
                            <td></td>
                            <td>Total liabilities</td>
                            <td><input type="text" class="form-control" id="current_total_liabilities" name="current_total_liabilities" oninput="formatCurrency(this)" readonly></td>
                            <td><input type="text" class="form-control" id="prior_total_liabilities" name="prior_total_liabilities" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>510</td>
                            <td></td>
                            <td>Ordinary shares</td>
                            <td><input type="text" class="form-control" name="current_ordinary_shares" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_ordinary_shares" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>520</td>
                            <td></td>
                            <td>Preferred shares</td>
                            <td><input type="text" class="form-control" name="current_preferred_shares" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_preferred_shares" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>530</td>
                            <td></td>
                            <td>Premiums and introductions</td>
                            <td><input type="text" class="form-control" name="current_premiums" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_premiums" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>540</td>
                            <td>22</td>
                            <td>Reserves</td>
                            <td><input type="text" class="form-control" name="current_reserves" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_reserves" oninput="formatCurrency(this)"readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>550</td>
                            <td></td>
                            <td>Surplus/accumulated deficit</td>
                            <td><input type="text" class="form-control" name="current_surplus" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_surplus" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>600</td>
                            <td></td>
                            <td>Total Equity</td>
                            <td><input type="text" class="form-control" id="current_total_equity" name="current_total_equity" oninput="formatCurrency(this)" readonly ></td>
                            <td><input type="text" class="form-control" id="prior_total_equity" name="prior_total_equity" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>700</td>
                            <td></td>
                            <td>Total liabilities and capital</td>
                            <td><input type="text" class="form-control" id="current_total_liabilities_and_capital" name="current_total_liabilities_and_capital" oninput="formatCurrency(this)" readonly></td>
                            <td><input type="text" class="form-control" id="prior_total_liabilities_and_capital" name="prior_total_liabilities_and_capital" oninput="formatCurrency(this)" readonly value="0"></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <button type="button" class="btn btn-primary prev-step">Previous</button>
                <button type="submit" class="btn btn-success">Submit</button>
                <br>
                <br>
            </div>
    </form> 
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add event listeners to all text input fields
        document.querySelectorAll('input[type="text"]').forEach(input => {
            input.addEventListener('input', () => formatCurrency(input));
        });

        calculateTotalCurrentAssets();
        calculateTotalLongTermAssets();
        calculateTotalAssets();
        calculateTotalShorttermLiabilities();
        calculateTotalLongTermLiabilities() ;
        calculateTotalLiabilities();
        calculateTotalEquity();
        calculateTotalLiabilitiesAndCapital();
    });

    function formatCurrency(input) {
        let value = input.value;
        // Replace all commas with empty string
        value = value.replace(/,/g, '');

        // If the value has more than one period, consider only the last one as a decimal point
        const parts = value.split('.');
        if (parts.length > 2) {
            value = parts.slice(0, -1).join('') + '.' + parts.slice(-1);
        }

        // Replace any remaining periods with empty string
        value = value.replace(/\./g, '');

        // Check if the value is a valid number
        if (!isNaN(value)) {
            // Format the value with commas for thousands separator
            input.value = numberWithCommas(value);
        }
        calculateTotalCurrentAssets();
        calculateTotalLongTermAssets();
        calculateTotalAssets();
        calculateTotalShorttermLiabilities();
        calculateTotalLongTermLiabilities() ;
        calculateTotalLiabilities();
        calculateTotalEquity();
        calculateTotalLiabilitiesAndCapital();
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function calculateTotalCurrentAssets() {
        let current_funds_banks = parseFloat(document.querySelector('input[name="current_funds_banks"]').value.replace(/,/g, '')) || 0;
        let current_short_term_investments = parseFloat(document.querySelector('input[name="current_short_term_investments"]').value.replace(/,/g, '')) || 0;
        let current_paid_short_term_loans = parseFloat(document.querySelector('input[name="current_paid_short_term_loans"]').value.replace(/,/g, '')) || 0;
        let current_trade_receivables = parseFloat(document.querySelector('input[name="current_trade_receivables"]').value.replace(/,/g, '')) || 0;
        let current_other_receivables = parseFloat(document.querySelector('input[name="current_other_receivables"]').value.replace(/,/g, '')) || 0;
        let current_receipt_papers = parseFloat(document.querySelector('input[name="current_receipt_papers"]').value.replace(/,/g, '')) || 0;
        let current_inventory = parseFloat(document.querySelector('input[name="current_inventory"]').value.replace(/,/g, '')) || 0;
        let current_other_short_term_assets = parseFloat(document.querySelector('input[name="current_other_short_term_assets"]').value.replace(/,/g, '')) || 0;

        let current_total = current_funds_banks + current_short_term_investments + current_paid_short_term_loans + 
        current_trade_receivables + current_other_receivables + current_receipt_papers + current_inventory +
        current_other_short_term_assets;

        document.getElementById('current_total_current_assets').value = numberWithCommas(current_total.toFixed(0));
    }

    function calculateTotalLongTermAssets() {
        let current_long_term_investments = parseFloat(document.querySelector('input[name="current_long_term_investments"]').value.replace(/,/g, '')) || 0;
        let current_long_term_loans_granted = parseFloat(document.querySelector('input[name="current_long_term_loans_granted"]').value.replace(/,/g, '')) || 0;
        let current_total_tangible_fixed_assets = parseFloat(document.querySelector('input[name="current_total_tangible_fixed_assets"]').value.replace(/,/g, '')) || 0;
        let current_total_depreciation = parseFloat(document.querySelector('input[name="current_total_depreciation"]').value.replace(/,/g, '')) || 0;
        let current_total_intangible_fixed_assets = parseFloat(document.querySelector('input[name="current_total_intangible_fixed_assets"]').value.replace(/,/g, '')) || 0;
        let current_total_amortization = parseFloat(document.querySelector('input[name="current_total_amortization"]').value.replace(/,/g, '')) || 0;
        let current_other_long_term_assets = parseFloat(document.querySelector('input[name="current_other_long_term_assets"]').value.replace(/,/g, '')) || 0;

        let current_total_long_term_assets = current_long_term_investments + current_long_term_loans_granted +
        current_total_tangible_fixed_assets + current_total_depreciation + current_total_intangible_fixed_assets +
        current_total_amortization + current_other_long_term_assets; 

        document.getElementById('current_total_long_term_assets').value = numberWithCommas(current_total_long_term_assets.toFixed(0));
    }

    function calculateTotalAssets() {
        let current_total_current_assets = parseFloat(document.getElementById('current_total_current_assets').value.replace(/,/g, '')) || 0;
        let current_total_long_term_assets = parseFloat(document.getElementById('current_total_long_term_assets').value.replace(/,/g, '')) || 0;

        let total_assets = current_total_current_assets + current_total_long_term_assets;
        document.getElementById('current_total_assets').value = numberWithCommas(total_assets.toFixed(0));
    }
    function calculateTotalShorttermLiabilities() {
        let current_accounts_payable_banks = parseFloat(document.querySelector('input[name="current_accounts_payable_banks"]').value.replace(/,/g, '')) || 0;
        let current_commercial_suppliers = parseFloat(document.querySelector('input[name="current_commercial_suppliers"]').value.replace(/,/g, '')) || 0;
        let current_payment_papers = parseFloat(document.querySelector('input[name="current_payment_papers"]').value.replace(/,/g, '')) || 0;
        let current_accounts_payable_taxes = parseFloat(document.querySelector('input[name="current_accounts_payable_taxes"]').value.replace(/,/g, '')) || 0;
        let current_revenues_received = parseFloat(document.querySelector('input[name="current_revenues_received"]').value.replace(/,/g, '')) || 0;
        let current_other_creditors = parseFloat(document.querySelector('input[name="current_other_creditors"]').value.replace(/,/g, '')) || 0;
        let current_short_term_loans_received = parseFloat(document.querySelector('input[name="current_short_term_loans_received"]').value.replace(/,/g, '')) || 0;
        let current_other_short_term_liabilities = parseFloat(document.querySelector('input[name="current_other_short_term_liabilities"]').value.replace(/,/g, '')) || 0;

        let total_liabilities = current_accounts_payable_banks + current_commercial_suppliers + current_payment_papers +
            current_accounts_payable_taxes + current_revenues_received + current_other_creditors + current_short_term_loans_received +
            current_other_short_term_liabilities;

        document.getElementById('current_total_short_term_liabilities').value = numberWithCommas(total_liabilities.toFixed(0));
    }
    function calculateTotalLongTermLiabilities() {
        let current_long_term_loans_received = parseFloat(document.querySelector('input[name="current_long_term_loans_received"]').value.replace(/,/g, '')) || 0;
        let current_allocations = parseFloat(document.querySelector('input[name="current_allocations"]').value.replace(/,/g, '')) || 0;
        let current_other_long_term_liabilities = parseFloat(document.querySelector('input[name="current_other_long_term_liabilities"]').value.replace(/,/g, '')) || 0;

        let total_long_term_liabilities = current_long_term_loans_received + current_allocations + current_other_long_term_liabilities;

        document.getElementById('current_total_long_term_liabilities').value = numberWithCommas(total_long_term_liabilities.toFixed(0));
    }
    function calculateTotalLiabilities() {
        let current_total_short_term_liabilities = parseFloat(document.querySelector('input[name="current_total_short_term_liabilities"]').value.replace(/,/g, '')) || 0;
        let current_total_long_term_liabilities = parseFloat(document.getElementById('current_total_long_term_liabilities').value.replace(/,/g, '')) || 0;

        let current_total_liabilities = current_total_short_term_liabilities + current_total_long_term_liabilities;

        document.querySelector('input[name="current_total_liabilities"]').value = numberWithCommas(current_total_liabilities.toFixed(0));
    }
    function calculateTotalEquity() {
        let current_ordinary_shares = parseFloat(document.querySelector('input[name="current_ordinary_shares"]').value.replace(/,/g, '')) || 0;
        let current_preferred_shares = parseFloat(document.querySelector('input[name="current_preferred_shares"]').value.replace(/,/g, '')) || 0;
        let current_premiums = parseFloat(document.querySelector('input[name="current_premiums"]').value.replace(/,/g, '')) || 0;
        let current_reserves = parseFloat(document.querySelector('input[name="current_reserves"]').value.replace(/,/g, '')) || 0;
        let current_surplus = parseFloat(document.querySelector('input[name="current_surplus"]').value.replace(/,/g, '')) || 0;

        let current_total_equity = current_ordinary_shares + current_preferred_shares + current_premiums + current_reserves + current_surplus;

        document.getElementById('current_total_equity').value = numberWithCommas(current_total_equity.toFixed(0));
    }


    function calculateTotalLiabilitiesAndCapital() {
        let current_total_equity = parseFloat(document.getElementById('current_total_equity').value.replace(/,/g, '')) || 0;
        let current_total_liabilities = parseFloat(document.getElementById('current_total_liabilities').value.replace(/,/g, '')) || 0;

        let current_total_liabilities_and_capital = current_total_equity + current_total_liabilities;

        document.getElementById('current_total_liabilities_and_capital').value = numberWithCommas(current_total_liabilities_and_capital.toFixed(0));
    }


</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var currentStep = 1;
    
        // Hide all steps except the first one initially
        $('#multi-step-form').find('.step').slice(1).hide();
    
        // Initialize step circles
        updateStepCircles();
    
        $(".next-step").click(function() {
            if (validateStep(currentStep)) {
                if (currentStep < 3) {
                    $(".step-" + currentStep).addClass("animate__animated animate__fadeOutLeft");
                    currentStep++;
                    setTimeout(function() {
                        $(".step").removeClass("animate__animated animate__fadeOutLeft").hide();
                        $(".step-" + currentStep).show().addClass("animate__animated animate__fadeInRight");
                        updateProgressBar();
                        updateStepCircles();
                        window.scrollTo(0, 0);
                    }, 500);
                }
            }
        });
    
        $(".prev-step").click(function() {
            if (currentStep > 1) {
                $(".step-" + currentStep).addClass("animate__animated animate__fadeOutRight");
                currentStep--;
                setTimeout(function() {
                    $(".step").removeClass("animate__animated animate__fadeOutRight").hide();
                    $(".step-" + currentStep).show().addClass("animate__animated animate__fadeInLeft");
                    updateProgressBar();
                    updateStepCircles();
                    window.scrollTo(0, 0);
                }, 500);
            }
        });
    
        function updateProgressBar() {
            var progressPercentage = ((currentStep - 1) / 3) * 100;
            $(".progress-bar").css("width", progressPercentage + "%");
        }
    
        function updateStepCircles() {
            $(".step-circle").removeClass("active completed");
            for (var i = 1; i <= currentStep; i++) {
                $("#step-circle-" + i).addClass(i === currentStep ? "active" : "completed");
            }
        }
    
        function validateStep(step) {
            var isValid = true;
            $(".step-" + step).find('input, select, textarea').each(function() {
                if ($(this).prop('required') && !$(this).val()) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
            return isValid;
        }
    });
</script>
    
    
@endsection