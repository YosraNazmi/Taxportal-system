<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixFour extends Model
{
    use HasFactory;
    protected $table = 'appendix_four';

    protected $fillable = [
        'user_id',
        'corporation',
        'tax_number',
        'nationality',
        'legal_form',
        'ownership_ratio',
        'ownershipRatio'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
