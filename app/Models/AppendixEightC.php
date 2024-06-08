<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixEightC extends Model
{
    use HasFactory;
    protected $table = 'appendix_eight_c';
    protected $fillable = [
        'user_id',
        'tax_number',
        'owned_company_name',
        'nationality',
        'company_type',
        'number_of_shares',
        'ownership_percentage',
        'number_of_preferred_shared',
        'book_value',
        'accounting_profit',
        'total_3',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
