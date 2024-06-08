<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixEight extends Model
{
    use HasFactory;
    protected $table = 'appendix_eight';
    protected $fillable = [
        'user_id',
        'tax_number',
        'owned_company_name',
        'number_of_shares',
        'ownership_percentage',
        'book_value',
        'accounting_profit',
        'total_1',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
