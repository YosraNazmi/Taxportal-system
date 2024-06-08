<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixNineB extends Model
{
    use HasFactory;
    protected $table = 'appendix_nine_b';
    protected $fillable = [
        'user_id',
        'number_of_shares',
        'tax_number',
        'company_name',
        'purchase_date',
        'purchase_cost',
        'net_selling_value',
        'profit_loss',
        'total_2'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
