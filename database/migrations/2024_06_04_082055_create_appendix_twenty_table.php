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
        Schema::create('appendix_twenty', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('tax_number', 15, 2)->nullable();
            $table->string('name_of_donation')->nullable();
            $table->boolean('govermental_entity')->nullable();
            $table->decimal('value_of_donation')->nullable();
            $table->decimal('allowable_dontations', 15, 2)->nullable();
            $table->decimal('unauthorized_differences_one', 15, 2)->nullable();
            $table->decimal('total_1', 15, 2)->nullable();
            $table->decimal('total_2', 15, 2)->nullable();
            $table->decimal('total_3', 15, 2)->nullable();
            $table->timestamps();
        });
        Schema::create('appendix_twenty_b', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('tax_number_1', 15, 2)->nullable();
            $table->string('name_of_entity')->nullable();
            $table->decimal('value_subsidies')->nullable();
            $table->decimal('allowable_allowances')->nullable();
            $table->decimal('unauthorized_differernce_1', 15, 2)->nullable();
            $table->decimal('total_amount_1', 15, 2)->nullable();
            $table->decimal('total_amount_2', 15, 2)->nullable();
            $table->decimal('total_amount_3', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appendix_twenty');
    }
};
