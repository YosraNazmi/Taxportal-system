<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixTwentySix extends Model
{
    use HasFactory;
    protected $table = 'appendix_twenty_six';

    protected $fillable = [
        'user_id',
        'country',
        'net_profit',
        'income_tax_iqd',
        'unused_foreign_tax_credit',
        'total_foreign_tax',
        'maximum_tax_credit',
        'due_tax_approved_foreign_tax',
        'allowable_foreign_tax',
        'approval_foreign_tax',
        'total_1',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
