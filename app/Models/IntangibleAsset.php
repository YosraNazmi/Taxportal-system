<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntangibleAsset extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'appendix_seven_id',
        'type_of_intangible_assets',
        'book_value_beginning',
        'cost_of_acquisition',
        'cost_of_assets_sold',
        'total_consumption_allowed',
        'depreciation_of_assets_sold',
        'book_value_end',
        'total_book_value_beginning',
        'total_cost_of_acquisition',
        'total_cost_of_assets_sold',
        'total_total_consumption_allowed',
        'total_depreciation_of_assets_sold',
        'total_book_value_end'
    ];
    public function appendixSeven()
    {
        return $this->belongsTo(AppendixSeven::class, 'appendix_seven_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
