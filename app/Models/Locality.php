<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Locality extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function offers() 
    {
        return $this->hasMany(Offer::class);
    }
    
    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }
}
