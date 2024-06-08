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
        Schema::create('appendix_eighteen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name_secondry_contract');
            $table->string('tax_number');
            $table->string('nationality');
            $table->decimal('contract_value', 15, 2);
            $table->decimal('amount_paid', 15, 2);
            $table->decimal('total_1', 15, 2)->nullable();
            $table->decimal('total_2', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appendix_eighteen');
    }
};
