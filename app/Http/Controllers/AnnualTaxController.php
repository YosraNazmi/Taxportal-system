<?php

namespace App\Http\Controllers;

use App\Models\AnnualForms;
use App\Models\AppendixEight;
use App\Models\AppendixEightB;
use App\Models\AppendixEightC;
use App\Models\AppendixEighteen;
use App\Models\AppendixEleven;
use App\Models\AppendixFifteen;
use App\Models\AppendixFive;
use App\Models\AppendixFour;
use App\Models\AppendixFourteen;
use App\Models\AppendixFourteenB;
use App\Models\AppendixNine;
use App\Models\AppendixNineB;
use App\Models\AppendixNineteen;
use App\Models\AppendixSeven;
use App\Models\AppendixSeventeen;
use App\Models\AppendixSix;
use App\Models\AppendixSixteen;
use App\Models\AppendixTen;
use App\Models\AppendixThirteen;
use App\Models\AppendixThree;
use App\Models\AppendixTwelve;
use App\Models\AppendixTwenty;
use App\Models\AppendixTwentyB;
use App\Models\AppendixTwentyFive;
use App\Models\AppendixTwentyFour;
use App\Models\AppendixTwentyOne;
use App\Models\AppendixTwentySeven;
use App\Models\AppendixTwentySix;
use App\Models\AppendixTwentyThree;
use App\Models\AppendixTwentyTwo;
use App\Models\FormA;
use App\Models\FormB;
use App\Models\FormD;
use App\Models\FormE;
use App\Models\IntangibleAsset;
use App\Models\TangibleAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\Nullable;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;

class AnnualTaxController extends Controller
{
    //

    public function viewAnnualTaxForm()
    {
        $user = Auth::user();
        $currentYear = date('Y');

        // Check if the user has already submitted the form for the current year
        $existingForm = AnnualForms::where('user_id', $user->id)
                        ->whereYear('created_at', $currentYear)
                        ->first();

        if ($existingForm) {
            return redirect()->back()->with('error', 'You have already submitted the form for this year.');
        }
        return view('Taxpayer.AnnualTaxForm');
    }

    public function submitAnnualForm(Request $request)
    {
        $user = Auth::user();
        $currentYear = date('Y');

        

        // Validate and save the form data
        $validatedData = $request->validate([
            'uen' => 'required|string|max:255',
            'financialYearFrom' => 'required|date',
            'financialYearTo' => 'required|date|after_or_equal:financialYearFrom',
            'companyName' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postalCode' => 'required|string|max:10',
            'phone1' => 'required|string|max:15',
            'phone2' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'legalStructureChange' => 'required|in:yes,no',
            'legalStructureChangeDate' => 'nullable|date|required_if:legalStructureChange,yes',
            'newLegalStructure' => 'nullable|string|max:255|required_if:legalStructureChange,yes',
            'mainActivityChange' => 'required|in:yes,no',
            'mainActivityChangeSpecify' => 'nullable|string|max:255|required_if:mainActivityChange,yes',
            'companyConsolidated' => 'required|in:yes,no',
            'companyConsolidationDate' => 'nullable|date|required_if:companyConsolidated,yes',
            'subsidiaryLiquidated' => 'required|in:yes,no',
            'branchClosed' => 'required|in:yes,no',
            'companyLiquidated' => 'required|in:yes,no',
            'accountingSystem' => 'array',
            'accountingSystem.*' => 'in:Manual,Machine',
            // New validation rules for Tax Calculation section
            'netTaxableIncome' => 'required|numeric|min:0',
            'previousYearsLosses' => 'required|numeric|min:0',
            'taxableIncome' => 'required|numeric|min:0',
            'taxRatio' => 'required|string|max:10', // Assuming taxRatio is a string like '15%'
            'toBePaidTax' => 'required|numeric|min:0',
            'foreignTaxAdoption' => 'required|numeric|min:0',
            'taxDeducted' => 'required|numeric|min:0',
            'netPayableTax' => 'required|numeric|min:0',
            // New validation rules for Submission of the Declaration section
            'execManagerName' => 'required|string|max:255',
            'execManagerSignature' => 'required|string|max:255',
            'execManagerDate' => 'required|date',
            // New validation rules for Auditor Information section
            'auditorName' => 'required|string|max:255',
            'auditorPhone' => 'required|string|max:15',
            'auditorEmail' => 'required|email|max:255',
            // New validation rules for Administration Specific section
            'inwardNumber' => 'required|string|max:255',
            'inwardDate' => 'required|date',
            'employeeName' => 'required|string|max:255',
            'entryDate' => 'required|date',
            'adminSignature' => 'required|string|max:255',
            // New validation rules for Annexes section
            'annexes' => 'required|array',
            'annexes.*' => 'required|in:1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27',
            // Validation rules for General Budget Statement table
            'current_funds_banks' => 'nullable|numeric|min:0',
            'prior_funds_banks' => 'nullable|numeric|min:0',
            'current_short_term_investments' => 'nullable|numeric|min:0',
            'prior_short_term_investments' => 'nullable|numeric|min:0',
            'current_paid_short_term_loans' => 'nullable|numeric|min:0',
            'prior_paid_short_term_loans' => 'nullable|numeric|min:0',
            'current_trade_receivables' => 'nullable|numeric|min:0',
            'prior_trade_receivables' => 'nullable|numeric|min:0',
            'current_other_receivables' => 'nullable|numeric|min:0',
            'prior_other_receivables' => 'nullable|numeric|min:0',
            'current_receipt_papers' => 'nullable|numeric|min:0',
            'prior_receipt_papers' => 'nullable|numeric|min:0',
            'current_inventory' => 'nullable|numeric|min:0',
            'prior_inventory' => 'nullable|numeric|min:0',
            'current_other_short_term_assets' => 'nullable|numeric|min:0',
            'prior_other_short_term_assets' => 'nullable|numeric|min:0',
            'current_total_current_assets' => 'nullable|numeric|min:0',
            'prior_total_current_assets' => 'nullable|numeric|min:0',
            'current_long_term_investments' => 'nullable|numeric|min:0',
            'prior_long_term_investments' => 'nullable|numeric|min:0',
            'current_long_term_loans_granted' => 'nullable|numeric|min:0',
            'prior_long_term_loans_granted' => 'nullable|numeric|min:0',
            'current_total_tangible_fixed_assets' => 'nullable|numeric|min:0',
            'prior_total_tangible_fixed_assets' => 'nullable|numeric|min:0',
            'current_total_depreciation' => 'nullable|numeric|min:0',
            'prior_total_depreciation' => 'nullable|numeric|min:0',
            'current_total_intangible_fixed_assets' => 'nullable|numeric|min:0',
            'prior_total_intangible_fixed_assets' => 'nullable|numeric|min:0',
            'current_total_amortization' => 'nullable|numeric|min:0',
            'prior_total_amortization' => 'nullable|numeric|min:0',
            'current_other_long_term_assets' => 'nullable|numeric|min:0',
            'prior_other_long_term_assets' => 'nullable|numeric|min:0',
            'current_total_long_term_assets' => 'nullable|numeric|min:0',
            'prior_total_long_term_assets' => 'nullable|numeric|min:0',
            'current_total_assets' => 'nullable|numeric|min:0',
            'prior_total_assets' => 'nullable|numeric|min:0',
            'current_accounts_payable_banks' => 'nullable|numeric|min:0',
            'prior_accounts_payable_banks' => 'nullable|numeric|min:0',
            'current_commercial_suppliers' => 'nullable|numeric|min:0',
            'prior_commercial_suppliers' => 'nullable|numeric|min:0',
            'current_payment_papers' => 'nullable|numeric|min:0',
            'prior_payment_papers' => 'nullable|numeric|min:0',
            'current_accounts_payable_taxes' => 'nullable|numeric|min:0',
            'prior_accounts_payable_taxes' => 'nullable|numeric|min:0',
            'current_revenues_received' => 'nullable|numeric|min:0',
            'prior_revenues_received' => 'nullable|numeric|min:0',
            'current_other_creditors' => 'nullable|numeric|min:0',
            'prior_other_creditors' => 'nullable|numeric|min:0',
            'current_short_term_loans_received' => 'nullable|numeric|min:0',
            'prior_short_term_loans_received' => 'nullable|numeric|min:0',
            'current_other_short_term_liabilities' => 'nullable|numeric|min:0',
            'prior_other_short_term_liabilities' => 'nullable|numeric|min:0',
            'current_total_short_term_liabilities' => 'nullable|numeric|min:0',
            'prior_total_short_term_liabilities' => 'nullable|numeric|min:0',
            'current_long_term_loans_received' => 'nullable|numeric|min:0',
            'prior_long_term_loans_received' => 'nullable|numeric|min:0',
            'current_allocations' => 'nullable|numeric|min:0',
            'prior_allocations' => 'nullable|numeric|min:0',
            'current_other_long_term_liabilities' => 'nullable|numeric|min:0',
            'prior_other_long_term_liabilities' => 'nullable|numeric|min:0',
            'current_total_long_term_liabilities' => 'nullable|numeric|min:0',
            'prior_total_long_term_liabilities' => 'nullable|numeric|min:0',
            'current_total_liabilities' => 'nullable|numeric|min:0',
            'prior_total_liabilities' => 'nullable|numeric|min:0',
            'current_paid_up_capital' => 'nullable|numeric|min:0',
            'prior_paid_up_capital' => 'nullable|numeric|min:0',
            'current_legal_reserve' => 'nullable|numeric|min:0',
            'prior_legal_reserve' => 'nullable|numeric|min:0',
            'current_total_other_capital' => 'nullable|numeric|min:0',
            'prior_total_other_capital' => 'nullable|numeric|min:0',
            'current_total_capital' => 'nullable|numeric|min:0',
            'prior_total_capital' => 'nullable|numeric|min:0',
            'current_total_liabilities_capital' => 'nullable|numeric|min:0',
            'prior_total_liabilities_capital' => 'nullable|numeric|min:0',

            'current_funds_banks' => 'nullable|numeric',
            'prior_funds_banks' => 'nullable|numeric',
            'current_short_term_investments' => 'nullable|numeric',
            'prior_short_term_investments' => 'nullable|numeric',
            'current_paid_short_term_loans' => 'nullable|numeric',
            'prior_paid_short_term_loans' => 'nullable|numeric',
            'current_trade_receivables' => 'nullable|numeric',
            'prior_trade_receivables' => 'nullable|numeric',
            'current_other_receivables' => 'nullable|numeric',
            'prior_other_receivables' => 'nullable|numeric',
            'current_receipt_papers' => 'nullable|numeric',
            'prior_receipt_papers' => 'nullable|numeric',
            'current_inventory' => 'nullable|numeric',
            'prior_inventory' => 'nullable|numeric',
            'current_other_short_term_assets' => 'nullable|numeric',
            'prior_other_short_term_assets' => 'nullable|numeric',
            'current_total_current_assets' => 'nullable|numeric',
            'prior_total_current_assets' => 'nullable|numeric',
            'current_long_term_investments' => 'nullable|numeric',
            'prior_long_term_investments' => 'nullable|numeric',
            'current_long_term_loans_granted' => 'nullable|numeric',
            'prior_long_term_loans_granted' => 'nullable|numeric',
            'current_total_tangible_fixed_assets' => 'nullable|numeric',
            'prior_total_tangible_fixed_assets' => 'nullable|numeric',
            'current_total_depreciation' => 'nullable|numeric',
            'prior_total_depreciation' => 'nullable|numeric',
            'current_total_intangible_fixed_assets' => 'nullable|numeric',
            'prior_total_intangible_fixed_assets' => 'nullable|numeric',
            'current_total_amortization' => 'nullable|numeric',
            'prior_total_amortization' => 'nullable|numeric',
            'current_other_long_term_assets' => 'nullable|numeric',
            'prior_other_long_term_assets' => 'nullable|numeric',
            'current_total_long_term_assets' => 'nullable|numeric',
            'prior_total_long_term_assets' => 'nullable|numeric',
            'current_total_assets' => 'nullable|numeric',
            'prior_total_assets' => 'nullable|numeric',
            'current_accounts_payable_banks' => 'nullable|numeric',
            'prior_accounts_payable_banks' => 'nullable|numeric',
            'current_commercial_suppliers' => 'nullable|numeric',
            'prior_commercial_suppliers' => 'nullable|numeric',
            'current_payment_papers' => 'nullable|numeric',
            'prior_payment_papers' => 'nullable|numeric',
            'current_accounts_payable_taxes' => 'nullable|numeric',
            'prior_accounts_payable_taxes' => 'nullable|numeric',
            'current_revenues_received' => 'nullable|numeric',
            'prior_revenues_received' => 'nullable|numeric',
            'current_other_creditors' => 'nullable|numeric',
            'prior_other_creditors' => 'nullable|numeric',
            'current_short_term_loans_received' => 'nullable|numeric',
            'prior_short_term_loans_received' => 'nullable|numeric',
            'current_other_short_term_liabilities' => 'nullable|numeric',
            'prior_other_short_term_liabilities' => 'nullable|numeric',
            'current_total_short_term_liabilities' => 'nullable|numeric',
            'prior_total_short_term_liabilities' => 'nullable|numeric',
            'current_long_term_loans_received' => 'nullable|numeric',
            'prior_long_term_loans_received' => 'nullable|numeric',
            'current_allocations' => 'nullable|numeric',
            'prior_allocations' => 'nullable|numeric',
            'current_other_long_term_liabilities' => 'nullable|numeric',
            'prior_other_long_term_liabilities' => 'nullable|numeric',
            'current_total_long_term_liabilities' => 'nullable|numeric',
            'prior_total_long_term_liabilities' => 'nullable|numeric',
            'current_total_liabilities' => 'nullable|numeric',
            'prior_total_liabilities' => 'nullable|numeric',
            'current_ordinary_shares' => 'nullable|numeric',
            'prior_ordinary_shares' => 'nullable|numeric',
            'current_preferred_shares' => 'nullable|numeric',
            'prior_preferred_shares' => 'nullable|numeric',
            'current_premiums' => 'nullable|numeric',
            'prior_premiums' => 'nullable|numeric',
            'current_reserves' => 'nullable|numeric',
            'prior_reserves' => 'nullable|numeric',
            'current_surplus' => 'nullable|numeric',
            'prior_surplus' => 'nullable|numeric',
            'current_total_equity' => 'nullable|numeric',
            'prior_total_equity' => 'nullable|numeric',
            'current_total_liabilities_and_capital' => 'nullable|numeric',
            'prior_total_liabilities_and_capital' => 'nullable|numeric',

            'accounting_result_current_year' => 'nullable|numeric',
            'net_profit_before_tax' => 'nullable|numeric',
            'interest_fines_delays_taxes' => 'nullable|numeric',
            'depreciation_tangible_assets' => 'nullable|numeric',
            'depreciation_intangible_assets' => 'nullable|numeric',
            'book_losses_investments_solidarity' => 'nullable|numeric',
            'losses_investments_national_stock' => 'nullable|numeric',
            'unrealized_losses' => 'nullable|numeric',
            'expenses_contribute_parent_subsidary' => 'nullable|numeric',
            'bad_debt_expenses' => 'nullable|numeric',
            'unauthorized_expenses_compensations_fines' => 'nullable|numeric',
            'unauthorized_donations_gifts' => 'nullable|numeric',
            'unauthorized_subsidy_expenses' => 'nullable|numeric',
            'personal_special_expenses' => 'nullable|numeric',
            'unauthorized_insurance_expenses' => 'nullable|numeric',
            'unauthorized_payments_director' => 'nullable|numeric',
            'other_non_deductible_expenses' => 'nullable|numeric',
            'unauthorized_benefits_commissions' => 'nullable|numeric',
            'unauthorized_taxes_fees_penalties' => 'nullable|numeric',
            'impairment_tangible_intangible_assets' => 'nullable|numeric',
            'unauthorized_allowances' => 'nullable|numeric',
            'unpaid_interest_payable' => 'nullable|numeric',
            'other_positive_adjustments' => 'nullable|numeric',
            'total_amounts_added_accounting_result' => 'nullable|numeric',
            'depreciation_permitted_tangible_assets' => 'nullable|numeric',
            'consumption_tangible_assets_permitted' => 'nullable|numeric',
            'amounts_bad_debts_allowed' => 'nullable|numeric',
            'book_profits_investments_solidarity_companies' => 'nullable|numeric',
            'profits_investments_national_shareholding_companies' => 'nullable|numeric',
            'profits_investments_realized_abroad' => 'nullable|numeric',
            'unrealized_gains' => 'nullable|numeric',
            'benefits_paid_previous_years' => 'nullable|numeric',
            'other_income_not_taxable' => 'nullable|numeric',
            'other_negative_adjustments' => 'nullable|numeric',
            'total_amounts_deducted_accounting_result' => 'nullable|numeric',
            'net_taxable_income' => 'nullable|numeric',

       ]);

       // Additional logic to check that all required annexes are checked
       $requiredAnnexes = range(1, 27);
       foreach ($requiredAnnexes as $annex) {
           if (!in_array($annex, $validatedData['annexes'])) {
               return redirect()->back()->withErrors([
                   'annexes' => "Annex $annex is required."
               ]);
           }
       }
        $form = new AnnualForms();
        $form->user_id = $user->id;
        $form->data = json_encode($validatedData); // Store form data as JSON
        $form->save();

        return redirect()->route('Taxpayer.TPDashboard')->with('success', 'Form submitted successfully.');
    }

