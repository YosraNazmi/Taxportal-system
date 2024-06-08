<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixNine extends Model
{
    use HasFactory;
    protected $table = 'appendix_nine';
    protected $fillable = [
        'user_id',
        't_asset_type',
        't_purchase_date',
        't_book_value',
        't_net_selling_value',
        't_profit_loss',
        'total_1',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
