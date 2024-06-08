<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppendixFourteenB extends Model
{
    use HasFactory;
    protected $table = 'appendix_fourteen_b';
    protected $fillable = [
        'user_id',
        'warehouse_address',
        'area',
        'private_owned',
        'musataha',
        'rent',
        'rent_owner_name'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
