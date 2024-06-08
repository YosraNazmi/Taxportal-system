@extends('Taxpayer.AnnualTaxForm')
@section('FormE')
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
        <div style="background-color: #1e3e54 ;"  class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="step-container d-flex justify-content-between">
        <div class="step-circle" id="step-circle-1" onclick="displayStep(1)">1</div>
        <div class="step-circle" id="step-circle-2" onclick="displayStep(2)">2</div>
        <div class="step-circle" id="step-circle-3" onclick="displayStep(3)">3</div>
        <div class="step-circle" id="step-circle-3" onclick="displayStep(4)">4</div>
    </div>
    <form action="{{route('appendixTwo.store')}}" method="POST" id="multi-step-form">
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
                        <td>41</td>
                        <td>Revenue of commodity activity</td>
                        <td><input type="text" class="form-control" name="current_revenue_of_comodity" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_revenue_of_comodity" oninput="formatCurrency(this)" readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>110</td>
                        <td>42</td>
                        <td>Business income	</td>
                        <td><input type="text" class="form-control" name="current_Business_income" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_Business income" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>120</td>
                        <td>43</td>
                        <td>Revenue from business activity</td>
                        <td><input type="text" class="form-control" name="curent_Revenue_from_business_activity" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_paid_Revenue_from_business" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>130</td>
                        <td>44</td>
                        <td>Operating income for others	</td>
                        <td><input type="text" class="form-control" name="current_operating_income_for_others" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_operating_income_for_others" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>140</td>
                        <td>46</td>
                        <td>Interest income and land rents</td>
                        <td><input type="text" class="form-control" name="current_interest_income_and_land_rents" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_interest_income_and_land_rents" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>150</td>
                        <td>47</td>
                        <td>Subsidies income</td>
                        <td><input type="text" class="form-control" name="current_Subsidies_income" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_Subsidies_income" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>160</td>
                        <td>48</td>
                        <td>Convertible income</td>
                        <td><input type="text" class="form-control" name="current_Convertible_income" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_Convertible_income" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>170</td>
                        <td>49</td>
                        <td>Other income</td>
                        <td><input type="text" class="form-control" name="current_Other_income" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_Other_income" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>180</td>
                        <td></td>
                        <td>Total revenue</td>
                        <td><input type="text" class="form-control" name="current_total_revenue" id="current_total_revenue" oninput="formatCurrency(this)" readonly></td>
                        <td><input type="text" class="form-control" name="prior_total_revenue" id="prior_total_revenue" oninput="formatCurrency(this)" readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>190</td>
                        <td>151</td>
                        <td>Cost of goods sold</td>
                        <td><input type="text" class="form-control" name="current_Cost_of_goods_sold" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_Cost_of_goods_sold" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>200</td>
                        <td>141</td>
                        <td>Total profit/loss</td>
                        <td><input type="text" class="form-control" name="current_Total_profit_loss" id="current_Total_profit_loss" oninput="formatCurrency(this)" readonly></td>
                        <td><input type="text" class="form-control" name="prior_Total_profit_loss" id="prior_Total_profit_loss" oninput="formatCurrency(this)" readonly value="0"></td>
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
                        <td>210</td>
                        <td>31</td>
                        <td>Salaries and wages</td>
                        <td><input type="text" class="form-control" name="current_salaries_and_wages" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_salaries_and_wages" oninput="formatCurrency(this)" readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>220</td>
                        <td>32</td>
                        <td>Commodity supplies</td>
                        <td><input type="text" class="form-control" name="current_commodity_supplies" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_commodity_supplies" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>230</td>
                        <td>331</td>
                        <td>Maintenance services</td>
                        <td><input type="text" class="form-control" name="current_maintenance_services" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_maintenance_services" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>240</td>
                        <td>332</td>
                        <td>Research and consulting services</td>
                        <td><input type="text" class="form-control" name="current_research_and_consulting_services" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_research_and_consulting_services" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>250</td>
                        <td>333</td>
                        <td>Advertising, printing, and hospitality</td>
                        <td><input type="text" class="form-control" name="current_advertising_and_hospitality" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_advertising_and_hospitality" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>260</td>
                        <td>334</td>
                        <td>Transport, delegations, and communications</td>
                        <td><input type="text" class="form-control" name="current_transport_and_communications" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_transport_and_communications" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>270</td>
                        <td>335</td>
                        <td>Rental of fixed assets</td>
                        <td><input type="text" class="form-control" name="current_rental_of_fixed_assets" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_rental_of_fixed_assets" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>280</td>
                        <td>362</td>
                        <td>Rental of land</td>
                        <td><input type="text" class="form-control" name="current_rental_of_land" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_rental_of_land" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>290</td>
                        <td>3361</td>
                        <td>Expenses of subscriptions and affiliations</td>
                        <td><input type="text" class="form-control" name="current_expenses_of_subscriptions" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_expenses_of_subscriptions" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>300</td>
                        <td>3362</td>
                        <td>Insurance expenses</td>
                        <td><input type="text" class="form-control" name="current_insurance_expenses" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_insurance_expenses" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>310</td>
                        <td>3363</td>
                        <td>Reward for non-workers for services rendered</td>
                        <td><input type="text" class="form-control" name="current_reward_for_non_workers" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_reward_for_non_workers" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>320</td>
                        <td>3364</td>
                        <td>Taxes and fees paid to foreign parties</td>
                        <td><input type="text" class="form-control" name="current_taxes_and_fees" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_taxes_and_fees" oninput="formatCurrency(this)"readonly value="0"></td>
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
                        <td>330</td>
                        <td>3365</td>
                        <td>Legal services expenses</td>
                        <td><input type="text" class="form-control" name="current_legal_services_expenses" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_legal_services_expenses" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>340</td>
                        <td>3366</td>
                        <td>Banking services expenses</td>
                        <td><input type="text" class="form-control" name="current_banking_services_expenses" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_banking_services_expenses" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>350</td>
                        <td>3367</td>
                        <td>Training and rehabilitation expenses</td>
                        <td><input type="text" class="form-control" name="current_training_and_rehabilitation_expenses" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_training_and_rehabilitation_expenses" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>360</td>
                        <td>3369</td>
                        <td>Other service expenses</td>
                        <td><input type="text" class="form-control" name="current_other_service_expenses" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_other_service_expenses" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>370</td>
                        <td>34</td>
                        <td>Contracting and services</td>
                        <td><input type="text" class="form-control" name="current_contracting_and_services" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_contracting_and_services" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>380</td>
                        <td>3611</td>
                        <td>Interest Local</td>
                        <td><input type="text" class="form-control" name="current_interest_local" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_interest_local" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>390</td>
                        <td>3612</td>
                        <td>Interest abroad</td>
                        <td><input type="text" class="form-control" name="current_interest_abroad" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_interest_abroad" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>400</td>
                        <td>37</td>
                        <td>Depreciations</td>
                        <td><input type="text" class="form-control" name="current_depreciations" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_depreciations" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>410</td>
                        <td>381</td>
                        <td>Expenditure on retirement and social security expenses</td>
                        <td><input type="text" class="form-control" name="current_retirement_and_social_security_expenses" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_retirement_and_social_security_expenses" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>420</td>
                        <td>382</td>
                        <td>Expenses to contribute to the expenses of a parent company/subsidiary/sister</td>
                        <td><input type="text" class="form-control" name="current_expenses_to_contribute" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_expenses_to_contribute" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>430</td>
                            <td>3831</td>
                            <td>Donation photographers</td>
                            <td><input type="text" class="form-control" name="current_donation_photographers" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_donation_photographers" oninput="formatCurrency(this)"readonly value="0"></td>
                        </tr>
                    <tr>
                        <td>440</td>
                        <td>3832</td>
                            <td>Compensation expenses and fines</td>
                            <td><input type="text" class="form-control" name="current_compensation_expenses" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_compensation_expenses" oninput="formatCurrency(this)"readonly value="0"></td>
                        </tr>
                        <tr>
                            <td>450</td>
                            <td>3833</td>
                            <td>Bad debts</td>
                            <td><input type="text" class="form-control" name="current_bad_debts" oninput="formatCurrency(this)"></td>
                            <td><input type="text" class="form-control" name="prior_bad_debts" oninput="formatCurrency(this)"readonly value="0"></td>
                        </tr>
                        
                </tbody>
            </table>
            <button type="button" class="btn btn-primary prev-step">Previous</button>
            <button type="button" class="btn btn-primary next-step">Next</button> 
        </div>
        <div class="step step-4">
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
                        <td>460</td>
                        <td>3833</td>
                        <td>Expenses for special services expenses</td>
                        <td><input type="text" class="form-control" name="current_expenses_for_special_services" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_expenses_for_special_services" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>470</td>
                        <td></td>
                        <td>Other transfer expenses</td>
                        <td><input type="text" class="form-control" name="current_other_transfer_expenses" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_other_transfer_expenses" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>480</td>
                        <td>484</td>
                        <td>Taxes and expenses</td>
                        <td><input type="text" class="form-control" name="current_taxes_and_expenses" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_taxes_and_expenses" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>490</td>
                        <td>385</td>
                        <td>Subsidies expenses</td>
                        <td><input type="text" class="form-control" name="current_subsidies_expenses" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_subsidies_expenses" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>500</td>
                        <td>391</td>
                        <td>Expenses of previous expenses</td>
                        <td><input type="text" class="form-control" name="current_expenses_of_previous" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_expenses_of_previous" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>510</td>
                        <td>392</td>
                        <td>Incidental expenses</td>
                        <td><input type="text" class="form-control" name="current_incidental_expenses" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_incidental_expenses" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>520</td>
                        <td>393</td>
                        <td>Capital loses</td>
                        <td><input type="text" class="form-control" name="current_capital_losses" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_capital_losses" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>530</td>
                        <td>394</td>
                        <td>Expected loses for projects under construction</td>
                        <td><input type="text" class="form-control" name="current_expected_losses" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_expected_losses" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>540</td>
                        <td>395</td>
                        <td>Potential maintenance expenses</td>
                        <td><input type="text" class="form-control" name="current_potential_maintenance" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_potential_maintenance" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>550</td>
                        <td>396</td>
                        <td>Loss of commodity price</td>
                        <td><input type="text" class="form-control" name="current_loss_of_commodity" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_loss_of_commodity" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>560</td>
                        <td>397</td>
                        <td>Losses of financial investment prices</td>
                        <td><input type="text" class="form-control" name="current_losses_of_investment" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_losses_of_investment" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>570</td>
                        <td></td>
                        <td>Other expenses</td>
                        <td><input type="text" class="form-control" name="current_other_expenses" oninput="formatCurrency(this)"></td>
                        <td><input type="text" class="form-control" name="prior_other_expenses" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>600</td>
                        <td></td>
                        <td>Total expenditure</td>
                        <td><input type="text" class="form-control" id="current_total_expenditure" name="current_total_expenditure" oninput="formatCurrency(this)" readonly></td>
                        <td><input type="text" class="form-control" id="prior_total_expenditure" name="prior_total_expenditure" oninput="formatCurrency(this)" readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>610</td>
                        <td></td>
                        <td>Net profit before tax</td>
                        <td><input type="text" class="form-control" id="current_net_profit_before_tax" name="current_net_profit_before_tax" oninput="formatCurrency(this)" readonly></td>
                        <td><input type="text" class="form-control" id="prior_net_profit_before_tax" name="prior_net_profit_before_tax" oninput="formatCurrency(this)" readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>620</td>
                        <td></td>
                        <td>Income tax</td>
                        <td><input type="text" class="form-control" id="current_income_tax" name="current_income_tax" oninput="formatCurrency(this)" readonly></td>
                        <td><input type="text" class="form-control" id="prior_income_tax" name="prior_income_tax" oninput="formatCurrency(this)"readonly value="0"></td>
                    </tr>
                    <tr>
                        <td>700</td>
                        <td></td>
                        <td>Net profit</td>
                        <td><input type="text" class="form-control" id="current_net_profit" name="current_net_profit" oninput="formatCurrency(this)" readonly></td>
                        <td><input type="text" class="form-control" id="prior_net_profit" name="prior_net_profit" oninput="formatCurrency(this)" readonly value="0"></td>
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
    document.addEventListener("DOMContentLoaded", function() {
        var currentStep = 1;
    
        // Hide all steps except the first one initially
        $('#multi-step-form').find('.step').slice(1).hide();
    
        // Initialize step circles
        updateStepCircles();
    
        $(".next-step").click(function() {
            if (validateStep(currentStep)) {
                if (currentStep < 4) {
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
            var progressPercentage = ((currentStep - 1) / 4) * 100;
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add event listeners to all text input fields
        document.querySelectorAll('input[type="text"]').forEach(input => {
            input.addEventListener('input', () => formatCurrency(input));
        });
        calculateTotalRevenue();
        calculateTotalProfit();
        calculateTotalExpenditure();
        calculateNetProfitBeforeTax();
        calculateIncomeTax();
        calculateNetProfit();
    });

    function formatCurrency(input) {
        let value = input.value;
        // Remove all non-numeric characters
        value = value.replace(/[^\d.]/g, '');
        // Format the number with commas every three digits
        value = numberWithCommas(value);
        input.value = value;

        calculateTotalRevenue();
        calculateTotalProfit();
        calculateTotalExpenditure();
        calculateNetProfitBeforeTax();
        calculateIncomeTax();
        calculateNetProfit();
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function calculateTotalRevenue() {
        let current_revenue_of_comodity = parseFloat(document.querySelector('input[name="current_revenue_of_comodity"]').value.replace(/,/g, '')) || 0;
        let current_Business_income = parseFloat(document.querySelector('input[name="current_Business_income"]').value.replace(/,/g, '')) || 0;
        let current_Revenue_from_business_activity = parseFloat(document.querySelector('input[name="curent_Revenue_from_business_activity"]').value.replace(/,/g, '')) || 0;
        let current_operating_income_for_others = parseFloat(document.querySelector('input[name="current_operating_income_for_others"]').value.replace(/,/g, '')) || 0;
        let current_interest_income_and_land_rents = parseFloat(document.querySelector('input[name="current_interest_income_and_land_rents"]').value.replace(/,/g, '')) || 0;
        let current_Subsidies_income = parseFloat(document.querySelector('input[name="current_Subsidies_income"]').value.replace(/,/g, '')) || 0;
        let current_Convertible_income = parseFloat(document.querySelector('input[name="current_Convertible_income"]').value.replace(/,/g, '')) || 0;
        let current_Other_income = parseFloat(document.querySelector('input[name="current_Other_income"]').value.replace(/,/g, '')) || 0;

        let totalRevenue = current_revenue_of_comodity + current_Business_income + current_Revenue_from_business_activity + current_operating_income_for_others + current_interest_income_and_land_rents + current_Subsidies_income + current_Convertible_income + current_Other_income;

        document.getElementById('current_total_revenue').value = numberWithCommas(totalRevenue.toFixed(0));
    }

    function calculateTotalProfit() {
        let current_Cost_of_goods_sold = parseFloat(document.querySelector('input[name="current_Cost_of_goods_sold"]').value.replace(/,/g, '')) || 0;
        let current_total_revenue = parseFloat(document.getElementById('current_total_revenue').value.replace(/,/g, '')) || 0;

        let totalProfit = current_total_revenue - current_Cost_of_goods_sold;

        document.getElementById('current_Total_profit_loss').value = numberWithCommas(totalProfit.toFixed(0));
    }

    function calculateTotalExpenditure() {
        let current_salaries_and_wages = parseFloat(document.querySelector('input[name="current_salaries_and_wages"]').value.replace(/,/g, '')) || 0;
        let current_commodity_supplies = parseFloat(document.querySelector('input[name="current_commodity_supplies"]').value.replace(/,/g, '')) || 0;
        let current_maintenance_services = parseFloat(document.querySelector('input[name="current_maintenance_services"]').value.replace(/,/g, '')) || 0;
        let current_research_and_consulting_services = parseFloat(document.querySelector('input[name="current_research_and_consulting_services"]').value.replace(/,/g, '')) || 0;
        let current_advertising_and_hospitality = parseFloat(document.querySelector('input[name="current_advertising_and_hospitality"]').value.replace(/,/g, '')) || 0;
        let current_transport_and_communications = parseFloat(document.querySelector('input[name="current_transport_and_communications"]').value.replace(/,/g, '')) || 0;
        let current_rental_of_fixed_assets = parseFloat(document.querySelector('input[name="current_rental_of_fixed_assets"]').value.replace(/,/g, '')) || 0;
        let current_rental_of_land = parseFloat(document.querySelector('input[name="current_rental_of_land"]').value.replace(/,/g, '')) || 0;
        let current_expenses_of_subscriptions = parseFloat(document.querySelector('input[name="current_expenses_of_subscriptions"]').value.replace(/,/g, '')) || 0;
        let current_insurance_expenses = parseFloat(document.querySelector('input[name="current_insurance_expenses"]').value.replace(/,/g, '')) || 0;
        let current_reward_for_non_workers = parseFloat(document.querySelector('input[name="current_reward_for_non_workers"]').value.replace(/,/g, '')) || 0;
        let current_taxes_and_fees = parseFloat(document.querySelector('input[name="current_taxes_and_fees"]').value.replace(/,/g, '')) || 0;
        let current_legal_services_expenses = parseFloat(document.querySelector('input[name="current_legal_services_expenses"]').value.replace(/,/g, '')) || 0;
        let current_banking_services_expenses = parseFloat(document.querySelector('input[name="current_banking_services_expenses"]').value.replace(/,/g, '')) || 0;
        let current_training_and_rehabilitation_expenses = parseFloat(document.querySelector('input[name="current_training_and_rehabilitation_expenses"]').value.replace(/,/g, '')) || 0;
        let current_other_service_expenses = parseFloat(document.querySelector('input[name="current_other_service_expenses"]').value.replace(/,/g, '')) || 0;
        let current_contracting_and_services = parseFloat(document.querySelector('input[name="current_contracting_and_services"]').value.replace(/,/g, '')) || 0;
        let current_interest_local = parseFloat(document.querySelector('input[name="current_interest_local"]').value.replace(/,/g, '')) || 0;
        let current_interest_abroad = parseFloat(document.querySelector('input[name="current_interest_abroad"]').value.replace(/,/g, '')) || 0;
        let current_depreciations = parseFloat(document.querySelector('input[name="current_depreciations"]').value.replace(/,/g, '')) || 0;
        let current_retirement_and_social_security_expenses = parseFloat(document.querySelector('input[name="current_retirement_and_social_security_expenses"]').value.replace(/,/g, '')) || 0;
        let current_expenses_to_contribute = parseFloat(document.querySelector('input[name="current_expenses_to_contribute"]').value.replace(/,/g, '')) || 0;
        let current_donation_photographers = parseFloat(document.querySelector('input[name="current_donation_photographers"]').value.replace(/,/g, '')) || 0;
        let current_compensation_expenses = parseFloat(document.querySelector('input[name="current_compensation_expenses"]').value.replace(/,/g, '')) || 0;
        let current_bad_debts = parseFloat(document.querySelector('input[name="current_bad_debts"]').value.replace(/,/g, '')) || 0;
        let current_expenses_for_special_services = parseFloat(document.querySelector('input[name="current_expenses_for_special_services"]').value.replace(/,/g, '')) || 0;
        let current_other_transfer_expenses = parseFloat(document.querySelector('input[name="current_other_transfer_expenses"]').value.replace(/,/g, '')) || 0;
        let current_taxes_and_expenses = parseFloat(document.querySelector('input[name="current_taxes_and_expenses"]').value.replace(/,/g, '')) || 0;
        let current_subsidies_expenses = parseFloat(document.querySelector('input[name="current_subsidies_expenses"]').value.replace(/,/g, '')) || 0;
        let current_expenses_of_previous = parseFloat(document.querySelector('input[name="current_expenses_of_previous"]').value.replace(/,/g, '')) || 0;
        let current_incidental_expenses = parseFloat(document.querySelector('input[name="current_incidental_expenses"]').value.replace(/,/g, '')) || 0;
        let current_capital_losses = parseFloat(document.querySelector('input[name="current_capital_losses"]').value.replace(/,/g, '')) || 0;
        let current_expected_losses = parseFloat(document.querySelector('input[name="current_expected_losses"]').value.replace(/,/g, '')) || 0;
        let current_potential_maintenance = parseFloat(document.querySelector('input[name="current_potential_maintenance"]').value.replace(/,/g, '')) || 0;
        let current_loss_of_commodity = parseFloat(document.querySelector('input[name="current_loss_of_commodity"]').value.replace(/,/g, '')) || 0;
        let current_losses_of_investment = parseFloat(document.querySelector('input[name="current_losses_of_investment"]').value.replace(/,/g, '')) || 0;
        let current_other_expenses = parseFloat(document.querySelector('input[name="current_other_expenses"]').value.replace(/,/g, '')) || 0;

        // Calculate total expenditure
        let totalExpenditure = current_salaries_and_wages + current_commodity_supplies + current_maintenance_services + current_research_and_consulting_services + current_advertising_and_hospitality + current_transport_and_communications + current_rental_of_fixed_assets + current_rental_of_land + current_expenses_of_subscriptions + current_insurance_expenses + current_reward_for_non_workers + current_taxes_and_fees + current_legal_services_expenses + current_banking_services_expenses + current_training_and_rehabilitation_expenses + current_other_service_expenses + current_contracting_and_services + current_interest_local + current_interest_abroad + current_depreciations + current_retirement_and_social_security_expenses + current_expenses_to_contribute + current_donation_photographers + current_compensation_expenses + current_bad_debts + current_expenses_for_special_services + current_other_transfer_expenses + current_taxes_and_expenses + current_subsidies_expenses + current_expenses_of_previous + current_incidental_expenses + current_capital_losses + current_expected_losses + current_potential_maintenance + current_loss_of_commodity + current_losses_of_investment + current_other_expenses;

        document.getElementById("current_total_expenditure").value = numberWithCommas(totalExpenditure.toFixed(0));
    }

    function calculateNetProfitBeforeTax() {
        let current_Total_profit_loss = parseFloat(document.getElementById("current_Total_profit_loss").value.replace(/,/g, '')) || 0;
        let current_total_expenditure = parseFloat(document.getElementById('current_total_expenditure').value.replace(/,/g, '')) || 0;

        // Calculate net profit before tax
        let current_net_profit_before_tax = current_Total_profit_loss - current_total_expenditure;

        // Format the net profit before tax
        document.getElementById("current_net_profit_before_tax").value = numberWithCommas(current_net_profit_before_tax.toFixed(0));
    }
    function calculateIncomeTax() {
        let current_net_profit_before_tax = parseFloat(document.getElementById('current_net_profit_before_tax').value.replace(/,/g, '')) || 0;
        let TotalIncomeTax = current_net_profit_before_tax * 0.15;

        document.getElementById('current_income_tax').value = numberWithCommas(TotalIncomeTax.toFixed(0));
    }
    function calculateNetProfit() {
        let current_net_profit_before_tax = parseFloat(document.getElementById('current_net_profit_before_tax').value.replace(/,/g, '')) || 0;
        let current_income_tax = parseFloat(document.getElementById('current_income_tax').value.replace(/,/g, '')) || 0;

        let TotalNetProfit = current_net_profit_before_tax - current_income_tax;

        document.getElementById('current_net_profit').value = numberWithCommas(TotalNetProfit.toFixed(0));
    }

</script>
 @endsection

