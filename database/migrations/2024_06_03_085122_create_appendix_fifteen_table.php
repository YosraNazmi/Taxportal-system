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
        Schema::create('appendix_fifteen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('tax_number')->nullable();
            $table->string('company_name')->nullable();
            $table->decimal('fees')->nullable();
            $table->decimal('admin_expenses')->nullable();
            $table->decimal('research_development_expenses')->nullable();
            $table->string('technical_assistance', 15, 2)->nullable();
            $table->decimal('similar_amounts')->nullable();
            $table->decimal('total_1')->nullable();
            $table->decimal('total_2')->nullable();
            $table->decimal('total_3')->nullable();
            $table->decimal('total_4')->nullable();
            $table->decimal('total_5')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appendix_fifteen');
    }
};
