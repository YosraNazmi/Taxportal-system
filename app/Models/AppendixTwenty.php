<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixTwenty extends Model
{
    use HasFactory;
    protected $table = 'appendix_twenty';
    protected $fillable = [
        'user_id',
        'tax_number',
        'name_of_donation',
        'govermental_entity',
        'value_of_donation',
        'allowable_dontations',
        'unauthorized_differences_one',
        'total_1',
        'total_2',
        'total_3',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
}
