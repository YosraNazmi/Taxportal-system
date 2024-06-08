<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixFive extends Model
{
    use HasFactory;
    protected $table = 'appendix_five';
    protected $fillable = [
        'user_id',
        'tax_number_merge', 
        'previous_company',
        'Liquidated_company_name',
        'tax_number_liquidation',
        'start_date_liquidation',
        'end_date_liquidation',

    ]; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
