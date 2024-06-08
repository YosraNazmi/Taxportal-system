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
        Schema::create('appendix_fourteen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('beginning_of_year', 15, 2)->nullable();
            $table->decimal('end_of_year', 15, 2)->nullable();
            $table->timestamps();
        });
        Schema::create('appendix_fourteen_b', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('warehouse_address')->nullable();
            $table->decimal('area', 15, 2)->nullable();
            $table->boolean('private_owned')->default(false);
            $table->boolean('musataha')->default(false);
            $table->boolean('rent')->default(false);
            $table->string('rent_owner_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appendix_fourteen');
        Schema::dropIfExists('appendix_fourteen_b');
    }
};
