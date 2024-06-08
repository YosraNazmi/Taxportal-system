<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixTwelve extends Model
{
    use HasFactory;
    protected $table = 'appendix_twelve';
    protected $fillable = [
        'user_id',
        'link_code',
        'tax_number',
        'batch',
        'refunds',
        'debit_account',
        'credit_account',
        'sold_assets',
        'purchased_assets',
        'leased_assets',
        'total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
