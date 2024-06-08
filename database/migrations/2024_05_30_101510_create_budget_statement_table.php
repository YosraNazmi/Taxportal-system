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
        Schema::create('budget_statement', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('current_funds_banks')->nullable();
            $table->string('current_short_term_investments')->nullable();
            $table->string('current_paid_short_term_loans')->nullable();
            $table->string('current_trade_receivables')->nullable();
            $table->string('current_other_receivables')->nullable();
            $table->string('current_inventory')->nullable();
            $table->string('current_other_short_term_assets')->nullable();
            $table->string('current_total_current_assets')->nullable();
            $table->string('current_long_term_investments')->nullable();
            $table->string('current_long_term_loans_granted')->nullable();
            $table->string('current_total_tangible_fixed_assets')->nullable();
            $table->string('current_total_depreciation')->nullable();
            $table->string('current_total_intangible_fixed_assets')->nullable();
            $table->string('current_total_amortization')->nullable();
            $table->string('current_other_long_term_assets')->nullable();
            $table->string('current_total_long_term_assets')->nullable();
            $table->string('current_total_assets')->nullable();
            $table->string('current_accounts_payable_banks')->nullable();
            $table->string('current_commercial_suppliers')->nullable();
            $table->string('current_payment_papers')->nullable();
            $table->string('current_accounts_payable_taxes')->nullable();
            $table->string('current_revenues_received')->nullable();
            $table->string('current_other_creditors')->nullable();
            $table->string('current_short_term_loans_received')->nullable();
            $table->string('current_other_short_term_liabilities')->nullable();
            $table->string('current_total_short_term_liabilities')->nullable();
            $table->string('current_long_term_loans_received')->nullable();
            $table->string('current_allocations')->nullable();
            $table->string('current_other_long_term_liabilities')->nullable();
            $table->string('current_total_long_term_liabilities')->nullable();
            $table->string('current_total_liabilities')->nullable();
            $table->string('current_ordinary_shares')->nullable();
            $table->string('current_preferred_shares')->nullable();
            $table->string('current_premiums')->nullable();
            $table->string('current_reserves')->nullable();
            $table->string('current_surplus')->nullable();
            $table->string('current_total_equity')->nullable();
            $table->string('current_total_liabilities_and_capital')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_statement');
    }
};
