<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormD extends Model
{
    use HasFactory;
    protected $table = 'budget_statement';

    protected $fillable = [
            'user_id',
            'current_short_term_investments',
            'current_paid_short_term_loans',
            'current_trade_receivables',
            'current_other_receivables',
            'current_inventory',
            'current_other_short_term_assets',
            'current_total_current_assets',
            'current_long_term_investments',
            'current_long_term_loans_granted',
            'current_total_tangible_fixed_assets',
            'current_total_depreciation',
            'current_total_intangible_fixed_assets',
            'current_total_amortization',
            'current_other_long_term_assets',
            'current_total_long_term_assets',
            'current_total_assets',
            'current_accounts_payable_banks',
            'current_commercial_suppliers',
            'current_payment_papers',
            'current_accounts_payable_taxes',
            'current_revenues_received',
            'current_other_creditors',
            'current_short_term_loans_received',
            'current_other_short_term_liabilities',
            'current_total_short_term_liabilities',
            'current_long_term_loans_received',
            'current_allocations',
            'current_other_long_term_liabilities',
            'current_total_long_term_liabilities',
            'current_total_liabilities',
            'current_ordinary_shares',
            'current_preferred_shares',
            'current_premiums',
            'current_reserves',
            'current_surplus',
            'current_total_equity',
            'current_total_liabilities_and_capital',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}