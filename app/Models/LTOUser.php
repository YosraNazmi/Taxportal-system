<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class LTOUser extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $table = 'ltouser'; 
    protected $fillable = ['name', 'email', 'password', 'phone', 'role', 'gender'];
    protected $hidden = ['password'];
}
