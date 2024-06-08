<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormB extends Model
{
    use HasFactory;

    protected $table = 'annual_form_b';

    protected $fillable = [
        'formA_id',
        'netTaxableIncome',
        'previousYearsLosses', 
        'taxableIncome', 
        'taxRatio',
        'toBePaidTax',
        'foreignTaxAdoption', 
        'taxDeducted',
        'netPayableTax',
        'execManagerName',
        'execManagerDate',
        'auditorName',
        'auditorPhone',
        'auditorEmail',
        'inwardNumber',
        'inwardDate',
        'employeeName',
        'entryDate',
    ];

    public function formA()
    {
        return $this->belongsTo(FormA::class, 'formA_id');
    }
}