    public function submitFormA(Request $request) 
    {
        $request->validate([
            'uen' => 'required|string|max:255',
            'financialYearFrom' => 'required|date',
            'financialYearTo' => 'required|date',
            'companyName' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postalCode' => 'required|string|max:10',
            'phone1' => 'required|string|max:20',
            'phone2' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'legalStructureChange' => 'required|string|in:yes,no',
            'legalStructureChangeDate' => 'required_if:legalStructureChange,yes|date|nullable',
            'newLegalStructure' => 'required_if:legalStructureChange,yes|string|max:255|nullable',
            'mainActivityChange' => 'required|string|in:yes,no',
            'mainActivityChangeSpecify' => 'required_if:mainActivityChange,yes|string|max:255|nullable',
            'companyConsolidated' => 'required|string|in:yes,no',
            'companyConsolidationDate' => 'required_if:companyConsolidated,yes|date|nullable',
            'subsidiaryLiquidated' => 'required|in:yes,no',
            'branchClosed' => 'required|in:yes,no',
            'companyLiquidated' => 'required|in:yes,no',
            'accountingSystem' => 'array',
            'accountingSystem.*' => 'in:Manual,Machine',
        ]);

        $data = $request->all();
         // Serialize the accountingSystem array into a string
        $data['accountingSystem'] = json_encode($request->input('accountingSystem'));
        $data['user_id'] = Auth::id();
        FormA::create($data);
        return redirect()->back()->with('success', 'Form submitted successfully.');

    }

