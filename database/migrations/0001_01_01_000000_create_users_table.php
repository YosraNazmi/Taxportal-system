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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('UPN')->unique();
            $table->date('dob');
            $table->string('category');
            $table->string('idNo');
            $table->string('companyName');
            $table->string('uen')->unique();
            $table->string('select');
            $table->string('addressLine1');
            $table->string('city');
            $table->string('country');
            $table->string('postalCode');
            $table->string('ePhoneNbr');
            $table->string('email')->unique();
            $table->string('code');
            $table->string('password');
            $table->string('status')->default('pending'); // Set default value to 'pending'
            $table->string('approval_comment');
            $table->string('approval_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
