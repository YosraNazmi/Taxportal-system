<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('income_statement', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('current_revenue_of_comodity')->nullable();
            $table->string('current_Business_income')->nullable();
            $table->string('curent_Revenue_from_business_activity')->nullable();
            $table->string('current_operating_income_for_others')->nullable();
            $table->string('current_interest_income_and_land_rents')->nullable();
            $table->string('current_Subsidies_income')->nullable();
            $table->string( 'current_Convertible_income')->nullable();
            $table->string('current_Other_income')->nullable();
            $table->string('current_total_revenue')->nullable();
            $table->string('current_Cost_of_goods_sold')->nullable();
            $table->string('current_Total_profit_loss')->nullable();
            $table->string('current_salaries_and_wages')->nullable();
            $table->string('current_commodity_supplies')->nullable();
            $table->string('current_maintenance_services')->nullable();
            $table->string('current_research_and_consulting_services')->nullable();
            $table->string('current_advertising_and_hospitality')->nullable();
            $table->string('current_transport_and_communications')->nullable();
            $table->string('current_rental_of_fixed_assets')->nullable();
            $table->string('current_rental_of_land')->nullable();
            $table->string('current_expenses_of_subscriptions')->nullable();
            $table->string('current_insurance_expenses')->nullable();
            $table->string('current_reward_for_non_workers')->nullable();
            $table->string('current_taxes_and_fees')->nullable();
            $table->string('current_legal_services_expenses')->nullable();
            $table->string('current_banking_services_expenses')->nullable();
            $table->string('current_training_and_rehabilitation_expenses')->nullable();
            $table->string('current_other_service_expenses')->nullable();
            $table->string('current_contracting_and_services')->nullable();
            $table->string('current_interest_local')->nullable();
            $table->string('current_interest_abroad')->nullable();
            $table->string('current_depreciations')->nullable();
            $table->string('current_retirement_and_social_security_expenses')->nullable();
            $table->string('current_expenses_to_contribute')->nullable();
            $table->string('current_donation_photographers')->nullable();
            $table->string('current_compensation_expenses')->nullable();
            $table->string('current_bad_debts')->nullable();
            $table->string('current_expenses_for_special_services')->nullable();
            $table->string('current_other_transfer_expenses')->nullable();
            $table->string('current_taxes_and_expenses')->nullable();
            $table->string('current_subsidies_expenses')->nullable();
            $table->string('current_expenses_of_previous')->nullable();
            $table->string('current_incidental_expenses')->nullable();
            $table->string('current_capital_losses')->nullable();
            $table->string('current_expected_losses')->nullable();
            $table->string('current_potential_maintenance')->nullable();
            $table->string('current_loss_of_commodity')->nullable();
            $table->string('current_losses_of_investment')->nullable();
            $table->string('current_other_expenses')->nullable();
            $table->string('current_total_expenditure')->nullable();
            $table->string('current_net_profit_before_tax')->nullable();
            $table->string('current_income_tax')->nullable();
            $table->string('current_net_profit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_statement');
    }
};
