<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'email',
        'line',
        'trainee',
        'confidence',
    ];

    public function users() 
    {
        return $this->belongsToMany(User::class);
    }

    public function offers() 
    {
        return $this->hasMany(Offer::class);
    }

    public function localities()
    {
        return $this->belongsToMany(Locality::class);
    }
    
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
