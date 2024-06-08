<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixFourteen extends Model
{
    use HasFactory;
    protected $table = 'appendix_fourteen';
    protected $fillable = [
        'user_id',
        'beginning_of_year',
        'end_of_year',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
  
}
