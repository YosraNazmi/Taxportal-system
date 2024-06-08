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
        Schema::create('appendix_five', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('tax_number_merge')->nullable();
            $table->string('previous_company')->nullable();
            $table->string('Liquidated_company_name')->nullable();
            $table->string('tax_number_liquidation')->nullable();
            $table->date('start_date_liquidation')->nullable();
            $table->date('end_date_liquidation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appendix_five');
    }
};
