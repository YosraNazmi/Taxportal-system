<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixTen extends Model
{
    use HasFactory;
    protected $table = 'appendix_ten';

    protected $fillable = [
        'user_id',
        'year_one',
        'original_loss_one',
        'written_offs_previous_year_one',
        'written_offs_current_year_one',
        'accumulated_loss_one',
        'total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
