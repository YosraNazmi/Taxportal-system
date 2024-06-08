<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixSeventeen extends Model
{
    use HasFactory;
    protected $table = 'appendix_seventeen';
    protected $fillable = [
        'user_id',
        'page_number',
        'url',
        'revenue_percentage'
    ];

    // Define the relationship with the user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
