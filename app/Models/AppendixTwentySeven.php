<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixTwentySeven extends Model
{
    use HasFactory;
    protected $table = 'appendix_twenty_seven';

    protected $fillable = [
        'user_id',
        'deduction_entity',
        'tax_number',
        'date_of_deduction',
        'number',
        'date',
        'amount_of_withheld_tax',
        'notes',
        'total_1'
    ];
}
