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
        Schema::create('annual_form_a', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('financialYearFrom');
            $table->date('financialYearTo');
            $table->enum('legalStructureChange', ['yes', 'no']);
            $table->date('legalStructureChangeDate')->nullable();
            $table->string('newLegalStructure')->nullable();
            $table->enum('mainActivityChange', ['yes', 'no']);
            $table->string('mainActivityChangeSpecify')->nullable();
            $table->enum('companyConsolidated', ['yes', 'no']);
            $table->date('companyConsolidationDate')->nullable();
            $table->enum('subsidiaryLiquidated', ['yes', 'no']);
            $table->enum('branchClosed', ['yes', 'no']);
            $table->enum('companyLiquidated', ['yes', 'no']);
            $table->string('accountingSystem' )->nullable(); // Storing as JSON array
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annual_form_a');
    }
};
