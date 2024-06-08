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
        Schema::create('appendix_nine', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('t_asset_type')->nullable();
            $table->date('t_purchase_date')->nullable();
            $table->decimal('t_book_value', 15, 2)->nullable();
            $table->decimal('t_net_selling_value', 15, 2)->nullable();
            $table->decimal('t_profit_loss', 15, 2)->nullable();
            $table->decimal('total_1', 15, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('appendix_nine_b', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('number_of_shares')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('company_name')->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_cost', 15, 2)->nullable();
            $table->decimal('net_selling_value', 15, 2)->nullable();
            $table->decimal('profit_loss', 15, 2)->nullable();
            $table->decimal('total_1', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appendix_nine');
        Schema::dropIfExists('appendix_nine_b');
    }
};
