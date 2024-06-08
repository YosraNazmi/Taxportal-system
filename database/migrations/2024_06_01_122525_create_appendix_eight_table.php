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
        
        Schema::create('appendix_eight', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('tax_number')->nullable();
            $table->string('owned_company_name')->nullable();
            $table->integer('number_of_shares')->nullable();
            $table->float('ownership_percentage')->nullable();
            $table->decimal('book_value', 15, 2)->nullable();
            $table->decimal('accounting_profit', 15, 2)->nullable();
            $table->decimal('total_1',15,2)->nullable();
            $table->timestamps();
        });
        Schema::create('appendix_eight_b', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('tax_number')->nullable();
            $table->string('owned_company_name')->nullable();
            $table->string('type_of_company')->nullable();
            $table->integer('number_of_shares')->nullable();
            $table->float('ownership_percentage')->nullable();
            $table->integer('number_of_preferred_contribution')->nullable();
            $table->decimal('book_value', 15, 2)->nullable();
            $table->decimal('accounting_profit', 15, 2)->nullable();
            $table->decimal('total_2',15,2)->nullable();
            $table->timestamps();
            
        });
        Schema::create('appendix_eight_c', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('tax_number')->nullable();
            $table->string('owned_company_name')->nullable();
            $table->string('nationality')->nullable();
            $table->string('company_type')->nullable();
            $table->integer('number_of_shares')->nullable();
            $table->float('ownership_percentage')->nullable();
            $table->integer('number_of_preferred_shared')->nullable();
            $table->decimal('book_value', 15, 2)->nullable();
            $table->decimal('accounting_profit', 15, 2)->nullable();
            $table->decimal('total_3',15,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appendix_eight');
        Schema::dropIfExists('appendix_eight_b');
        Schema::dropIfExists('appendix_eight_c');
    }
};