    public function submitFormB(Request $request)
    {
        try {

            $formA = FormA::where('user_id', auth()->id())->first();

        // Check if FormA instance exists
        if (!$formA) {
            throw new \Exception('No matching FormA record found.');
        }

        // Assign the formA_id to the request data
        $request->merge(['formA_id' => $formA->id]);

            // Validate the request data
            $validatedData = $request->validate([
                'netTaxableIncome' => 'nullable',
                'previousYearsLosses' => 'nullable',
                'taxableIncome' => 'nullable',
                'taxRatio' => 'nullable',
                'toBePaidTax' => 'nullable',
                'foreignTaxAdoption' => 'nullable',
                'taxDeducted' => 'nullable',
                'netPayableTax' => 'nullable',
                'execManagerName' => 'nullable',
                'execManagerDate' => 'nullable',
                'auditorName' => 'nullable',
                'auditorPhone' => 'nullable',
                'auditorEmail' => 'nullable',
                'inwardNumber' => 'nullable',
                'inwardDate' => 'nullable',
                'employeeName' => 'nullable',
                'entryDate' => 'nullable',
                'formA_id' => 'required|exists:annual_form_a,id', // Ensure the formA_id exists in annual_form_a table
            ]);

            // Start a transaction
            DB::beginTransaction();

            // Create a new FormB instance with the validated data
            $formB = FormB::create($validatedData);

            // Commit the transaction
            DB::commit();

            // Redirect to a success page or return a response
            return redirect()->back()->with('success', 'Form submitted successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollback();

            // Log the error
            Log::error('Error submitting Form B: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'An error occurred while submitting the form. Please try again.');
        }
    }

    public function appendixOne(){
        return view('Taxpayer.AnnualForms.FormD');
    }

    public function storeAppendixOne(Request $request)
    {
        Log::info('storeAppendixOne method called');
        // Validate the incoming request data
        $validatedData = $request->validate([
            'current_short_term_investments' => 'nullable',
            'current_paid_short_term_loans' => 'nullable',
            'current_trade_receivables' => 'nullable',
            'current_other_receivables' => 'nullable',
            'current_inventory' => 'nullable|numeric',
            'current_other_short_term_assets' => 'nullable',
            'current_total_current_assets' => 'nullable',
            'current_long_term_investments' => 'nullable',
            'current_long_term_loans_granted' => 'nullable',
            'current_total_tangible_fixed_assets' => 'nullable',
            'current_total_depreciation' => 'nullable',
            'current_total_intangible_fixed_assets' => 'nullable',
            'current_total_amortization' => 'nullable',
            'current_other_long_term_assets' => 'nullable',
            'current_total_long_term_assets' => 'nullable',
            'current_total_assets' => 'nullable',
            'current_accounts_payable_banks' => 'nullable',
            'current_commercial_suppliers' => 'nullable',
            'current_payment_papers' => 'nullable',
            'current_accounts_payable_taxes' => 'nullable',
            'current_revenues_received' => 'nullable',
            'current_other_creditors' => 'nullable',
            'current_short_term_loans_received' => 'nullable',
            'current_other_short_term_liabilities' => 'nullable',
            'current_total_short_term_liabilities' => 'nullable',
            'current_long_term_loans_received' => 'nullable',
            'current_allocations' => 'nullable',
            'current_other_long_term_liabilities' => 'nullable',
            'current_total_long_term_liabilities' => 'nullable',
            'current_total_liabilities' => 'nullable',
            'current_ordinary_shares' => 'nullable',
            'current_preferred_shares' => 'nullable',
            'current_premiums' => 'nullable',
            'current_reserves' => 'nullable',
            'current_surplus' => 'nullable',
            'current_total_equity' => 'nullable',
            'current_total_liabilities_and_capital' => 'nullable',
        ]);

        $validatedData['user_id'] = Auth::id();
        
        try {
            // Create a new FormD instance with the validated data
            $formD = FormD::create($validatedData);

            // Check if the formD instance was created successfully
            if ($formD) {
                return redirect('/Annual-tax-form')->with('success', 'FormD data saved successfully');
            } else {
                return redirect('/appendix-one')->with('error', 'Failed to save FormD data');
            }
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error($e);
            // Return a response indicating failure
            return redirect('/appendix-one')->with('error', 'Failed to save FormD data: ' . $e->getMessage());
        }
    }

    public function appendixTwo()
    {
        return view('Taxpayer.AnnualForms.FormE');
    }

    public function storeAppendixTwo(Request $request)
    {
        $validatedData = $request->validate([
            'current_revenue_of_comodity' => 'nullable',
            'current_Business_income' => 'nullable',
            'curent_Revenue_from_business_activity' => 'nullable',
            'current_operating_income_for_others' => 'nullable',
            'current_interest_income_and_land_rents' => 'nullable',
            'current_Convertible_income' => 'nullable',
            'current_Other_income' => 'nullable',
            'current_total_revenue' => 'nullable',
            'current_Cost_of_goods_sold' => 'nullable',
            'current_Total_profit_loss' => 'nullable',
            'current_salaries_and_wages' => 'nullable',
            'current_commodity_supplies' => 'nullable',
            'current_maintenance_services' => 'nullable',
            'current_research_and_consulting_services' => 'nullable',
            'current_advertising_and_hospitality' => 'nullable',
            'current_transport_and_communications' => 'nullable',
            'current_rental_of_land' => 'nullable',
            'current_expenses_of_subscriptions' => 'nullable',
            'current_insurance_expenses' => 'nullable',
            'current_reward_for_non_workers' => 'nullable',
            'current_taxes_and_fees' => 'nullable',
            'current_legal_services_expenses' => 'nullable',
            'current_banking_services_expenses' => 'nullable',
            'current_training_and_rehabilitation_expenses' => 'nullable',
            'current_other_service_expenses' => 'nullable',
            'current_contracting_and_services' => 'nullable',
            'current_interest_local' => 'nullable',
            'current_interest_abroad' => 'nullable',
            'current_depreciations' => 'nullable',
            'current_retirement_and_social_security_expenses' => 'nullable',
            'current_expenses_to_contribute' => 'nullable',
            'current_donation_photographers' => 'nullable',
            'current_compensation_expenses' => 'nullable',
            'current_bad_debts' => 'nullable',
            'current_expenses_for_special_services' => 'nullable',
            'current_other_transfer_expenses' => 'nullable',
            'current_taxes_and_expenses' => 'nullable',
            'current_subsidies_expenses' => 'nullable',
            'current_expenses_of_previous' => 'nullable',
            'current_incidental_expenses' => 'nullable',
            'current_capital_losses' => 'nullable',
            'current_expected_losses' => 'nullable',
            'current_potential_maintenance' => 'nullable',
            'current_loss_of_commodity' => 'nullable',
            'current_losses_of_investment' => 'nullable',
            'current_other_expenses' => 'nullable',
            'current_total_expenditure' => 'nullable',
            'current_net_profit_before_tax' => 'nullable',
            'current_income_tax' => 'nullable',
            'current_net_profit' => 'nullable',
    
        ]);

        $validatedData['user_id'] = Auth::id();

        try {
            // Create a new FormD instance with the validated data
            $formE = FormE::create($validatedData);

            // Check if the formD instance was created successfully
            if ($formE) {
                return redirect('/Annual-tax-form')->with('success', 'FormD data saved successfully');
            } else {
                return redirect('//appendix-two')->with('error', 'Failed to save FormD data');
            }
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error($e);
            // Return a response indicating failure
            return redirect('//appendix-two')->with('error', 'Failed to save FormD data: ' . $e->getMessage());
        }
    }

    public function formC() 
    {
        return view('Taxpayer.AnnualForms.FormC');
    }

    public function Appendix($number)
    {
        // Generate the view name dynamically based on the number
        $viewName = 'Taxpayer.AnnualForms.Appendix' . $number;

        // Check if the view exists
        if (view()->exists($viewName)) {
            return view($viewName);
        }

        // Return a 404 response if the view does not exist
        abort(404, 'Appendix not found.');
    }
    public function storeAppendixThree(Request $request)
    {
        $data = $request->all();
        $fields = [
            'accounting_result_current_year',
            'interest_fines_delays_taxes',
            'depreciation_tangible_assets',
            'depreciation_intangible_assets',
            'book_losses_investments_solidarity',
            'losses_investments_abroad',
            'losses_investments_national_stock',
            'unrealized_losses',
            'expenses_contribute_parent_subsidary',
            'bad_debt_expenses',
            'unauthorized_expenses_compensations_fines',
            'unauthorized_donations_gifts',
            'unauthorized_subsidy_expenses',
            'personal_special_expenses',
            'unauthorized_insurance_expenses',
            'unauthorized_payments_director',
            'other_non_deductible_expenses',
            'unauthorized_benefits_commissions',
            'unauthorized_taxes_fees_penalties',
            'impairment_tangible_intangible_assets',
            'unauthorized_allowances',
            'unpaid_interest_payable',
            'other_positive_adjustments',
            'total_amounts_added_accounting_result',
            'depreciation_permitted_tangible_assets',
            'consumption_tangible_assets_permitted',
            'amounts_bad_debts_allowed',
            'book_profits_investments_solidarity_companies',
            'profits_investments_national_shareholding_companies',
            'profits_investments_realized_abroad',
            'unrealized_gains',
            'benefits_paid_previous_years',
            'other_income_not_taxable',
            'other_negative_adjustments',
            'total_amounts_deducted_accounting_result',
            'net_taxable_income'
        ];

        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $data[$field] = str_replace(',', '', $data[$field]);
            }
        }

        $validatedData = $request->validate([
            'accounting_result_current_year' => 'nullable|numeric',
            'interest_fines_delays_taxes' => 'nullable|numeric',
            'depreciation_tangible_assets' => 'nullable|numeric',
            'depreciation_intangible_assets' => 'nullable|numeric',
            'book_losses_investments_solidarity' => 'nullable|numeric',
            'losses_investments_abroad' => 'nullable|numeric',
            'losses_investments_national_stock' => 'nullable|numeric',
            'unrealized_losses' => 'nullable|numeric',
            'expenses_contribute_parent_subsidary' => 'nullable|numeric',
            'bad_debt_expenses' => 'nullable|numeric',
            'unauthorized_expenses_compensations_fines' => 'nullable|numeric',
            'unauthorized_donations_gifts' => 'nullable|numeric',
            'unauthorized_subsidy_expenses' => 'nullable|numeric',
            'personal_special_expenses' => 'nullable|numeric',
            'unauthorized_insurance_expenses' => 'nullable|numeric',
            'unauthorized_payments_director' => 'nullable|numeric',
            'other_non_deductible_expenses' => 'nullable|numeric',
            'unauthorized_benefits_commissions' => 'nullable|numeric',
            'unauthorized_taxes_fees_penalties' => 'nullable|numeric',
            'impairment_tangible_intangible_assets' => 'nullable|numeric',
            'unauthorized_allowances' => 'nullable|numeric',
            'unpaid_interest_payable' => 'nullable|numeric',
            'other_positive_adjustments' => 'nullable|numeric',
            'total_amounts_added_accounting_result' => 'nullable|numeric',
            'depreciation_permitted_tangible_assets' => 'nullable|numeric',
            'consumption_tangible_assets_permitted' => 'nullable|numeric',
            'amounts_bad_debts_allowed' => 'nullable|numeric',
            'book_profits_investments_solidarity_companies' => 'nullable|numeric',
            'profits_investments_national_shareholding_companies' => 'nullable|numeric',
            'profits_investments_realized_abroad' => 'nullable|numeric',
            'unrealized_gains' => 'nullable|numeric',
            'benefits_paid_previous_years' => 'nullable|numeric',
            'other_income_not_taxable' => 'nullable|numeric',
            'other_negative_adjustments' => 'nullable|numeric',
            'total_amounts_deducted_accounting_result' => 'nullable|numeric',
            'net_taxable_income' => 'nullable|numeric',
        ]);

        $validatedData['user_id'] = auth()->id();

        AppendixThree::create($validatedData);

        return redirect()->back()->with('success', 'Form data saved successfully.');
    }

