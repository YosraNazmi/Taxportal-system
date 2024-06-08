<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixSix extends Model
{
    use HasFactory;
    protected $table = 'appendix_sixes';
    protected $fillable = [
        'user_id',
        'depreciation_value',
        'continuous_installment',
        'decreasing_installment',
        'Another_method_administration',
    ];

    public function tangibleAssets()
    {
        return $this->hasMany(TangibleAsset::class);
    }
}
