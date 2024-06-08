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
        Schema::create('appendix_sixes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('depreciation_value')->nullable();
            $table->boolean('continuous_installment')->default(false);
            $table->boolean('decreasing_installment')->default(false);
            $table->boolean('Another_method_administration')->default(false);
            $table->timestamps();
        });

        Schema::create('tangible_assets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appendix_six_id');
            $table->foreign('appendix_six_id')->references('id')->on('appendix_sixes')->onDelete('cascade');
            $table->string('category_assets')->nullable();
            $table->string('directory_number')->nullable();
            $table->decimal('book_value', 10, 2)->nullable();
            $table->decimal('cost_acquisition', 10, 2)->nullable();
            $table->decimal('cost_assets', 10, 2)->nullable();
            $table->decimal('total_allowable', 10, 2)->nullable();
            $table->decimal('accumulated', 10, 2)->nullable();
            $table->decimal('book_value_end', 10, 2)->nullable();
            $table->decimal('total_book_value', 10, 2)->nullable();
            $table->decimal('total_cost_acquisition', 10, 2)->nullable();
            $table->decimal('total_cost_assets', 10, 2)->nullable();
            $table->decimal('total_total_allowable', 10, 2)->nullable();
            $table->decimal('total_accumulated', 10, 2)->nullable();
            $table->decimal('total_book_value_end', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appendix_sixes');
        Schema::dropIfExists('tangible_assets');
    }
};
