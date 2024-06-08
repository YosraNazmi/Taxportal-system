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
        Schema::create('appendix_three', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('accounting_result_current_year', 15, 2)->nullable();
            $table->decimal('interest_fines_delays_taxes',15, 2)->nullable();
            $table->decimal('depreciation_tangible_assets',15, 2)->nullable();
            $table->decimal('depreciation_intangible_assets',15, 2)->nullable();
            $table->decimal('book_losses_investments_solidarity',15, 2)->nullable();
            $table->decimal('losses_investments_abroad',15, 2)->nullable();
            $table->decimal('losses_investments_national_stock',15, 2)->nullable();
            $table->decimal('unrealized_losses',15, 2)->nullable();
            $table->decimal('expenses_contribute_parent_subsidary',15, 2)->nullable();
            $table->decimal('bad_debt_expenses',15, 2)->nullable();
            $table->decimal('unauthorized_expenses_compensations_fines',15, 2)->nullable();
            $table->decimal('unauthorized_donations_gifts',15, 2)->nullable();
            $table->decimal('unauthorized_subsidy_expenses',15, 2)->nullable();
            $table->decimal('personal_special_expenses',15, 2)->nullable();
            $table->decimal('unauthorized_insurance_expenses',15, 2)->nullable();
            $table->decimal( 'unauthorized_payments_director',15, 2)->nullable();
            $table->decimal( 'other_non_deductible_expenses',15, 2)->nullable();
            $table->decimal('unauthorized_benefits_commissions',15, 2)->nullable();
            $table->decimal('unauthorized_taxes_fees_penalties',15, 2)->nullable();
            $table->decimal('impairment_tangible_intangible_assets',15, 2)->nullable();
            $table->decimal('unauthorized_allowances',15, 2)->nullable();
            $table->decimal('unpaid_interest_payable',15, 2)->nullable();
            $table->decimal( 'other_positive_adjustments',15, 2)->nullable();
            $table->decimal('total_amounts_added_accounting_result',15, 2)->nullable();
            $table->decimal('depreciation_permitted_tangible_assets',15, 2)->nullable();
            $table->decimal('consumption_tangible_assets_permitted',15, 2)->nullable();
            $table->decimal('amounts_bad_debts_allowed',15, 2)->nullable();
            $table->decimal('book_profits_investments_solidarity_companies',15, 2)->nullable();
            $table->decimal('profits_investments_national_shareholding_companies',15, 2)->nullable();
            $table->decimal('profits_investments_realized_abroad',15, 2)->nullable();
            $table->decimal('unrealized_gains',15, 2)->nullable();
            $table->decimal('benefits_paid_previous_years',15, 2)->nullable();
            $table->decimal('other_income_not_taxable',15, 2)->nullable();
            $table->decimal('other_negative_adjustments',15, 2)->nullable();
            $table->decimal('total_amounts_deducted_accounting_result',15, 2)->nullable();
            $table->decimal( 'net_taxable_income',15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appendix_three');
    }
};
