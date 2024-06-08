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
        Schema::create('appendix_twenty_five', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('tax_number')->nullable();
            $table->string('company_name')->nullable();
            $table->string('nationality')->nullable();
            $table->decimal('currency', 15, 2)->nullable();
            $table->decimal('value', 15, 2)->nullable();
            $table->decimal('total_1', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appendix_twenty_five');
    }
};
