<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixThree extends Model
{
    use HasFactory;
    protected $table ='appendix_three';
    protected $fillable = [
        'user_id',
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
        'net_taxable_income',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
