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
        Schema::create('annual_form_b', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formA_id')->nullable();
            $table->decimal('netTaxableIncome', 10, 2)->nullable();
            $table->decimal('previousYearsLosses', 10, 2)->nullable();
            $table->decimal('taxableIncome', 10, 2)->nullable();
            $table->string('taxRatio', 5, 2)->nullable();
            $table->decimal('toBePaidTax', 10, 2)->nullable();
            $table->decimal('foreignTaxAdoption', 10, 2)->nullable();
            $table->decimal('taxDeducted', 10, 2)->nullable();
            $table->decimal('netPayableTax', 10, 2)->nullable();
            $table->string('execManagerName')->nullable();
            $table->date('execManagerDate')->nullable();
            $table->string('auditorName')->nullable();
            $table->string('auditorPhone')->nullable();
            $table->string('auditorEmail')->nullable();
            $table->string('inwardNumber')->nullable();
            $table->date('inwardDate')->nullable();
            $table->string('employeeName')->nullable();
            $table->date('entryDate')->nullable();
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('formA_id')->references('id')->on('annual_form_a')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annual_form_b');
    }
};
