<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnualForms extends Model
{
    use HasFactory;
    protected $table = 'annual_form_one'; 
    protected $fillable = ['user_id', 'data'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
