<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixTwentyThree extends Model
{
    use HasFactory;
    protected $table = 'appendix_twenty_three';

    protected $fillable = [
        'user_id',
        'bank_interest',
        'allowed_bank_value',
        'capital_interest',
        'other_bank_interest',
        'total_1',
        'total_2',
        'total_3',
        'total_4',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
