<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixFifteen extends Model
{
    use HasFactory;
    protected $table = 'appendix_fifteen';

    protected $fillable = [
        'user_id',
        'tax_number',
        'company_name',
        'fees',
        'admin_expenses',
        'research_development_expenses',
        'technical_assistance',
        'similar_amounts',
        'total_1',
        'total_2',
        'total_3',
        'total_4',
        'total_5',

    ];
  
}
