<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'UPN',
        'dob',
        'category',
        'idNo',
        'companyName',
        'uen',
        'select',
        'addressLine1',
        'city',
        'country',
        'postalCode',
        'ePhoneNbr',
        'email',
        'code',
        'password',
        'status',
        'approval_comment',
        'approval_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function forms()
    {
        return $this->hasMany(Form::class);
    }
    public function representatives()
    {
        return $this->hasMany(Representative::class);
    }
    public function FormA()
    {
        return $this->hasOne(FormA::class);
    }
    public function formD()
    {
        return $this->hasOne(FormD::class);
    }
    public function formE()
    {
        return $this->hasOne(FormE::class);
    }
    public function appendixFour()
    {
        return $this->hasOne(AppendixFour::class);
    }
    public function appendixFive()
    {
        return $this->hasOne(AppendixFive::class);
    }
    public function appendixSix()
    {
        return $this->hasOne(AppendixSix::class);
    }
    public function appendixSeven()
    {
        return $this->hasOne(AppendixSeven::class);
    }
    public function intangibleAssets()
    {
        return $this->hasMany(IntangibleAsset::class);
    }

    // In the User model (User.php)
    public function appendixEight()
    {
        return $this->hasOne(AppendixEight::class);
    }

    public function appendixEightB()
    {
        return $this->hasOne(AppendixEightB::class);
    }

    public function appendixEightC()
    {
        return $this->hasOne(AppendixEightC::class);
    }
    public function appendixNine()
    {
        return $this->hasOne(AppendixNine::class);
    }
    public function appendixNineB()
    {
        return $this->hasOne(AppendixNineB::class);
    }



}
