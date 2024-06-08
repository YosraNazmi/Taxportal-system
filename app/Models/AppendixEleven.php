<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixEleven extends Model
{
    use HasFactory;
    protected $table = 'appendix_eleven';
    protected $fillable = [
        'user_id',
        'link_code',
        'batch',
        'refunds',
        'debit_account',
        'credit_account',
        'sold_assets',
        'purchased_assets',
        'total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
