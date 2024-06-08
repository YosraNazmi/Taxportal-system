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
        Schema::create('appendix_twenty_seven', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('deduction_entity')->nullable();
            $table->string('tax_number')->nullable();
            $table->date('date_of_deduction')->nullable();
            $table->integer('number')->nullable();
            $table->date('date')->nullable();
            $table->decimal('amount_of_withheld_tax', 15, 2)->nullable();
            $table->string('notes')->nullable();
            $table->decimal('total_1', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appendix_twenty_seven');
    }
};
