<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmittedAppendix extends Model
{
    use HasFactory;
    protected $table = 'submitted_appendix';
    protected $fillable = [
        'user_id',
        'appendix_four_id',
       
    ];

}
