<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Form extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'form_reference',
        'taxpayer',
        'propertyyearfrom',
        'propertuyearto',
        'uen',
        'quarter',
        'seasonfromDate',
        'seasontoDate',
        'representativename',
        'upn',
        'position',
        'phone',
        'numberofEmployee',
        'salaryandwages',
        'Allowancess',
        'bonus',
        'total',
        'retire',
        'Gallowances',
        'summary',
        'examptions',
        'taxAmount',
        'dueTax',
        'delayone',
        'dalaytwo',
        'dalaythree',
        'totaloftaxpen',
        'delayinterest',
        'paidamount',
        'blanace',
        'remainingbalance',
        'tobepaid',
        'agreeCheckbox',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
