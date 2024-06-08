<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormE extends Model
{
    use HasFactory;
    protected $table = 'income_statement';
    protected $fillable = [
        'user_id',
        'current_revenue_of_comodity',
        'current_Business_income',
        'curent_Revenue_from_business_activity',
        'current_operating_income_for_others',
        'current_interest_income_and_land_rents',
        'current_Subsidies_income',
        'current_Convertible_income',
        'current_Other_income',
        'current_total_revenue',
        'current_Cost_of_goods_sold',
        'current_Total_profit_loss',
        'current_salaries_and_wages',
        'current_commodity_supplies',
        'current_maintenance_services',
        'current_research_and_consulting_services',
        'current_advertising_and_hospitality',
        'current_transport_and_communications',
        'current_rental_of_fixed_assets',
        'current_rental_of_land',
        'current_expenses_of_subscriptions',
        'current_insurance_expenses',
        'current_reward_for_non_workers',
        'current_taxes_and_fees',
        'current_legal_services_expenses',
        'current_banking_services_expenses',
        'current_training_and_rehabilitation_expenses',
        'current_other_service_expenses',
        'current_contracting_and_services',
        'current_interest_local',
        'current_interest_abroad',
        'current_depreciations',
        'current_retirement_and_social_security_expenses',
        'current_expenses_to_contribute',
        'current_donation_photographers',
        'current_compensation_expenses',
        'current_bad_debts',
        'current_expenses_for_special_services',
        'current_other_transfer_expenses',
        'current_taxes_and_expenses',
        'current_subsidies_expenses',
        'current_expenses_of_previous',
        'current_incidental_expenses',
        'current_capital_losses',
        'current_expected_losses',
        'current_potential_maintenance',
        'current_loss_of_commodity',
        'current_losses_of_investment',
        'current_other_expenses',
        'current_total_expenditure',
        'current_net_profit_before_tax',
        'current_income_tax',
        'current_net_profit',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
