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
        Schema::create('appendix_twenty_two', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('income_type')->nullable();
            $table->decimal('amount_in_statement', 15, 2)->nullable();
            $table->decimal('allowed_amount', 15, 2)->nullable();
            $table->decimal('not_allowed_amount', 15, 2)->nullable();
            $table->decimal('total_1', 15, 2)->nullable();
            $table->decimal('total_2', 15, 2)->nullable();
            $table->decimal('total_3', 15, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appendix_twenty_two');
    }
};
