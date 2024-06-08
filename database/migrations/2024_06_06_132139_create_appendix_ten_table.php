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
        Schema::create('appendix_ten', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('year_one', 15)->nullable();
            $table->decimal('original_loss_one', 15, 2)->nullable();
            $table->decimal('written_offs_previous_year_one', 15, 2)->nullable();
            $table->decimal('written_offs_current_year_one', 15, 2)->nullable();
            $table->decimal('accumulated_loss_one', 15, 2)->nullable();
            $table->decimal('total', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appendix_ten');
    }
};
