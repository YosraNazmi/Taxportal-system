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
        Schema::create('appendix_twenty_six', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('country')->nullable();
            $table->string('net_profit')->nullable();
            $table->string('income_tax_iqd')->nullable();
            $table->decimal('unused_foreign_tax_credit', 15, 2)->nullable();
            $table->decimal('total_foreign_tax', 15, 2)->nullable();
            $table->decimal('maximum_tax_credit', 15, 2)->nullable();
            $table->decimal('due_tax_approved_foreign_tax', 15, 2)->nullable();
            $table->decimal('allowable_foreign_tax', 15, 2)->nullable();
            $table->decimal('approval_foreign_tax', 15, 2)->nullable();
            $table->decimal('total_1', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appendix_twenty_six');
    }
};
