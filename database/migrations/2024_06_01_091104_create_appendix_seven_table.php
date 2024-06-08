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
        Schema::create('appendix_seven', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('depreciation_value')->nullable();
            $table->boolean('continuous_installment')->default(false);
            $table->boolean('decreasing_installment')->default(false);
            $table->boolean('another_method_administration')->default(false);
            $table->timestamps();
        });
        Schema::create('intangible_assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('appendix_seven_id')->constrained('appendix_seven')->onDelete('cascade');
            $table->string('type_of_intangible_assets')->nullable();
            $table->decimal('book_value_beginning', 15, 2)->nullable();
            $table->decimal('cost_of_acquisition', 15, 2)->nullable();
            $table->decimal('cost_of_assets_sold', 15, 2)->nullable();
            $table->decimal('total_consumption_allowed', 15, 2)->nullable();
            $table->decimal('depreciation_of_assets_sold', 15, 2)->nullable();
            $table->decimal('book_value_end', 15, 2)->nullable();
            $table->decimal('total_book_value_beginning', 15, 2)->nullable();
            $table->decimal('total_cost_of_acquisition', 15, 2)->nullable();
            $table->decimal('total_cost_of_assets_sold', 15, 2)->nullable();
            $table->decimal('total_total_consumption_allowed', 15, 2)->nullable();
            $table->decimal('total_depreciation_of_assets_sold', 15, 2)->nullable();
            $table->decimal('total_book_value_end', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appendix_seven');
        Schema::dropIfExists('intangible_assets');
    }
};
