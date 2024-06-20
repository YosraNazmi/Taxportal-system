<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixEightB extends Model
{
    use HasFactory;
    protected $table = 'appendix_eight_b';
    protected $fillable = [
        'user_id',
        'tax_number',
        'owned_company_name',
        'type_of_company',
        'number_of_shares',
        'ownership_percentage',
        'number_of_preferred_contribution',
        'book_value',
        'accounting_profit',
        'total_2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
