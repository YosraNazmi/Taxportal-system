<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TangibleAsset extends Model
{
    use HasFactory;
    protected $fillable = [
        'appendix_six_id',
        'category_assets',
        'directory_number',
        'book_value',
        'cost_acquisition',
        'cost_assets',
        'total_allowable',
        'accumulated',
        'book_value_end',
        'book_value_end' ,
        'total_book_value', 
        'total_cost_acquisition',
        'total_cost_assets' ,
        'total_total_allowable',
        'total_accumulated' ,
        'total_book_value_end'
    ];

    public function appendixSix()
    {
        return $this->belongsTo(AppendixSix::class);
    }
}
