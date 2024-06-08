<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixTwentyB extends Model
{
    use HasFactory;
    protected $table = 'appendix_twenty_b';
    protected $fillable = [
        'user_id',
        'tax_number_1',
        'name_of_entity',
        'value_subsidies',
        'allowable_allowances',
        'unauthorized_differernce_1',
        'total_amount_1',
        'total_amount_2',
        'total_amount_3',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
