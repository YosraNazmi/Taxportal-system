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
        Schema::create('appendix_twenty_four', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type')->nullable();
            $table->decimal('value_of_provision_start', 15, 2)->nullable();
            $table->decimal('the_value', 15, 2)->nullable();
            $table->decimal('allowed_value', 15, 2)->nullable();
            $table->decimal('unallowed_value', 15, 2)->nullable();
            $table->decimal('recovery_allocations', 15, 2)->nullable();
            $table->decimal('value_of_provision_end', 15, 2)->nullable();
            $table->decimal('total_1', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appendix_twenty_four');
    }
};
