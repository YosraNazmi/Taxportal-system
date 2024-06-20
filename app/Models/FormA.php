<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormA extends Model
{
    use HasFactory;

    protected $table = 'annual_form_a';

    protected $fillable = [
        'user_id',
        'financialYearFrom',
        'financialYearTo',
        'legalStructureChange',
        'legalStructureChangeDate',
        'newLegalStructure',
        'mainActivityChange',
        'mainActivityChangeSpecify',
        'companyConsolidated',
        'companyConsolidationDate',
        'subsidiaryLiquidated',
        'branchClosed',
        'companyLiquidated',
        'accountingSystem', // Only include the field itself
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function formA()
    {
        return $this->belongsTo(FormA::class, 'formA_id');
    }
}
