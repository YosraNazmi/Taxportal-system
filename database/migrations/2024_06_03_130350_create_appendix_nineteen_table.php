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
        Schema::create('appendix_nineteen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('amount_of_bad_debit', 15, 2)->nullable();
            $table->string('tax_number')->nullable();
            $table->string('name_of_debtor')->nullable();
            $table->decimal('amount_of_bad_debt', 15, 2)->nullable();
            $table->date('date_of_debt')->nullable();
            $table->boolean('was_included_in_previous_income')->nullable();
            $table->boolean('has_all_means_been_taken')->nullable();
            $table->decimal('amount_allowed', 15, 2)->nullable();
            $table->decimal('total_1', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appendix_nineteen');
    }
};
