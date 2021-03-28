<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'firstName',
        'email',
        'role',
        'password',
        'center_id',
        'right_id',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public function right() 
    {
        return $this->belongsTo(Right::class);
    }

    public function offers() 
    {
        return $this->belongsToMany(Offer::class);
    }

    public function center() 
    {
        return $this->belongsTo(Center::class);
    }

    public function promotions() 
    {
        return $this->belongsToMany(Promotion::class);
    }

    public function companies() 
    {
        return $this->belongsToMany(Company::class);
    }
    
    public function ratings() 
    {
        return $this->belongsToMany(Rating::class);
    }
}
