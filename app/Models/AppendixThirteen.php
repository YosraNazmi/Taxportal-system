<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixThirteen extends Model
{
    use HasFactory;

    protected $table = 'appendix_thirteen';

    protected $fillable = [
        'user_id',
        'link_code',
        'tax_number',
        'net_commercial_sales',
        'net_commercial_purchase',
        'debit_account',
        'credit_account',
        'total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