    public function storeAppendixFour(Request $request) 
    {
        $validatedData = $request->validate([
            'corporation.*' => 'nullable',
            'tax_number.*' => 'nullable',
            'nationality.*' => 'nullable',
            'legal_form.*' => 'nullable',
            'ownership_ratio.*' => 'nullable',
        ]);

        // Get the authenticated user's ID
        $userId = $request->user()->id;

        // Retrieve the input arrays from the request
        $corporations = $validatedData['corporation'] ?? [];
        $tax_numbers = $validatedData['tax_number'] ?? [];
        $nationalities = $validatedData['nationality'] ?? [];
        $legal_forms = $validatedData['legal_form'] ?? [];
        $ownership_ratios = $validatedData['ownership_ratio'] ?? [];

        // Iterate over the arrays and create AppendixFour records
        foreach ($corporations as $index => $corporation) {
            // Check if all fields in the row are empty
            $fields = [
                $corporation,
                $tax_numbers[$index] ?? '',
                $nationalities[$index] ?? '',
                $legal_forms[$index] ?? '',
                $ownership_ratios[$index] ?? 0
            ];

            if (array_filter($fields)) {
                AppendixFour::create([
                    'user_id' => $userId,
                    'corporation' => $corporation ?? '',
                    'tax_number' => $tax_numbers[$index] ?? '',
                    'nationality' => $nationalities[$index] ?? '',
                    'legal_form' => $legal_forms[$index] ?? '',
                    'ownership_ratio' => $ownership_ratios[$index] ?? 0,
                ]);
            }
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Data saved successfully');
    }

    public function storeAppendixFive(Request $request)
    {
        $validatedData = $request->validate([
            'tax_number_merge.*' => 'nullable', 
            'previous_company.*' => 'nullable',
            'Liquidated_company_name.*' => 'nullable',
            'tax_number_liquidation.*' => 'nullable',
            'start_date_liquidation.*' => 'nullable',
            'end_date_liquidation.*' => 'nullable',
        ]);
    
        // Get the authenticated user's ID
        $userId = $request->user()->id;
    
        $tax_number_merge = $validatedData['tax_number_merge'] ?? [];
        $previous_company = $validatedData['previous_company'] ?? [];
        $Liquidated_company_name = $validatedData['Liquidated_company_name'] ?? [];
        $tax_number_liquidation = $validatedData['tax_number_liquidation'] ?? [];
        $start_date_liquidation = $validatedData['start_date_liquidation'] ?? [];
        $end_date_liquidation = $validatedData['end_date_liquidation'] ?? [];
    
        foreach ($tax_number_merge as $index => $taxNumber) {
            $fields = [
                $taxNumber,
                $previous_company[$index] ?? '',
                $Liquidated_company_name[$index] ?? '',
                $tax_number_liquidation[$index] ?? '',
                $start_date_liquidation[$index] ?? '',
                $end_date_liquidation[$index] ?? '',
            ];
    
            if (array_filter($fields)) {
                AppendixFive::create([
                    'user_id' => $userId,
                    'tax_number_merge' => $taxNumber, 
                    'previous_company' => $previous_company[$index] ?? '',
                    'Liquidated_company_name' => $Liquidated_company_name[$index] ?? '',
                    'tax_number_liquidation' => $tax_number_liquidation[$index] ?? '',
                    'start_date_liquidation' => $start_date_liquidation[$index] ?? '',
                    'end_date_liquidation' => $end_date_liquidation[$index] ?? '',
                ]);
            }
        }
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Data saved successfully');
    }

    public function storeAppendixSix(Request $request) 
    {
        // Validate the request
        $request->validate([
            'depreciation_value' => 'nullable|string',
            'continuous_installment' => 'nullable|string',
            'decreasing_installment' => 'nullable|string',
            'Another_method_administration' => 'nullable|string',
            'category_assets' => 'array',
            'category_assets.*' => 'nullable|string',
            'directory_number' => 'array',
            'directory_number.*' => 'nullable|string',
            'book_value' => 'array',
            'book_value.*' => 'nullable|numeric',
            'cost_acquisition' => 'array',
            'cost_acquisition.*' => 'nullable|numeric',
            'cost_assets' => 'array',
            'cost_assets.*' => 'nullable|numeric',
            'total_allowable' => 'array',
            'total_allowable.*' => 'nullable|numeric',
            'accumulated' => 'array',
            'accumulated.*' => 'nullable|numeric',
            'book_value_end' => 'array',
            'book_value_end.*' => 'nullable|numeric',
    
            'total_book_value' => 'nullable|numeric',
            'total_cost_acquisition' => 'nullable|numeric',
            'total_cost_assets' => 'nullable|numeric',
            'total_total_allowable' => 'nullable|numeric',
            'total_accumulated' => 'nullable|numeric',
            'total_book_value_end' => 'nullable|numeric',
        ]);
    
        // Get the authenticated user's ID
        $userId = $request->user()->id;
    
        // Create the AppendixSix record
        $appendixSix = AppendixSix::create([
            'user_id' => $userId,
            'depreciation_value' => $request->depreciation_value,
            'continuous_installment' => $request->has('continuous_installment'),
            'decreasing_installment' => $request->has('decreasing_installment'),
            'Another_method_administration' => $request->has('Another_method_administration'),
        ]);
    
        // Create related TangibleAsset records
        $tangibleAssetsData = [];
        foreach ($request->category_assets as $index => $category) {
            // Check if any of the input fields in the row are empty
            if (
                isset($category) &&
                isset($request->directory_number[$index]) &&
                isset($request->book_value[$index]) &&
                isset($request->cost_acquisition[$index]) &&
                isset($request->cost_assets[$index]) &&
                isset($request->total_allowable[$index]) &&
                isset($request->accumulated[$index]) &&
                isset($request->book_value_end[$index])
            ) {
                $totalBookValue = $request->input('total_book_value');
                $totalCostAcquisition = $request->input('total_cost_acquisition');
                $totalCostAssets = $request->input('total_cost_assets');
                $totalTotalAllowable = $request->input('total_total_allowable');
                $totalAccumulated = $request->input('total_accumulated');
                $totalBookValueEnd = $request->input('total_book_value_end');
                
                // Create TangibleAsset instance only if all fields are not empty
                $tangibleAssetsData[] = new TangibleAsset([
                    'user_id' => $userId,
                    'appendix_six_id' => $appendixSix->id,
                    'category_assets' => $category,
                    'directory_number' => $request->directory_number[$index] ?? null,
                    'book_value' => $request->book_value[$index] ?? null,
                    'cost_acquisition' => $request->cost_acquisition[$index] ?? null,
                    'cost_assets' => $request->cost_assets[$index] ?? null,
                    'total_allowable' => $request->total_allowable[$index] ?? null,
                    'accumulated' => $request->accumulated[$index] ?? null,
                    'book_value_end' => $request->book_value_end[$index] ?? null,
                    'total_book_value' => $totalBookValue,
                    'total_cost_acquisition' => $totalCostAcquisition,
                    'total_cost_assets' => $totalCostAssets,
                    'total_total_allowable' => $totalTotalAllowable,
                    'total_accumulated' =>$totalAccumulated ,
                    'total_book_value_end' => $totalBookValueEnd ,
                ]);
            }
        }
    
        // Save the TangibleAsset records if there are any
        if (!empty($tangibleAssetsData)) {
            $appendixSix->tangibleAssets()->saveMany($tangibleAssetsData);
        }
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Data saved successfully');
    }
    
    public function storeAppendixSeven(Request $request)
    {
        // Validate the request
        $request->validate([
            'depreciation_value' => 'nullable|string',
            'continuous_installment' => 'nullable|string',
            'decreasing_installment' => 'nullable|string',
            'another_method_administration' => 'nullable|string',
            'type_of_intangible_assets' => 'array',
            'type_of_intangible_assets.*' => 'nullable|string',
            'book_value_beginning' => 'array',
            'book_value_beginning.*' => 'nullable|numeric',
            'cost_of_acquisition' => 'array',
            'cost_of_acquisition.*' => 'nullable|numeric',
            'cost_of_assets_sold' => 'array',
            'cost_of_assets_sold.*' => 'nullable|numeric',
            'total_consumption_allowed' => 'array',
            'total_consumption_allowed.*' => 'nullable|numeric',
            'depreciation_of_assets_sold' => 'array',
            'depreciation_of_assets_sold.*' => 'nullable|numeric',
            'book_value_end' => 'array',
            'book_value_end.*' => 'nullable|numeric',

            'total_book_value_beginning'=> 'nullable|numeric',
            'total_cost_of_acquisition'=> 'nullable|numeric',
            'total_cost_of_assets_sold'=> 'nullable|numeric',
            'total_total_consumption_allowed'=> 'nullable|numeric',
            'total_depreciation_of_assets_sold'=> 'nullable|numeric',
            'total_book_value_end'=> 'nullable|numeric',
        ]);
    
        // Get the authenticated user's ID
        $userId = $request->user()->id;
    
        // Create the AppendixSeven record
        $appendixSeven = AppendixSeven::create([
            'user_id' => $userId,
            'depreciation_value' => $request->depreciation_value,
            'continuous_installment' => $request->has('continuous_installment'),
            'decreasing_installment' => $request->has('decreasing_installment'),
            'another_method_administration' => $request->has('another_method_administration'),
        ]);
    
        // Create related IntangibleAsset records for filled input rows
        $intangibleAssetsData = [];
        foreach ($request->type_of_intangible_assets as $index => $type) {
            // Check if any of the input fields in the row are filled
            if (
                isset($request->book_value_beginning[$index]) ||
                isset($request->cost_of_acquisition[$index]) ||
                isset($request->cost_of_assets_sold[$index]) ||
                isset($request->total_consumption_allowed[$index]) ||
                isset($request->depreciation_of_assets_sold[$index]) ||
                isset($request->book_value_end[$index])
            ) {
                $totalBookValueBeginning = $request->total_book_value_beginning;
                $totalCostAcquisition = $request->total_cost_of_acquisition;
                $totalCostAssetsSold = $request->total_cost_of_assets_sold;
                $totalTotalConsumptionAllowed = $request->total_total_consumption_allowed;
                $totalDepreciationOfAssetsSold = $request->total_depreciation_of_assets_sold;
                $totalBookValueEnd = $request->total_book_value_end;

                $intangibleAssetsData[] = new IntangibleAsset([
                    'user_id' => $userId,
                    'appendix_seven_id' => $appendixSeven->id,
                    'type_of_intangible_assets' => $type,
                    'book_value_beginning' => $request->book_value_beginning[$index] ?? null,
                    'cost_of_acquisition' => $request->cost_of_acquisition[$index] ?? null,
                    'cost_of_assets_sold' => $request->cost_of_assets_sold[$index] ?? null,
                    'total_consumption_allowed' => $request->total_consumption_allowed[$index] ?? null,
                    'depreciation_of_assets_sold' => $request->depreciation_of_assets_sold[$index] ?? null,
                    'book_value_end' => $request->book_value_end[$index] ?? null,
                    'total_book_value_beginning' => $totalBookValueBeginning,
                    'total_cost_of_acquisition' => $totalCostAcquisition,
                    'total_cost_of_assets_sold' => $totalCostAssetsSold,
                    'total_total_consumption_allowed' => $totalTotalConsumptionAllowed,
                    'total_depreciation_of_assets_sold' => $totalDepreciationOfAssetsSold,
                    'total_book_value_end' => $totalBookValueEnd,
                ]);
            }
        }
    
        // Save only the non-empty IntangibleAsset records
        $appendixSeven->intangibleAssets()->saveMany($intangibleAssetsData);
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Data saved successfully');
    }

    public function storeAppendixEight(Request $request)
    {
        $request->validate([
            'tax_number.1.*' => 'nullable|string',
            'owned_company_name.1.*' => 'nullable|string',
            'number_of_shares.1.*' => 'nullable|integer',
            'ownership_percentage.1.*' => 'nullable|numeric',
            'book_value.1.*' => 'nullable|numeric',
            'accounting_profit.1.*' => 'nullable|numeric',
            
            'tax_number.2.*' => 'nullable|string',
            'owned_company_name.2.*' => 'nullable|string',
            'type_of_company.2.*' => 'nullable|string',
            'number_of_shares.2.*' => 'nullable|integer',
            'ownership_percentage.2.*' => 'nullable|numeric',
            'number_of_preferred_contribution.2.*' => 'nullable|integer',
            'book_value.2.*' => 'nullable|numeric',
            'accounting_profit.2.*' => 'nullable|numeric',
            
    
            'tax_number.3.*' => 'nullable|string',
            'owned_company_name.3.*' => 'nullable|string',
            'nationality.3.*' => 'nullable|string',
            'company_type.3.*' => 'nullable|string',
            'number_of_shares.3.*' => 'nullable|integer',
            'ownership_percentage.3.*' => 'nullable|numeric',
            'number_of_preferred_shared.3.*' => 'nullable|integer',
            'book_value.3.*' => 'nullable|numeric',
            'accounting_profit.3.*' => 'nullable|numeric',
            
            'total_1' => 'nullable|numeric',
            'total_2' => 'nullable|numeric',
            'total_3' => 'nullable|numeric',
        ]);
    
        $userId = Auth::id();
        $total_1 = $request->input('total_1');
        $total_2 = $request->input('total_2');
        $total_3 = $request->input('total_3');
    
        // Store data in appendix_eight table
        if (isset($request->tax_number['1'])) {
            foreach ($request->tax_number['1'] as $key => $value) {
                if (!empty($value) || !empty($request->owned_company_name['1'][$key]) || !empty($request->number_of_shares['1'][$key]) || !empty($request->ownership_percentage['1'][$key]) || !empty($request->book_value['1'][$key]) || !empty($request->accounting_profit['1'][$key])) {
                    AppendixEight::create([
                        'user_id' => $userId,
                        'total_1' => $total_1,
                        'tax_number' => $value,
                        'owned_company_name' => $request->owned_company_name['1'][$key],
                        'number_of_shares' => $request->number_of_shares['1'][$key] ?? 0,
                        'ownership_percentage' => $request->ownership_percentage['1'][$key] ?? 0.0,
                        'book_value' => $request->book_value['1'][$key] ?? 0.0,
                        'accounting_profit' => $request->accounting_profit['1'][$key] ?? 0.0,
                    ]);
                }
            }
        }
    
        // Store data in appendix_eight_b table
        if (isset($request->tax_number['2'])) {
            foreach ($request->tax_number['2'] as $key => $value) {
                if (!empty($value) || !empty($request->owned_company_name['2'][$key]) || !empty($request->type_of_company['2'][$key]) || !empty($request->number_of_shares['2'][$key]) || !empty($request->ownership_percentage['2'][$key]) || !empty($request->number_of_preferred_contribution['2'][$key]) || !empty($request->book_value['2'][$key]) || !empty($request->accounting_profit['2'][$key])) {
                    AppendixEightB::create([
                        'user_id' => $userId,
                        'tax_number' => $value,
                        'total_2' => $total_2,
                        'owned_company_name' => $request->owned_company_name['2'][$key],
                        'type_of_company' => $request->type_of_company['2'][$key],
                        'number_of_shares' => $request->number_of_shares['2'][$key] ?? 0,
                        'ownership_percentage' => $request->ownership_percentage['2'][$key] ?? 0.0,
                        'number_of_preferred_contribution' => $request->number_of_preferred_contribution['2'][$key] ?? 0,
                        'book_value' => $request->book_value['2'][$key] ?? 0.0,
                        'accounting_profit' => $request->accounting_profit['2'][$key] ?? 0.0,
                    ]);
                }
            }
        }
    
        // Store data in appendix_eight_c table
        if (isset($request->tax_number['3'])) {
            foreach ($request->tax_number['3'] as $key => $value) {
                if (!empty($value) || !empty($request->owned_company_name['3'][$key]) || !empty($request->nationality['3'][$key]) || !empty($request->company_type['3'][$key]) || !empty($request->number_of_shares['3'][$key]) || !empty($request->ownership_percentage['3'][$key]) || !empty($request->number_of_preferred_shared['3'][$key]) || !empty($request->book_value['3'][$key]) || !empty($request->accounting_profit['3'][$key])) {
                    AppendixEightC::create([
                        'user_id' => $userId,
                        'total_3' => $total_3,
                        'tax_number' => $value,
                        'owned_company_name' => $request->owned_company_name['3'][$key],
                        'nationality' => $request->nationality['3'][$key],
                        'company_type' => $request->company_type['3'][$key],
                        'number_of_shares' => $request->number_of_shares['3'][$key] ?? 0,
                        'ownership_percentage' => $request->ownership_percentage['3'][$key] ?? 0.0,
                        'number_of_preferred_shared' => $request->number_of_preferred_shared['3'][$key] ?? 0,
                        'book_value' => $request->book_value['3'][$key] ?? 0.0,
                        'accounting_profit' => $request->accounting_profit['3'][$key] ?? 0.0,
                    ]);
                }
            }
        }
    
        return redirect()->back()->with('success', 'Data saved successfully.');
    }

    // Helper function to calculate total
    private function calculateTotal($values)
    {
        return array_sum($values);
    }
    
    public function storeAppendixNine(Request $request)
    {
        // Validate the request
        $request->validate([
            't_asset_type.*' => 'nullable|string',
            't_purchase_date.*' => 'nullable|date',
            't_book_value.*' => 'nullable|numeric',
            't_net_selling_value.*' => 'nullable|numeric',
            't_profit_loss.*' => 'nullable|numeric',
            'number_of_shares.*' => 'nullable|string',
            'tax_number.*' => 'nullable|string',
            'company_name.*' => 'nullable|string',
            'purchase_date.*' => 'nullable|date',
            'purchase_cost.*' => 'nullable|numeric',
            'net_selling_value.*' => 'nullable|numeric',
            'profit_loss.*' => 'nullable|numeric',

            'total_1' => 'nullable|numeric',
            'total_2' => 'nullable|numeric',
        ]);

        $userId = Auth::id();
        $total_1 = $this->calculateTotal($request->t_profit_loss);
        $total_2 = $this->calculateTotal($request->profit_loss);

        // Store data in appendix_nine table
        if (is_array($request->t_asset_type)) {
            foreach ($request->t_asset_type as $key => $value) {
                if (!empty($value) || !empty($request->t_purchase_date[$key]) || !empty($request->t_book_value[$key]) || !empty($request->t_net_selling_value[$key]) || !empty($request->t_profit_loss[$key])) {
                    AppendixNine::create([
                        'user_id' => $userId,
                        'total_1'=>$total_1,
                        't_asset_type' => $value,
                        't_purchase_date' => $request->t_purchase_date[$key],
                        't_book_value' => $request->t_book_value[$key],
                        't_net_selling_value' => $request->t_net_selling_value[$key],
                        't_profit_loss' => $request->t_profit_loss[$key],
                    ]);
                }
            }
        }

        // Store data in appendix_nine_b table
        if (is_array($request->number_of_shares)) {
            foreach ($request->number_of_shares as $key => $value) {
                if (!empty($value) || !empty($request->tax_number[$key]) || !empty($request->company_name[$key]) || !empty($request->purchase_date[$key]) || !empty($request->purchase_cost[$key]) || !empty($request->net_selling_value[$key]) || !empty($request->profit_loss[$key])) {
                    AppendixNineB::create([
                        'user_id' => $userId,
                        'total_1'=>$total_2,
                        'number_of_shares' => $value,
                        'tax_number' => $request->tax_number[$key],
                        'company_name' => $request->company_name[$key],
                        'purchase_date' => $request->purchase_date[$key],
                        'purchase_cost' => $request->purchase_cost[$key],
                        'net_selling_value' => $request->net_selling_value[$key],
                        'profit_loss' => $request->profit_loss[$key],
                    ]);
                }
            }
        }

        // Redirect back with a success message
        return back()->with('success', 'Data saved successfully.');
    }
    
    public function storeAppendixTen(Request $request)
    {
        $validatedData = $request->validate([
            'year_one.*' => 'nullable|numeric',
            'original_loss_one.*' => 'nullable|numeric',
            'written_offs_previous_year_one.*' => 'nullable|numeric',
            'written_offs_current_year_one.*' => 'nullable|numeric',
            'accumulated_loss_one.*' => 'nullable|numeric',
            'total' => 'nullable|numeric'
        ]);

        $userId = Auth::id();

        $appendixTenData = [];

        $total = $validatedData['total'];
        foreach ($validatedData['year_one'] as $index => $year) {
            // Check if any of the fields in this row is filled
            if (!empty($year) || !empty($validatedData['original_loss_one'][$index]) ||
                !empty($validatedData['written_offs_previous_year_one'][$index]) ||
                !empty($validatedData['written_offs_current_year_one'][$index]) ||
                !empty($validatedData['accumulated_loss_one'][$index])) {
                $appendixTenData[] = [
                    'user_id' => $userId,
                    'year_one' => $year,
                    'original_loss_one' => $validatedData['original_loss_one'][$index],
                    'written_offs_previous_year_one' => $validatedData['written_offs_previous_year_one'][$index],
                    'written_offs_current_year_one' => $validatedData['written_offs_current_year_one'][$index],
                    'accumulated_loss_one' => $validatedData['accumulated_loss_one'][$index],
                    'total' =>$total,
                ];
            }
        }

        if (!empty($appendixTenData)) {
            AppendixTen::insert($appendixTenData);
        }

        return redirect()->back()->with('success', 'Data saved successfully.');
    }

    public function storeAppendixEleven(Request $request)
    {
        $validatedData = $request->validate([
            'link_code.*' => 'nullable|string',
            'batch.*' => 'nullable|string',
            'refunds.*' => 'nullable|string',
            'debit_account.*' => 'nullable|string',
            'credit_account.*' => 'nullable|string',
            'sold_assets.*' => 'nullable|string',
            'purchased_assets.*' => 'nullable|string',
            'total' => 'nullable'
        ]);

        $userId = Auth::id();

        $data = [];
        foreach ($validatedData['link_code'] as $index => $linkCode) {
            // Check if the row is completely empty
            if (empty($validatedData['link_code'][$index]) &&
                empty($validatedData['batch'][$index]) &&
                empty($validatedData['refunds'][$index]) &&
                empty($validatedData['debit_account'][$index]) &&
                empty($validatedData['credit_account'][$index]) &&
                empty($validatedData['sold_assets'][$index]) &&
                empty($validatedData['purchased_assets'][$index])) {
                continue; // Skip this row if it's empty
            }

            $data[] = [
                'user_id' => $userId,
                'link_code' => $validatedData['link_code'][$index],
                'batch' => $validatedData['batch'][$index],
                'refunds' => $validatedData['refunds'][$index],
                'debit_account' => $validatedData['debit_account'][$index],
                'credit_account' => $validatedData['credit_account'][$index],
                'sold_assets' => $validatedData['sold_assets'][$index],
                'purchased_assets' => $validatedData['purchased_assets'][$index],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($data)) {
            AppendixEleven::insert($data);
        }

        return redirect()->back()->with('success', 'Operations saved successfully.');
    }
    public function storeAppendixTwelve(Request $request)
    {
        $validatedData = $request->validate([
            'link_code.*' => 'nullable|string',
            'tax_number.*' => 'nullable|string',
            'batch.*' => 'nullable|string',
            'refunds.*' => 'nullable|string',
            'debit_account.*' => 'nullable|string',
            'credit_account.*' => 'nullable|string',
            'sold_assets.*' => 'nullable|string',
            'purchased_assets.*' => 'nullable|string',
            'leased_assets.*' => 'nullable|string',
            'total' => 'nullable'
        ]);

        $userId = Auth::id();

        $data = [];
        foreach ($validatedData['link_code'] as $index => $linkCode) {
            // Check if the row is completely empty
            if (empty($validatedData['link_code'][$index]) &&
                empty($validatedData['tax_number'][$index]) &&
                empty($validatedData['batch'][$index]) &&
                empty($validatedData['refunds'][$index]) &&
                empty($validatedData['debit_account'][$index]) &&
                empty($validatedData['credit_account'][$index]) &&
                empty($validatedData['sold_assets'][$index]) &&
                empty($validatedData['purchased_assets'][$index]) &&
                empty($validatedData['leased_assets'][$index])) {
                continue; // Skip this row if it's empty
            }

            $data[] = [
                'user_id' => $userId,
                'link_code' => $validatedData['link_code'][$index],
                'tax_number' => $validatedData['tax_number'][$index],
                'batch' => $validatedData['batch'][$index],
                'refunds' => $validatedData['refunds'][$index],
                'debit_account' => $validatedData['debit_account'][$index],
                'credit_account' => $validatedData['credit_account'][$index],
                'sold_assets' => $validatedData['sold_assets'][$index],
                'purchased_assets' => $validatedData['purchased_assets'][$index],
                'leased_assets' => $validatedData['leased_assets'][$index],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($data)) {
            AppendixTwelve::insert($data);
        }

        return redirect()->back()->with('success', 'Operations saved successfully.');
    }

    public function storeAppendixThirteen(Request $request)
    {
        $validatedData = $request->validate([
            'link_code.*' => 'nullable|string',
            'tax_number.*' => 'nullable|string',
            'net_commercial_sales.*' => 'nullable|string',
            'net_commercial_purchase.*' => 'nullable|string',
            'debit_account.*' => 'nullable|string',
            'credit_account.*' => 'nullable|string',
            'total' => 'nullable'
        ]);

        $userId = Auth::id();

        $data = [];
        foreach ($validatedData['link_code'] as $index => $linkCode) {
            // Check if the row is completely empty
            if (empty($validatedData['link_code'][$index]) &&
                empty($validatedData['tax_number'][$index]) &&
                empty($validatedData['net_commercial_sales'][$index]) &&
                empty($validatedData['net_commercial_purchase'][$index]) &&
                empty($validatedData['debit_account'][$index]) &&
                empty($validatedData['credit_account'][$index])) {
                continue; // Skip this row if it's empty
            }

            $data[] = [
                'user_id' => $userId,
                'link_code' => $validatedData['link_code'][$index],
                'tax_number' => $validatedData['tax_number'][$index],
                'net_commercial_sales' => $validatedData['net_commercial_sales'][$index],
                'net_commercial_purchase' => $validatedData['net_commercial_purchase'][$index],
                'debit_account' => $validatedData['debit_account'][$index],
                'credit_account' => $validatedData['credit_account'][$index],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($data)) {
            AppendixThirteen::insert($data);
        }

        return redirect()->back()->with('success', 'Operations saved successfully.');
    }

    public function storeAppendixFourteen(Request $request)
    {
        $validatedData = $request->validate([
            'beginning_of_year.*' => 'nullable|string',
            'end_of_year.*' => 'nullable|string',
            'warehouse_address.*' => 'nullable|string',
            'area.*' => 'nullable|string',
            'private_owned.*' => 'nullable|in:on,true,false',
            'musataha.*' => 'nullable|in:on,true,false',
            'rent.*' => 'nullable|in:on,true,false',
            'rent_owner_name.*' => 'nullable|string',
        ]);
    
        $user_id = auth()->id(); // Assuming you're using authentication
    
        // Save Inventory Statement
        foreach ($validatedData['beginning_of_year'] as $key => $value) {
            if (!empty($value) || !empty($validatedData['end_of_year'][$key])) {
                AppendixFourteen::create([
                    'user_id' => $user_id,
                    'beginning_of_year' => $value ?? null,
                    'end_of_year' => $validatedData['end_of_year'][$key] ?? null,
                ]);
            }
        }
    
        // Save Warehouse Statement
        foreach ($validatedData['warehouse_address'] as $key => $value) {
            if (!empty($value) || !empty($validatedData['area'][$key]) || isset($validatedData['private_owned'][$key]) || isset($validatedData['musataha'][$key]) || isset($validatedData['rent'][$key]) || !empty($validatedData['rent_owner_name'][$key])) {
                AppendixFourteenB::create([
                    'user_id' => $user_id,
                    'warehouse_address' => $value ?? null,
                    'area' => $validatedData['area'][$key] ?? null,
                    'private_owned' => isset($validatedData['private_owned'][$key]) ? 1 : 0,
                    'musataha' => isset($validatedData['musataha'][$key]) ? 1 : 0,
                    'rent' => isset($validatedData['rent'][$key]) ? 1 : 0,
                    'rent_owner_name' => $validatedData['rent_owner_name'][$key] ?? null,
                ]);
            }
        }
    
        return redirect()->back()->with('success', 'Data saved successfully.');
    }
    
    public function storeAppendixFifteen(Request $request) 
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'tax_number.*' => 'nullable|string',
            'company_name.*' => 'nullable|string',
            'fees.*' => 'nullable|numeric',
            'admin_expenses.*' => 'nullable|numeric',
            'research_development_expenses.*' => 'nullable|numeric',
            'technical_assistance.*' => 'nullable|numeric',
            'similar_amounts.*' => 'nullable|numeric',
            'total_1' => 'nullable',
            'total_2' => 'nullable',
            'total_3' => 'nullable',
            'total_4' => 'nullable',
            'total_5' => 'nullable',
        ]);
    
        $userId = auth()->id(); // Assuming you're using authentication
    
        $data = [];
        foreach ($validatedData['tax_number'] as $index => $linkCode) {
            // Check if any field in the row is filled
            if (!empty($validatedData['tax_number'][$index]) ||
                !empty($validatedData['company_name'][$index]) ||
                !empty($validatedData['fees'][$index]) ||
                !empty($validatedData['admin_expenses'][$index]) ||
                !empty($validatedData['research_development_expenses'][$index]) ||
                !empty($validatedData['technical_assistance'][$index]) ||
                !empty($validatedData['similar_amounts'][$index])) {
                
                $data[] = [
                    'user_id' => $userId,
                    'tax_number' => $validatedData['tax_number'][$index],
                    'company_name' => $validatedData['company_name'][$index],
                    'fees' => $validatedData['fees'][$index],
                    'admin_expenses' => $validatedData['admin_expenses'][$index],
                    'research_development_expenses' => $validatedData['research_development_expenses'][$index],
                    'technical_assistance' => $validatedData['technical_assistance'][$index],
                    'similar_amounts' => $validatedData['similar_amounts'][$index],
                    'total_1' => $validatedData['total_1'],
                    'total_2' => $validatedData['total_2'],
                    'total_3' => $validatedData['total_3'],
                    'total_4' => $validatedData['total_4'],
                    'total_5' => $validatedData['total_5'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
    
        if (!empty($data)) {
            AppendixFifteen::insert($data);
        }
        return redirect()->back()->with('success', 'Data saved successfully.');
    }

    public function storeAppendixSixteen(Request $request) 
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'company_name.*' => 'nullable|string',
            'address.*' => 'nullable|string',
            'batch_code.*' => 'nullable|numeric',
            'value.*' => 'nullable|numeric',
            'total_1' => 'nullable',
        ]);
    
        $userId = auth()->id(); // Assuming you're using authentication
    
        $data = [];
        foreach ($validatedData['company_name'] as $index => $linkCode) {
            // Check if any field in the row is filled
            if (!empty($validatedData['company_name'][$index]) ||
                !empty($validatedData['address'][$index]) ||
                !empty($validatedData['fees'][$index]) ||
                !empty($validatedData['batch_code'][$index]) ||
                !empty($validatedData['value'][$index])) {
                
                $data[] = [
                    'user_id' => $userId,
                    'company_name' => $validatedData['company_name'][$index],
                    'address' => $validatedData['address'][$index],
                    'batch_code' => $validatedData['batch_code'][$index],
                    'value' => $validatedData['value'][$index],
                    'total_1' => $validatedData['total_1'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
    
        if (!empty($data)) {
            AppendixSixteen::insert($data);
        }
        return redirect()->back()->with('success', 'Data saved successfully.');
    }
    
    public function storeAppendixSeventeen(Request $request) 
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'page_number' => 'required|integer',
            'websites.*' => 'url|nullable',
            'revenue_percentage' => 'required|integer',
        ]);
    
        $userId = auth()->id(); // Assuming you're using authentication
    
        // Save the websites
        foreach ($validatedData['websites'] as $url) {
            if ($url) { // Only save non-empty URLs
                AppendixSeventeen::create([
                    'user_id' => $userId,
                    'page_number' => $validatedData['page_number'],
                    'url' => $url,
                    'revenue_percentage' => $validatedData['revenue_percentage'],
                ]);
            }
        }
    
        return redirect()->back()->with('success', 'Data saved successfully.');
    }

    public function storeAppendixEighteen(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name_secondry_contract.*' => 'nullable|string',
            'tax_number.*' => 'nullable|string',
            'nationality.*' => 'nullable|string',
            'contract_value.*' => 'nullable|numeric',
            'amount_paid.*' => 'nullable|numeric',
            'total_1' => 'nullable|numeric',
            'total_2' => 'nullable|numeric',
        ]);

        $userId = Auth::id();

        $data = [];
        foreach ($validatedData['name_secondry_contract'] as $index => $linkCode) {
            // Check if the row is completely empty
            if (empty($validatedData['name_secondry_contract'][$index]) &&
                empty($validatedData['tax_number'][$index]) &&
                empty($validatedData['nationality'][$index]) &&
                empty($validatedData['contract_value'][$index]) &&
                empty($validatedData['amount_paid'][$index])) {
                continue; // Skip this row if it's empty
            }

            $data[] = [
                'user_id' => $userId,
                'name_secondry_contract' => $validatedData['name_secondry_contract'][$index],
                'tax_number' => $validatedData['tax_number'][$index],
                'nationality' => $validatedData['nationality'][$index],
                'contract_value' => $validatedData['contract_value'][$index],
                'amount_paid' => $validatedData['amount_paid'][$index],
                'total_1' => $validatedData['total_1'],
                'total_2' => $validatedData['total_2'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($data)) {
            AppendixEighteen::insert($data);
        }
        return redirect()->back()->with('success', 'Data saved successfully.');
    }
    
    public function storeAppendixNineteen(Request $request)
    {
        $validatedData = $request->validate([
            'tax_number.*' => 'nullable|string',
            'name_of_debtor.*' => 'nullable|string',
            'amount_of_bad_debt.*' => 'nullable|numeric',
            'date_of_debt.*' => 'nullable|date',
            'was_included_in_previous_income.*' => 'nullable|boolean',
            'has_all_means_been_taken.*' => 'nullable|boolean',
            'amount_allowed.*' => 'nullable|numeric',
            'total_1' => 'nullable|numeric',
            'amount_of_bad_debit' => 'nullable|numeric',
        ]);
    
        $userId = Auth::id();
    
        $data = [];
        foreach ($validatedData['tax_number'] as $index => $taxNumber) {
            if (empty($taxNumber) &&
                empty($validatedData['amount_of_bad_debit'][$index]) &&
                empty($validatedData['name_of_debtor'][$index]) &&
                empty($validatedData['amount_of_bad_debt'][$index]) &&
                empty($validatedData['date_of_debt'][$index]) &&
                empty($validatedData['was_included_in_previous_income'][$index]) &&
                empty($validatedData['has_all_means_been_taken'][$index]) &&
                empty($validatedData['amount_allowed'][$index])) {
                continue;
            }
    
            $data[] = [
                'user_id' => $userId,
                'tax_number' => $taxNumber,
                'name_of_debtor' => $validatedData['name_of_debtor'][$index],
                'name_of_debtor' => $validatedData['name_of_debtor'][$index],
                'amount_of_bad_debt' => $validatedData['amount_of_bad_debt'][$index],
                'date_of_debt' => $validatedData['date_of_debt'][$index],
                'was_included_in_previous_income' => isset($validatedData['was_included_in_previous_income'][$index]) ? 1 : 0,
                'has_all_means_been_taken' => isset($validatedData['has_all_means_been_taken'][$index]) ? 1 : 0,
                'amount_allowed' => $validatedData['amount_allowed'][$index],
                'total_1' => $validatedData['total_1'],
                'amount_of_bad_debit' => $validatedData['amount_of_bad_debit'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
    
        if (!empty($data)) {
            AppendixNineteen::insert($data);
        }
    
        return redirect()->back()->with('success', 'Data saved successfully.');
    }
    

    public function storeAppendixTwenty(Request $request)
    {
        $validatedData = $request->validate([
            'tax_number.*' => 'nullable|string',
            'name_of_donation.*' => 'nullable|string',
            'govermental_entity.*' => 'nullable|boolean', // Adjust validation to handle boolean values
            'value_of_donation.*' => 'nullable|numeric',
            'allowable_dontations.*' => 'nullable|numeric',
            'unauthorized_differences_one.*' =>'nullable|numeric',
            'total_1' => 'nullable|numeric',
            'total_2' => 'nullable|numeric',
            'total_3' => 'nullable|numeric',
    
            'tax_number_1.*' => 'nullable|string',
            'name_of_entity.*' => 'nullable|string',
            'value_subsidies.*' => 'nullable|numeric',
            'allowable_allowances.*' => 'nullable|numeric',
            'unauthorized_differernce_1.*' => 'nullable|numeric',
            
            'total_amount_1' => 'nullable|numeric',
            'total_amount_2' => 'nullable|numeric',
            'total_amount_3' => 'nullable|numeric',
        ]);
    
        $userId = Auth::id();
    
        $data = [];
        $value = [];
        foreach ($validatedData['tax_number'] as $index => $taxNumber) {
            if (empty($taxNumber) &&
                empty($validatedData['name_of_donation'][$index]) &&
                empty($validatedData['govermental_entity'][$index]) &&
                empty($validatedData['value_of_donation'][$index]) &&
                empty($validatedData['allowable_dontations'][$index]) &&
                empty($validatedData['unauthorized_differences_one'][$index])) {
                continue;
            }
    
            $data[] = [
                'user_id' => $userId,
                'tax_number' => $taxNumber,
                'name_of_donation' => $validatedData['name_of_donation'][$index],
                'govermental_entity' => isset($validatedData['govermental_entity'][$index]) ? 1 : 0, // Convert to boolean
                'value_of_donation' => $validatedData['value_of_donation'][$index],
                'allowable_dontations' => $validatedData['allowable_dontations'][$index],
                'unauthorized_differences_one' => $validatedData['unauthorized_differences_one'][$index],
                'total_1' => $validatedData['total_1'],
                'total_2' => $validatedData['total_2'],
                'total_3' => $validatedData['total_3'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
    
        foreach ($validatedData['tax_number_1'] as $index => $taxNumbers) {
            if (empty($taxNumbers) &&
                empty($validatedData['name_of_entity'][$index]) &&
                empty($validatedData['value_subsidies'][$index]) &&
                empty($validatedData['allowable_allowances'][$index]) &&
                empty($validatedData['unauthorized_differernce_1'][$index])) {
                continue;
            }
    
            $value[] = [
                'user_id' => $userId,
                'tax_number_1' => $taxNumbers,
                'name_of_entity' => $validatedData['name_of_entity'][$index],
                'value_subsidies' => $validatedData['value_subsidies'][$index],
                'allowable_allowances' => $validatedData['allowable_allowances'][$index],
                'unauthorized_differernce_1' => $validatedData['unauthorized_differernce_1'][$index],
                'total_amount_1' => $validatedData['total_amount_1'],
                'total_amount_2' => $validatedData['total_amount_2'],
                'total_amount_3' => $validatedData['total_amount_3'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
    
        if (!empty($data)) {
            AppendixTwenty::insert($data);
        }
        if (!empty($value)) {
            AppendixTwentyB::insert($value);
        }
    
        return redirect()->back()->with('success', 'Data saved successfully.');
    }
    
    public function storeAppendixTwentyOne(Request $request)
    {
        $validatedData = $request->validate([
            'tax_number.*' => 'nullable|string|max:15',
            'name_of_insurance_company.*' => 'nullable|string',
            'local_insurance.*' => 'nullable|in:yes,no',
            'external_insurance.*' => 'nullable|in:yes,no',
            'insurance_current_period.*' => 'nullable|numeric',
            'allowed_insurance_premiums.*' => 'nullable|numeric',
            'difference_allowed.*' => 'nullable|numeric',
            'total_1' => 'nullable|numeric',
        ]);

        $userId = Auth::id();

        $data = [];

        foreach ($validatedData['tax_number'] as $index => $taxNumber) {
            $nameOfInsuranceCompany = $validatedData['name_of_insurance_company'][$index] ?? null;
            $localInsurance = $validatedData['local_insurance'][$index] ?? null;
            $externalInsurance = $validatedData['external_insurance'][$index] ?? null;
            $insuranceCurrentPeriod = $validatedData['insurance_current_period'][$index] ?? null;
            $allowedInsurancePremiums = $validatedData['allowed_insurance_premiums'][$index] ?? null;
            $differenceAllowed = $validatedData['difference_allowed'][$index] ?? null;

            if (
                is_null($taxNumber) &&
                is_null($nameOfInsuranceCompany) &&
                is_null($localInsurance) &&
                is_null($externalInsurance) &&
                is_null($insuranceCurrentPeriod) &&
                is_null($allowedInsurancePremiums) &&
                is_null($differenceAllowed)
            ) {
                continue;
            }

            $data[] = [
                'user_id' => $userId,
                'tax_number' => $taxNumber,
                'name_of_insurance_company' => $nameOfInsuranceCompany,
                'local_insurance' => $localInsurance ? 1 : 0,
                'external_insurance' => $externalInsurance ? 1 : 0,
                'insurance_current_period' => $insuranceCurrentPeriod,
                'allowed_insurance_premiums' => $allowedInsurancePremiums,
                'difference_allowed' => $differenceAllowed,
                'total_1' => $validatedData['total_1'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($data)) {
            AppendixTwentyOne::insert($data);
        }

        return redirect()->back()->with('success', 'Data saved successfully.');
    }

    public function storeAppendixTwentyTwo(Request $request)
    {
        $validatedData = $request->validate([
            'amount_of_bad_debit' => 'nullable|numeric',
            'income_type.*' => 'nullable|string',
            'amount_in_statement.*' => 'nullable|numeric',
            'allowed_amount.*' => 'nullable|numeric',
            'not_allowed_amount.*' => 'nullable|numeric',
            'total_1' => 'nullable|numeric',
            'total_2' => 'nullable|numeric',
            'total_3' => 'nullable|numeric',
        ]);

        $userId = Auth::id();

        $data = [];

        foreach ($validatedData['income_type'] as $index => $incomeType) {
            $amountInStatement = $validatedData['amount_in_statement'][$index] ?? null;
            $allowedAmount = $validatedData['allowed_amount'][$index] ?? null;
            $notAllowedAmount = $validatedData['not_allowed_amount'][$index] ?? null;

            // Check if all fields are null or empty
            if (empty($incomeType) && is_null($amountInStatement) && is_null($allowedAmount) && is_null($notAllowedAmount)) {
                continue;
            }

            // Add to data array if at least one field is not empty
            $data[] = [
                'user_id' => $userId,
                'income_type' => $incomeType,
                'amount_in_statement' => $amountInStatement,
                'allowed_amount' => $allowedAmount,
                'not_allowed_amount' => $notAllowedAmount,
                'total_1' => $validatedData['total_1'],
                'total_2' => $validatedData['total_2'],
                'total_3' => $validatedData['total_3'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($data)) {
            AppendixTwentyTwo::insert($data);
        }

        return redirect()->back()->with('success', 'Data saved successfully.');
    }
    public function storeAppendixTwentyThree(Request $request)
    {
        $validatedData = $request->validate([
            'bank_interest.*' => 'nullable|numeric',
            'allowed_bank_value.*' => 'nullable|numeric',
            'capital_interest.*' => 'nullable|numeric',
            'other_bank_interest_.*' => 'nullable|numeric',
            'total_1' => 'nullable|numeric',
            'total_2' => 'nullable|numeric',
            'total_3' => 'nullable|numeric',
            'total_4' => 'nullable|numeric',
        ]);
    
        $userId = Auth::id();
    
        $data = [];
    
        foreach ($validatedData['bank_interest'] as $index => $bankInterest) {
            $allowedBankValue = $validatedData['allowed_bank_value'][$index] ?? null;
            $capitalInterest = $validatedData['capital_interest'][$index] ?? null;
            $otherBankInterest = $validatedData['other_bank_interest_'][$index] ?? null;
    
            // Check if all fields are null or empty
            if (empty($bankInterest) && is_null($allowedBankValue) && is_null($capitalInterest) && is_null($otherBankInterest)) {
                continue;
            }
    
            // Add to data array if at least one field is not empty
            $data[] = [
                'user_id' => $userId,
                'bank_interest' => $bankInterest,
                'allowed_bank_value' => $allowedBankValue,
                'capital_interest' => $capitalInterest,
                'other_bank_interest' => $otherBankInterest,
                'total_1' => $validatedData['total_1'],
                'total_2' => $validatedData['total_2'],
                'total_3' => $validatedData['total_3'],
                'total_4' => $validatedData['total_4'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
    
        if (!empty($data)) {
            AppendixTwentyThree::insert($data);
        }
    
        return redirect()->back()->with('success', 'Data saved successfully.');
    }
    
    public function storeAppendixTwentyFour(Request $request)
    {
        $validatedData = $request->validate([
            'type.*' => 'nullable|string',
            'value_of_provision_start.*' => 'nullable|numeric',
            'the_value.*' => 'nullable|numeric',
            'allowed_value.*' => 'nullable|numeric',
            'unallowed_value.*' => 'nullable|numeric',
            'recovery_allocations.*' => 'nullable|numeric',
            'value_of_provision_end.*' => 'nullable|numeric',
            'total_1' => 'nullable|numeric'
        ]);
    
        $userId = Auth::id();
    
        $data = [];
    
        foreach ($validatedData['type'] as $index => $type) {
            // Check if at least one of the numeric fields is filled
            if (
                !is_null($validatedData['value_of_provision_start'][$index]) ||
                !is_null($validatedData['the_value'][$index]) ||
                !is_null($validatedData['allowed_value'][$index]) ||
                !is_null($validatedData['unallowed_value'][$index]) ||
                !is_null($validatedData['recovery_allocations'][$index]) ||
                !is_null($validatedData['value_of_provision_end'][$index])
            ) {
                $data[] = [
                    'user_id' => $userId,
                    'type' => $type,
                    'value_of_provision_start' => $validatedData['value_of_provision_start'][$index],
                    'the_value' => $validatedData['the_value'][$index],
                    'allowed_value' => $validatedData['allowed_value'][$index],
                    'unallowed_value' => $validatedData['unallowed_value'][$index],
                    'recovery_allocations' => $validatedData['recovery_allocations'][$index],
                    'value_of_provision_end' => $validatedData['value_of_provision_end'][$index],
                    'total_1' => $validatedData['total_1'],
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }
    
        if (!empty($data)) {
            AppendixTwentyFour::insert($data);
        }
    
        return redirect()->back()->with('success', 'Data saved successfully.');
    }
    public function storeAppendixTwentyFive(Request $request)
    {
        $validatedData = $request->validate([
            'tax_number.*' => 'nullable|string',
            'company_name.*' => 'nullable|string',
            'nationality.*' => 'nullable|string',
            'currency.*' => 'nullable|numeric',
            'value.*' => 'nullable|numeric',
            'total_1' => 'nullable|numeric'
        ]);
    
        $userId = Auth::id();
    
        $data = [];
    
        foreach ($validatedData['tax_number'] as $index => $taxNumber) {
            // Check if at least one of the numeric fields is filled
            if (
                !is_null($validatedData['company_name'][$index]) ||
                !is_null($validatedData['nationality'][$index]) ||
                !is_null($validatedData['currency'][$index]) ||
                !is_null($validatedData['value'][$index])
            ) {
                $data[] = [
                    'user_id' => $userId,
                    'tax_number' => $taxNumber,
                    'company_name' => $validatedData['company_name'][$index],
                    'nationality' => $validatedData['nationality'][$index],
                    'currency' => $validatedData['currency'][$index],
                    'value' => $validatedData['value'][$index],
                    'total_1' => $validatedData['total_1'],
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }
    
        if (!empty($data)) {
            AppendixTwentyFive::insert($data);
        }
    
        return redirect()->back()->with('success', 'Data saved successfully.');
    }
    
    public function storeAppendixTwentySix(Request $request)
    {
        $validatedData = $request->validate([
            'country.*' => 'nullable|string',
            'net_profit.*' => 'nullable|string',
            'income_tax_iqd.*' => 'nullable|string',
            'unused_foreign_tax_credit.*' => 'nullable|numeric',
            'total_foreign_tax.*' => 'nullable|numeric',
            'maximum_tax_credit.*' => 'nullable|numeric',
            'due_tax_approved_foreign_tax.*' => 'nullable|numeric',
            'allowable_foreign_tax.*' => 'nullable|numeric',
            'approval_foreign_tax.*' => 'nullable|numeric',
            'total_1' => 'nullable|numeric'
        ]);

        $userId = Auth::id();

        $data = [];

        foreach ($validatedData['country'] as $index => $country) {
            if (
                !is_null($validatedData['net_profit'][$index]) &&
                !is_null($validatedData['income_tax_iqd'][$index]) &&
                !is_null($validatedData['unused_foreign_tax_credit'][$index]) &&
                !is_null($validatedData['total_foreign_tax'][$index]) &&
                !is_null($validatedData['maximum_tax_credit'][$index]) &&
                !is_null($validatedData['due_tax_approved_foreign_tax'][$index]) &&
                !is_null($validatedData['allowable_foreign_tax'][$index]) &&
                !is_null($validatedData['approval_foreign_tax'][$index])
            ) {
                $data[] = [
                    'user_id' => $userId,
                    'country' => $country,
                    'net_profit' => $validatedData['net_profit'][$index],
                    'income_tax_iqd' => $validatedData['income_tax_iqd'][$index],
                    'unused_foreign_tax_credit' => $validatedData['unused_foreign_tax_credit'][$index],
                    'total_foreign_tax' => $validatedData['total_foreign_tax'][$index],
                    'maximum_tax_credit' => $validatedData['maximum_tax_credit'][$index],
                    'due_tax_approved_foreign_tax' => $validatedData['due_tax_approved_foreign_tax'][$index],
                    'allowable_foreign_tax' => $validatedData['allowable_foreign_tax'][$index],
                    'approval_foreign_tax' => $validatedData['approval_foreign_tax'][$index],
                    'total_1' => $validatedData['total_1'],
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        if (!empty($data)) {
            AppendixTwentySix::insert($data);
        }

        return redirect()->back()->with('success', 'Data saved successfully.');
    }

    public function storeAppendixTwentySeven(Request $request)
    {
        $validatedData = $request->validate([
            'deduction_entity.*' => 'nullable|string',
            'tax_number.*' => 'nullable|string',
            'date_of_deduction.*' => 'nullable|date',
            'number.*' => 'nullable|integer',
            'date.*' => 'nullable|date',
            'amount_of_withheld_tax.*' => 'nullable|numeric',
            'notes.*' => 'nullable|string',
            'total_1' => 'nullable|numeric'
        ]);

        $userId = Auth::id();

        $data = [];

        foreach ($validatedData['deduction_entity'] as $index => $entity) {
            if (
                !is_null($validatedData['tax_number'][$index]) &&
                !is_null($validatedData['date_of_deduction'][$index]) &&
                !is_null($validatedData['number'][$index]) &&
                !is_null($validatedData['date'][$index]) &&
                !is_null($validatedData['amount_of_withheld_tax'][$index]) &&
                !is_null($validatedData['notes'][$index])
            ) {
                $data[] = [
                    'user_id' => $userId,
                    'deduction_entity' => $entity,
                    'tax_number' => $validatedData['tax_number'][$index],
                    'date_of_deduction' => $validatedData['date_of_deduction'][$index],
                    'number' => $validatedData['number'][$index],
                    'date' => $validatedData['date'][$index],
                    'amount_of_withheld_tax' => $validatedData['amount_of_withheld_tax'][$index],
                    'notes' => $validatedData['notes'][$index],
                    'total_1' => $validatedData['total_1'],
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        if (!empty($data)) {
            AppendixTwentySeven::insert($data);
        }

        return redirect()->back()->with('success', 'Data saved successfully.');
    }
    
    public function formF() 
    {
        $userId = Auth::id();
    
        $depreciationTangibleAssets = TangibleAsset::select('tangible_assets.*')
        ->join('appendix_sixes', 'tangible_assets.appendix_six_id', '=', 'appendix_sixes.id')
        ->where('appendix_sixes.user_id', $userId)
        ->sum('tangible_assets.total_total_allowable');
        $depreciationIntangibleAssets = IntangibleAsset::where('user_id', $userId)->sum('total_depreciation_of_assets_sold');
        $bookLossesInvestmentsSolidarity = AppendixEight::where('user_id', $userId)->sum('total_1');
        $lossesInvestmentsAbroad = AppendixEightB::where('user_id', $userId)->sum('total_2');
        $LossesInvestmentsNationalStock = AppendixEightC::where('user_id', $userId)->sum('total_3');
        $badDebtExpenses = AppendixNineteen::where('user_id', $userId)->sum('total_1');
        $unauthorizedDonationsGifts = AppendixTwenty::where('user_id', $userId)->sum('total_3');
        $unauthorizedSubsidyExpenses = AppendixTwentyB::where('user_id', $userId)->sum('total_amount_3');
        $unauthorizedInsuranceExpenses = AppendixTwentyOne::where('user_id', $userId)->sum('total_1');
        $unauthorizedPaymentsDirector = AppendixTwentyTwo::where('user_id', $userId)->sum('total_3');
        $unauthorizedBenefitsCommissions = AppendixTwentyThree::where('user_id', $userId)->sum('total_4');
        $unauthorizedAllowances = AppendixTwentyFour::where('user_id', $userId)->sum('total_1');
    
        return view('Taxpayer.AnnualForms.FormF', compact(
            'depreciationTangibleAssets', 
            'depreciationIntangibleAssets', 
            'bookLossesInvestmentsSolidarity',
            'LossesInvestmentsNationalStock',
            'lossesInvestmentsAbroad', 
            'badDebtExpenses', 
            'unauthorizedDonationsGifts', 
            'unauthorizedSubsidyExpenses',
            'unauthorizedInsuranceExpenses', 
            'unauthorizedPaymentsDirector', 
            'unauthorizedBenefitsCommissions',
            'unauthorizedAllowances'
        ));
    }
    
    public function formA()
    {
        $userId = Auth::id();
    
        $netTaxableIncome = AppendixThree::where('user_id', $userId)->sum('net_taxable_income');
        $previousYearsLosses = AppendixTen::where('user_id', $userId)->sum('total');
        $foreignTaxAdoption = AppendixTwentySix::where('user_id', $userId)->sum('total_1');
        $taxDeducted = AppendixTwentySeven::where('user_id', $userId)->sum('total_1');
    
        return view('Taxpayer.AnnualForms.FormA', compact('previousYearsLosses', 'netTaxableIncome', 'foreignTaxAdoption', 'taxDeducted'));
    }
    

    

}