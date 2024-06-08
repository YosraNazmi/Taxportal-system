<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixEighteen extends Model
{
    use HasFactory;
    protected $table = 'appendix_eighteen';
    protected $fillable = [
        'user_id',
        'name_secondry_contract',
        'tax_number',
        'nationality',
        'contract_value',
        'amount_paid',
        'total_1',
        'total_2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
