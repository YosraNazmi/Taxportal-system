<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixNineteen extends Model
{
    use HasFactory;
    protected $table = 'appendix_nineteen';
    protected $fillable = [
        'user_id',
        'amount_of_bad_debit',
        'tax_number',
        'name_of_debtor',
        'amount_of_bad_debt',
        'date_of_debt',
        'was_included_in_previous_income',
        'has_all_means_been_taken',
        'amount_allowed',
        'total_1',
    ];
}
