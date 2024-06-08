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
        Schema::create('appendix_eleven', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('link_code')->nullable();
            $table->string('batch')->nullable();
            $table->string('refunds')->nullable();
            $table->string('debit_account')->nullable();
            $table->string('credit_account')->nullable();
            $table->string('sold_assets')->nullable();
            $table->string('purchased_assets')->nullable();
            $table->string('total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appendix_eleven');
    }
};
