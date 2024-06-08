<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixSixteen extends Model
{
    use HasFactory;
    protected $table = 'appendix_sixteen';

    protected $fillable = [
        'user_id',
        'company_name',
        'address',
        'batch_code',
        'value',
        'total_1',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
