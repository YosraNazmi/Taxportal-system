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
        Schema::create('appendix_twenty_three', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('bank_interest')->nullable();
            $table->decimal('allowed_bank_value', 15, 2)->nullable();
            $table->decimal('capital_interest', 15, 2)->nullable();
            $table->decimal('other_bank_interest', 15, 2)->nullable();
            $table->decimal('total_1', 15, 2)->nullable();
            $table->decimal('total_2', 15, 2)->nullable();
            $table->decimal('total_3', 15, 2)->nullable();
            $table->decimal('total_4', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appendix_twenty_three');
    }
};
