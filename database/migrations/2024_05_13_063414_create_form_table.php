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
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('form_reference')->unique();
            $table->string('taxpayer');
            $table->date('propertyyearfrom');
            $table->date('propertuyearto');
            $table->string('uen');
            $table->string('quarter');
            $table->date('seasonfromDate');
            $table->date('seasontoDate');
            $table->string('representativename')->nullable();
            $table->string('upn')->nullable();
            $table->string('position')->nullable();
            $table->string('phone')->nullable();
            $table->integer('numberofEmployee');
            $table->decimal('salaryandwages', 10, 2);
            $table->decimal('Allowancess', 10, 2);
            $table->decimal('bonus', 10, 2);
            $table->decimal('total', 10, 2);
            $table->decimal('retire', 10, 2);
            $table->decimal('Gallowances', 10, 2);
            $table->decimal('summary', 10, 2);
            $table->decimal('examptions', 10, 2);  // Correct spelling if this was meant to be 'exemptions'
            $table->decimal('taxAmount', 10, 2);
            $table->decimal('dueTax', 10, 2);
            $table->decimal('delayone', 10, 2);
            $table->decimal('dalaytwo', 10, 2);  // Corrected from 'dalaytwo'
            $table->decimal('dalaythree', 10, 2);  // Corrected from 'dalaythree'
            $table->decimal('totaloftaxpen', 10, 2);
            $table->decimal('delayinterest', 10, 2);
            $table->decimal('paidamount', 10, 2);
            $table->decimal('blanace', 10, 2);  // Corrected from 'blanace'
            $table->decimal('remainingbalance', 10, 2);
            $table->decimal('tobepaid', 10, 2);
            $table->boolean('agreeCheckbox')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('forms');
    }
};
