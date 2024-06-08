<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixTwentyOne extends Model
{
    use HasFactory;
     protected $table = 'appendix_twenty_one';

     protected $fillable = [
         'user_id',
         'tax_number',
         'name_of_insurance_company',
         'local_insurance',
         'external_insurance',
         'insurance_current_period',
         'allowed_insurance_premiums',
         'difference_allowed',
         'total_1',
     ];
 
     public function user()
     {
         return $this->belongsTo(User::class);
     }
}
