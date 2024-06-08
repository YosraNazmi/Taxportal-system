<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixSeven extends Model
{
    use HasFactory;
    protected $table = 'appendix_seven';

    protected $fillable = ['user_id','depreciation_value', 'continuous_installment', 'decreasing_installment', 'another_method_administration'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function appendixSeven()
    {
        return $this->belongsTo(AppendixSeven::class);
    }
    public function intangibleAssets()
    {
        return $this->hasMany(IntangibleAsset::class, 'appendix_seven_id');
    }
}
