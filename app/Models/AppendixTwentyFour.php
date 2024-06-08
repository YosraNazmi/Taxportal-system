<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixTwentyFour extends Model
{
    use HasFactory;
    protected $table = 'appendix_twenty_four';
    protected $fillable = [
        'user_id',
        'type',
        'value_of_provision_start',
        'the_value',
        'allowed_value',
        'unallowed_value',
        'recovery_allocations',
        'value_of_provision_end',
        'total_1'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
