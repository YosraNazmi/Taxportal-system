<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixTwentyFive extends Model
{
    use HasFactory;
    protected $table = 'appendix_twenty_five';
    protected $fillable = [
        'user_id',
        'tax_number',
        'company_name',
        'nationality',
        'currency',
        'value',
        'total_1',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
