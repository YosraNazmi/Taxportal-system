<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Representative extends Model implements Authenticatable
{

    use AuthenticatableTrait;
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'password',
        'status',
       
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
