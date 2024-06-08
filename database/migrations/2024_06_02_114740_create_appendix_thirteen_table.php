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
        Schema::create('appendix_thirteen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('link_code')->nullable();
            $table->string('tax_number')->nullable(); 
            $table->string('net_commercial_sales')->nullable();
            $table->string('net_commercial_purchase')->nullable();
            $table->string('debit_account')->nullable();
            $table->string('credit_account')->nullable();
            $table->string('total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appendix_thirteen');
    }
};
