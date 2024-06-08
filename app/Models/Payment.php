<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['form_id', 'form_reference', 'dueTax', 'submission_date', 'payment_deadline','status'];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
