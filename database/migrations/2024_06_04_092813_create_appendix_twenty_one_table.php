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
        Schema::create('appendix_twenty_one', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('tax_number', 15)->nullable();
            $table->string('name_of_insurance_company')->nullable();
            $table->boolean('local_insurance')->nullable();
            $table->boolean('external_insurance')->nullable();
            $table->decimal('insurance_current_period', 15, 2)->nullable();
            $table->decimal('allowed_insurance_premiums', 15, 2)->nullable();
            $table->decimal('difference_allowed', 15, 2)->nullable();
            $table->decimal('total_1', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appendix_twenty_one');
    }
};
