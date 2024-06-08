<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixTwentyTwo extends Model
{
    use HasFactory;
    protected $table = 'appendix_twenty_two';
    protected $fillable = [
        'user_id',
        'income_type',
        'amount_in_statement',
        'allowed_amount',
        'not_allowed_amount',
        'total_1',
        'total_2',
        'total_3',
        
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
